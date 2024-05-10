<x-app-layout>

    <x-slot name="title">Session Topics || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">Room/Mentor Booking</x-slot>

    <div class="border overflow-auto max-h-[700px]">

        <table class="min-w-max w-full table-auto">
            <thead class="text-xs uppercase">
                <tr>
                    <th class="sticky left-0  z-50 top-0  border px-6 py-3 text-gray-700  bg-gray-50 dark:bg-gray-800 dark:text-gray-400">Date</th>
                    @foreach($rooms as $room)
                        <th class="sticky  top-0   border px-6 py-3 text-gray-700  bg-gray-50 dark:bg-gray-800 dark:text-gray-400">{{ $room->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>

                @foreach($dates as $date)
                <tr>
                    <td class="group sticky left-0 px-6 py-10 border-b bg-gray-100 dark:text-gray-200 dark:bg-gray-700 dark:border-gray-800">
                        <div class="relative">
                            <div>
                                {{ $date->format('M d-y') }}
                            </div>
                            <div class="absolute -bottom-100 right-0 left-0 text-center">
                                <a 
                                href="/bookings/create?selected_date={{$date->format('Y-m-d') }}"
                                class="border rounded-full  w-8 h-8 leading-7 text-lg hidden group-hover:inline-block dark:hover:bg-cyan-900"
                                >+</a>
                            </div>
                        </div>
                    </td>
                    @foreach($rooms as $room)
                        <td class="group border px-6 py-10 border-b dark:text-gray-300 dark:bg-gray-600 dark:border-gray-700">

                                                    
                            <ul class="relative min-h-8">

                                @foreach ( ($room->slot_bookings[ $date->format('Y-m-d') ] ?? []) as $booking )
                                    <li class="bg-cyan-200 dark:bg-cyan-900 mb-1 rounded shadow">
                                        <a href="/bookings/{{$booking->id}}" class="py-1 block px-3">
                                            <div>
                                                {{ $booking->started_at ? $booking->started_at->format('h:ia'): '' }} - 
                                                {{ $booking->ending ? $booking->ending->format('h:ia'): '' }}
                                            </div>
                                            <div>
                                                {{ $booking->department->name ?? '' }}
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                                <li class="absolute -bottom-100 right-0 left-0 text-center">
                                    <a 
                                        href="/bookings/create?selected_date={{$date->format('Y-m-d') }}&selected_room_id={{ $room->id }}"
                                        class="border rounded-full  w-8 h-8 leading-7 text-lg hidden group-hover:inline-block dark:hover:bg-cyan-900"
                                    >+</a>
                                </li>
                            </ul> 

                        </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>

        </table>

        {{--  
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
                {{ --
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
                -- }}
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

        --}}
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>