<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingStoreRequest;
use App\Http\Requests\BookingUpdateRequest;
use App\Models\Batch;
use App\Models\Booking;
use App\Models\Branch;
use App\Models\ContentType;
use App\Models\Department;
use App\Models\Mentor;
use App\Models\Program;
use App\Models\Room;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::all();

        return view('booking.index', compact('bookings'));
    }


    function data(Booking $booking){
        $departments = Department::get();
        $batches = Batch::get();

        $rooms = Room::get();
        $branches = Branch::with('rooms')->where('status',1)->get()->map(function($branch){
            $branch->children = $branch->rooms;
            return $branch;
        });

        $topics = [];


        $topics = Topic::query();
        
        $module_id_where = Batch::where('id', old( 'batch_id', $booking->bookable_id ?? ''))->select('module_id');

        $topics->whereHas( 'modules', function( $module ) use( $module_id_where ){
            $module->where('id', $module_id_where);
        });

        $topics = $topics->get();

        $mentors = Mentor::get();
        $programs = Program::get();
        $content_types = ContentType::get();

        $selected_room_ids = [];

        $selected_mentor_ids = [];
        $booking_type = old( 'booking_type', $booking->booking_type ?? '' );

        if( $booking ) {
            $selected_room_ids = $booking->rooms()->pluck('id')->toArray();

            $selected_mentor_ids = $booking->mentors()->pluck('id')->toArray();
                
        }

        return compact( 'departments','batches','rooms','topics','mentors', 'selected_room_ids', 'selected_mentor_ids','branches','programs', 'booking_type','content_types' );
    }

    public function create(Request $request)
    {

        return view('booking.create', $this->data(new Booking()));
    }

    public function store(BookingStoreRequest $request)
    {

        // return $request->bookable()->bookings;
        // return $request;
        // $booking = Booking::create(

        $booking = $request->bookable()->bookings()->create(
            $request->validated()
            + [
                'started_at' => $this->booking_starting( $request->starting_date, $request->starting_time, new Booking() ),
                'duration' => $this->booking_duration( $request->duration_hour, $request->duration_minute, new Booking() )
            ]
        );

        $booking->rooms()->attach($request->room_id);
        $booking->mentors()->attach($request->mentor_id);

        $request->session()->flash('message', 'Booking successfully created' );

        return redirect()->route('bookings.index');
    }

    public function show(Request $request, Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    public function edit(Request $request, Booking $booking)
    {

        return view('booking.edit' , $this->data( $booking ) + compact('booking'));
    }

    protected function booking_starting( $date, $time, Booking $booking ){
        
        $booking->starting_date = $date;
        $booking->starting_time = $time;

        return $booking->started_at;
    }

    protected function booking_duration($hour, $minute, Booking $booking){
        $booking->duration_hour = $hour; //$request->validated('duration_hour');
        $booking->duration_minute = $minute; //$request->validated('duration_minute');

        return $booking->duration;
    }

    public function update(BookingUpdateRequest $request, Booking $booking)
    {
        
        // return $request;

        $this->booking_starting( $request->starting_date, $request->starting_time, $booking );
        $this->booking_duration( $request->duration_hour, $request->duration_minute, $booking );

        $booking->update($request->validated());

        $booking->rooms()->sync($request->room_id);
        $booking->mentors()->sync($request->mentor_id);

        $request->session()->flash('booking.id', $booking->id);

        return redirect()->route('bookings.index');
    }

    public function destroy(Request $request, Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index');
    }
}
