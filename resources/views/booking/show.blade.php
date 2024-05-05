<x-app-layout>

    <x-slot name="title">booking.show || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">booking.show</x-slot>

    <div>


        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

                <tbody>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="font-bold border-b border-dashed dark:border-gray-600 mb-2">Department</div>
                            <div>
                                {{ $booking->department->name }}
                            </div>
                        </th>
                        
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="font-bold border-b border-dashed dark:border-gray-600 mb-2">Topic</div>
                            <div>
                                {{  $booking->topic->name }}
                            </div>
                        </th>
                        
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="font-bold border-b border-dashed dark:border-gray-600 mb-2">Time and Duration</div>
                            <div>
                                <div>{{ $booking->started_at->format('d M Y h:ia') }} </div>
                                <div>
                                    {{ $booking->duration_hour }} H {{ ' ' }}  
                                    {{ $booking->duration_minute }} M     
                                </div>
                            </div>
                        </th>
                        
                    </tr>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="font-bold border-b border-dashed dark:border-gray-600 mb-2">Mentor(s)</div>
                            <div>
                                {{ $booking->mentors->map( function($mentor){ return $mentor->name; })->join(', ') }}
                            </div>
                        </th>
                        
                    </tr>
                    <tr>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            <div class="font-bold border-b border-dashed dark:border-gray-600 mb-2">Room(s)</div>
                            <div>
                                {{  $booking->rooms->map( function($room){ return $room->name; })->join(', ') }}
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <a href=""></a>
        </div>


    </div>
    <div class="mt-8 flex justify-between">
        <a href="{{'/bookings/'. $booking->id. '/edit'}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>
        <a href="/bookings" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Back</a>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>