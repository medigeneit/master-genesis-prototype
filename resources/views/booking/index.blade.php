<x-app-layout>

    <x-slot name="title">Session Topics || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">Room/Mentor Booking</x-slot>

    <div>
        <x-data-table 
            resource-base="bookings"
            show-create-button
            :items="$bookings" 
            :columns="[

                [
                    'valueKey' => 'id', 
                    'label' => 'ID' 
                ],
                [
                    'valueKey' => function($booking){
                        return $booking->department->name;
                    },
                    'label' => 'Department'
                ],
                [
                    'valueKey' => function($booking){
                        return '<div>'. $booking->started_at->format('d M Y h:ia') .'</div>'
                        . '<div>'
                            . $booking->duration_hour .'H '
                            . $booking->duration_minute . 'M'     
                        . '</div>';
                    },
                    'label' => 'Time & Duration'
                ],
                [
                    'valueKey' => function($booking){
                        return $booking->topic->name ?? '';
                    },
                    'label' => 'Topic'
                ],
                {{--
                [
                    'valueKey' => function($booking){
                        if($booking->rooms instanceof \Illuminate\Support\Collection) {
                            return $booking->rooms->map( function($room){ return $room->name; })->join(', ');
                        }
                    },
                    'label' => 'Room(s)'
                ],
                [
                    'valueKey' => function($booking){
                        if($booking->mentors instanceof \Illuminate\Support\Collection) {
                            return $booking->mentors->map( function($mentor){ return $mentor->name; })->join(', ');
                        }
                        return $booking->mentors ?? '';
                    },
                    'label' => 'Mentor(s)'
                ],
                --}}
                [
                    'valueKey' => function($booking){
                        return '<a href=\'/bookings/'.$booking->id.'/edit\' >Edit</a> &nbsp;&nbsp;&nbsp;' . ' <a href=\'/bookings/'.$booking->id.'\' >Show</a>';
                    },
                    'label' => 'Action'
                ],
                
            ]"
        >
            <x-slot name="heading">Booking Master Schedule</x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>