<div>


    <div class="w-full">
        
        <x-input-dropdown
            label="Module"
            :items="$modules"
            name="module_id"
            :selected="old( 'module_id', $batch->module_id ?? '' )"
        />

    </div>


    <div class="w-full mt-4">
        
        <x-input-dropdown
            label="Session"
            :items="$sessions"
            name="session_id"
            :selected="old( 'session_id', $batch->session_id ?? '' )"
        />

    </div>


    <div class="mt-4">
        <label for="start-time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Batch name</label>
        <div class="relative">
            <input 
                type="text" 
                value="{{ old('name', $batch->name ?? '' ) }}"
                id="name" 
                name="name" 
                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  
            />
        </div>
    </div>

 
    
</div>

<div class="flex items-center justify-between">
    <input type="submit" value="Save" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"/>
    <a href="/batches" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Back</a>
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