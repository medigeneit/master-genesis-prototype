<div>

    <div class="w-full mt-6 border pb-4 rounded-md">
        <div class="text-center border-dashed border-b py-1 bg-sky-50 dark:bg-gray-700 rounded-t-md">Starting and Ending</div>
        
        <div  class="max-w-2xl mx-auto flex items-center mt-1 gap-4">

            <div class="flex-grow">
                <label for="start-time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input 
                    datepicker 
                    datepicker-format="yyyy-mm-dd"
                    name="starting_date" 
                    value="{{ old('starting_date', $booking->starting_date ?? ' ' ) }}"
                    type="text"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-8 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Select date start"
                    >
                </div>
                
            </div>
            <div class="ml-8">
                <label for="start-time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start time:</label>
                <div class="relative">
                    <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <input 
                        type="time" 
                        value="{{ old('starting_time', $booking->starting_time ?? ' ' ) }}"
                        id="start-time" 
                        name="starting_time" 
                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  
                    />
                </div>
            </div>
            <div>
                <label for="end-time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration:</label>
                <div class="relative flex gap-4">
                    
                <input 
                        type="number"
                        id="duration_hour" 
                        placeholder="Hour" 
                        name="duration_hour" 
                        value="{{ old('duration_hour', $booking->duration_hour ?? '' ) }}"
                        class="w-20 bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   
                    />
                    
                    <input 
                        type="number" 
                        id="duration_minute" 
                        placeholder="Minute" 
                        name="duration_minute" 
                        value="{{ old('duration_minute', $booking->duration_minute ?? '' ) }}"
                        class="w-20 bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"   
                    />

                </div>
            </div>
        </div>

        <div class="max-w-2xl mx-auto">

            @error('starting_date')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
            @error('starting_time')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
            @error('duration_hour')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
            @error('duration_minute')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        
    </div>
    
    <div class="w-full">
        
        <x-input-dropdown
            label="Room(s)"
            :items="$branches"
            name="room_id[]"
            multiple
            :selected="$selected_room_ids"
        />

        <ul>
            @foreach ($errors->get('room_id.*') as $error)
                @foreach ($error as $message)
                    <li class="text-red-500">{{ $message }}</li>
                @endforeach
            @endforeach
        </ul>

        
    </div>


    <div class="w-full mt-4">
        <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
        <select 
            id="department_id" 
            name="department_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
            <option selected>--Select department--</option>
            @foreach ($departments as $department )
                <option value="{{ $department->id }}" {{ old('department_id', $booking->department_id ?? '') == $department->id  ? 'selected':'' }}>{{ $department->name }}</option>
            @endforeach
        </select>

        @error('department_id')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
    </div>

    <div class="border-b border-dashed mt-4 text-center pb-1">
        <div>Booking Type</div>
        
        <div class="w-full flex gap-6 justify-center">
            @if($booking->id ?? '')
                <input type="hidden" name="booking_type" value="{{$booking->booking_type}}" >
            @endif

            <label>
                <input 
                    type="radio" 
                    {{ $booking_type === 'class' ? ' checked ':'' }} 
                    {{-- ($booking->id ?? '') ? ' disabled ':'' --}} 
                    name="booking_type" value="class"
                >
                <span>Class</span>
            </label>
 
            <label>
                <input 
                    type="radio" 
                    {{ $booking_type === 'program' ? ' checked ':'' }}
                    {{-- ($booking->id ?? '') ? ' disabled ':'' --}} 
                    name="booking_type" 
                    value="program"
                >
                <span>Celebration Program/Orientation Class</span>
            </label>
            
        </div>
    </div>
    
    
    <div class="{{ $booking_type === 'program' || $booking_type === 'class' ? '':'hidden' }}" id="class-or-program-selection">


        <div id="program-selection" class="{{$booking_type === 'program' ? '':'hidden'}}">
            <div class="w-full mt-4">
                <label for="program_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Program</label>
                
                <select
                    id="program_id" 
                    name="program_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                    <option selected>--Select program--</option>
                    @foreach ($programs as $program )
                        <option value="{{ $program->id }}" {{ old('program_id', $booking->bookable_id ?? '') == $program->id  ? 'selected':'' }}>{{ $program->name }}</option>
                    @endforeach
                </select>

                @error('program_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div id="batch-topic" class="{{$booking_type === 'class' ? '':'hidden'}}">


        
            <div class="w-full mt-4">
                <label for="content_type_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content Type</label>
                    
                <div
                    id="content_type_id" 
                    
                    class="flex gap-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                    @foreach ($content_types as $content_type )
                        <label>
                            <input type="radio" name="content_type_id" value="{{ $content_type->id }}" {{ old('content_type_id', $booking->bookable_id ?? '') == $content_type->id  ? 'checked':'' }}/>
                            <span>{{ $content_type->name }}</span>
                        </label>
                    @endforeach
                </div>

                @error('content_type_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
          

            <div class="w-full mt-4" id="batch-selection">
                <label for="batch_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Batch</label>
                <select 
                    id="batch_id" 
                    name="batch_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                    <option selected>--Select batch--</option>
                    @foreach ($batches as $batch )
                        <option 
                            value="{{ $batch->id }}" 
                            {{ old('batch_id', $booking->bookable_id ?? '') == $batch->id  ? 'selected':'' }}
                        >{{ $batch->name }}</option>
                    @endforeach
                </select>

                @error('batch_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="w-full mt-6" id="topic-selection">
                
                <label for="topic_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Topic</label>

                <select id="topic_id" name="topic_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>--Select topic--</option>
                    @foreach ($topics as $topic )
                        <option 
                            value="{{ $topic->id }}" 
                            {{ old('topic_id', $booking->topic_id ?? '') == $topic->id  ? 'selected':'' }}
                        >{{ $topic->name }}</option>
                    @endforeach
                </select>

                @error('topic_id')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror

            </div>
        </div>
    </div>

    <div class="flex gap-3 mt-6 w-full flex-col" id="mentor-selection">
        <div class="w-full">
            <x-input-dropdown
                label="Mentor(s)"
                :items="$mentors"
                name="mentor_id[]"
                multiple
                :selected="$selected_mentor_ids"
            />
        </div>
        <ul>
            @foreach ($errors->get('mentor_id.*') as $error)
                @foreach ($error as $message)
                    <li class="text-red-500">{{ $message }}</li>
                @endforeach
            @endforeach
        </ul>
    </div>


</div>

<div class="flex items-center justify-between">
    <input type="submit" value="Save" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"/>
    <a href="/bookings" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Back</a>
</div>


<script>
    const schedule_type = document.querySelectorAll(`[name="booking_type"]`);
    const selection = document.getElementById('class-or-program-selection');
    const batch_id = document.querySelector('[name="batch_id"]');
    const topic_select = document.querySelector( `[id="topic_id"]` );
    const program_selection = document.getElementById('program-selection');
    const batch_topic = document.getElementById('batch-topic');

    //program_selection.classList.add('hidden');
    //batch_topic.classList.add('hidden');

    console.log(schedule_type)

    async function onBatchIdChange( ){
        const id = batch_id.value;
        const topics = (await axios.get( `/topics?batch_id=${id}` ))?.data?.topics;

        console.log({topics});

        topic_select.innerHTML = '';

        const emptyOpt = document.createElement( 'option' );
        emptyOpt.innerHTML = '--Select topic--';
        emptyOpt.value = '';
        emptyOpt.setAttribute( 'selected', 'selected' );
        topic_select.append( emptyOpt );

        topics.forEach(topic => {
            const opt = document.createElement('option');
            opt.value = topic.id;
            opt.innerHTML = topic.name;

            topic_select.append(opt);

        })
        

    }

    schedule_type.forEach(function(item){
        item.addEventListener('change', function(e){

            selection.classList.remove('hidden');

            switch(e.target.value) {
                case 'program':
                    program_selection.classList.remove('hidden');
                    batch_topic.classList.add('hidden');
                    document.querySelectorAll(`[name="content_type_id"]`).forEach( input => input.removeAttribute('required'))
                break;
                case 'class':
                    program_selection.classList.add('hidden');
                    batch_topic.classList.remove('hidden');
                    document.querySelectorAll(`[name="content_type_id"]`).forEach( input => input.setAttribute('required','required'))
                    batch_id.addEventListener('change', onBatchIdChange )
                break;

            }

        });
    });


</script>