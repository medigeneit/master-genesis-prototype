<div>

    <div class="w-full">
        
        <x-input-dropdown
            label="Session"
            :items="$sessions"
            name="session_id"
            :selected="old( 'session_id', $content->session_id ?? '' )"
        />

    </div>

    <div class="w-full mt-6" id="topic-selection">

        <x-input-dropdown
            label="Topic"
            :items="$topics"
            name="topic_id"
            :selected="old('topic_id', $content->topic_id ?? '')"
        />
        
    
    </div>
 

    <div class="w-full mt-4">
        <label for="content_type_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content Type</label>
            
        <div
            id="content_type_id" 
            
            class="gap-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        >
            @foreach ($content_types as $content_type )
                <label>
                    <input type="radio" name="type" 
                        value="{{ $content_type->id }}" {{ old('type', $content->type ?? '') == $content_type->id  ? 'checked':'' }}/>
                    <span>{{ $content_type->name }}</span>
                </label>
            @endforeach
            @error('type')
                <div class="text-red-500 text-sm mt-3">{{ $message }}</div>
            @enderror
        </div>

    </div>
 
    <div class="w-full mt-6 border pb-4 rounded-md">
        <div class="text-center border-dashed border-b py-1 bg-sky-50 dark:bg-gray-700 rounded-t-md">Material</div>
        
        <div  class="max-w-2xl mx-auto flex items-center mt-1 gap-4">

        </div>

        <div>

            <div class="max-w-2xl mx-auto flex gap-4">
                <fieldset class="bg-gray-50 dark:bg-gray-700 rounded px-2">
                    <legend class="font-semibold mx-4 text-sm">
                        <label >Code</label>
                    </legend>
                    <div class="pb-2 border-gray-300 dark:border-gray-600">
            
                        <input 
                            type="text" 
                            name="material_id"
            
                            value="{{ old('material_id', $content->material_id ?? '') }}" 
                            class="h-8 bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </fieldset>
            
                <div id="materials-list-view" class="mt-2 border border-gray-300 dark:border-gray-500 w-full rounded flex items-center px-4">
                    <div>
                        @include('content.materials')
                    </div>
                </div>
            </div>
        </div>
         
    </div>

    <div class="mt-4">

        <x-input-dropdown
            label="Clinical ID"
            hints="Only selected subject/faculty's doctor will show the content"
            :items="$faculty_disciplines"
            name="clinical_id"
            :selected="old('clinical_id', $content->clinical_id ?? '')"
        />
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
 
    const materials_list_view = document.getElementById('materials-list-view');
    const type = document.querySelectorAll(`[name="type"]`);
    const material_id = document.querySelector(`[name="material_id"]`)

    if( type ) {
        
        Array.from(type).forEach(content_type => {
            content_type.addEventListener( 'change', async function(e){
                if( material_id.value ) {
    
                    switch(e.target.value) {
                        case '2':
                            await load_materials_view(2);
                        break;
                        default:
                            await load_materials_view(1);
                            
                    }

                    console.log({v: e.target.value });

                }
            });
        })
    }

    function getMaterialType(){

        // console.log({content_type_id, content_type_id:content_type_id.value});

        if( document.querySelector(`[name="type"]:checked`) ) {
            switch(document.querySelector(`[name="type"]:checked`).value) {
                case '2':
                    return 2;
                default:
                    return 1;
            }
        }
    }


    function run_material_code_input_event( ){
        let timer = 0;

        material_id.addEventListener('input', function(){
            clearTimeout( timer );
            timer = setTimeout(load_materials_view, 500, getMaterialType());
        });
    }

    

    run_material_code_input_event();

    async function load_materials_view( type ){
        materials_list_view.innerHTML = "<div class='text-center'>Loading...</div>";
        const material_id = document.querySelector(`[name="material_id"]`);
        try {
            materials_list_view.innerHTML = (await axios.get( `/contents/materials/${type}/show/${material_id.value}` )).data;
        } catch(err){
            materials_list_view.innerHTML = "<div class='text-center italic'>Type code to show</div>";
        }
    }
     
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