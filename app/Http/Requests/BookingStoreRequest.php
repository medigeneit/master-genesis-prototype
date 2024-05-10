<?php

namespace App\Http\Requests;

use App\Models\Batch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\BlockedDate;
use App\Models\Booking;
use App\Models\Mentor;
use App\Models\MentorBooking;
use App\Models\Program;
use App\Models\Room;
use App\Models\RoomBooking;
use Carbon\Carbon;

class BookingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function bookable( ){
        switch( $this->booking_type ) {
            case 'class':
                return Batch::find( $this->batch_id );
            case 'program':
                return Program::find( $this->program_id );
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'starting_date' => ['required', self::not_in_blocked_dates()],
            'starting_time' => ['required'],
            'duration_hour' => ['required'],
            'duration_minute' => ['required'],
            'department_id' => ['required', 'integer'],
            'mentor_id.*' => ['exists:mentors,id', 'integer', self::mentor_availablity_rule($this)],
            'room_id.*' => ['exists:rooms,id', 'integer', self::room_availablity_rule($this)],
        ] +( self::booking_type_rules($this) ?? []);
    }

    public static function booking_type_rules( $request ){

        switch( $request->booking_type ) {
            case 'class':
                return [
                    'batch_id' => ['required', 'integer','exists:batches,id'],
                    'topic_id' => ['nullable', 'integer','exists:topics,id'],
                ];
            case 'program':
                return [
                    'program_id' => ['required', 'integer','exists:programs,id'],
                ];
        }
    }

    public static function not_in_blocked_dates(){
        return function($field, $date, $error){
            if($day = BlockedDate::query()->where('date', $date)->first()) {
                $error( "'" . $day->title . "'. This date is blocked" );
            }
        };
    }

    public static function mentor_availablity_rule( Request $request ){
        
    
        return function ($field, $mentor_id, $error) use ($request ){
            $booking = $request->route('booking');

            $duration = self::duration( $request, $request->starting_date, $starting_date_time );

            if( $duration ) {

                $bookingOnDate = self::bookingExistsQuery($starting_date_time, $duration)
                    ->whereIn(
                        'id', 
                        MentorBooking::query( )
                            ->where( 'mentor_id', $mentor_id )
                            ->select( 'booking_id' ) 
                    );

                if( $request->isMethod('PUT') ){
                   $bookingOnDate->where('id', '<>', $booking->id );
                }

                if( $bookingOnDate->exists() ) {
                    $mentor = Mentor::find($mentor_id, ['name']);
                    $error(  $mentor->name  . " is not available on selected time slot!");
                }
            }
        };
        
    }

    public static function room_availablity_rule( Request $request ){
        
        // dd($request);

        return function ($field, $room_id, $error) use ($request ){
            $booking = $request->route('booking');
            $duration = self::duration( $request, $request->starting_date, $starting_date_time );

            // dd($booking, $duration);
            if( $duration ) {


                $bookingOnDate = self::bookingExistsQuery($starting_date_time, $duration)
                    ->whereIn(
                        'id', 
                        RoomBooking::query( )
                            ->where( 'room_id', $room_id )
                            ->select( 'booking_id' ) 
                    );

                if( $request->isMethod('PUT') ){
                   $bookingOnDate->where('id', '<>', $booking->id );
                }

                if( $bookingOnDate->exists() ) {
                    $room = Room::find($room_id, ['name']);
                    $error(  $room->name  . " is not available on selected time slot!");
                }
            }
        };
        
    }


    protected static function bookingExistsQuery($starting_date_time, $duration){
        $query = Booking::query();

        $query->whereRaw(
            "UNIX_TIMESTAMP(?) < UNIX_TIMESTAMP( `started_at` ) + (duration * 60)", [$starting_date_time]
        );

        $query->whereRaw(
            "UNIX_TIMESTAMP(?) + ?*60 > UNIX_TIMESTAMP( `started_at` )", [$starting_date_time, $duration]
        );

        $query->whereNotNull('duration');

        return $query;
    } 

    protected static function duration( Request $request, $date, &$starting_date = "" ){

        $starting_date = "$date {$request->get('starting_time')}";

        if( $request->has( 'starting_time' ) && $request->has( 'ending_time' )) {

            $ending_date = "$date {$request->get('ending_time')}";

            $starting = Carbon::make( $starting_date );
            $ending = Carbon::make( $ending_date );

            if( $starting ) {
                return $starting->diffInMinutes($ending);
            }
        }

        return ( $request->duration_minute ?? 0) + (($request->duration_hour ?? 0 ) * 60 );
    }
}
