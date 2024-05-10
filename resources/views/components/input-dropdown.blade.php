
@props([
    'items', 'selected', 'id', 'label','class', 'name', 'multiple'
])

@php
    $items = $items ?? collect([]);
    $class =( $class ?? '').' w-full sm:min-w-40 md:min-w-64 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';

    $selected_ids = $selected ?? [];

    $selected_sub_items  = collect([]);
    $item_has_children  = false;

    if( $multiple ?? false ){

        $_selected = $items->reduce(function($items, $item) use($selected_ids){
            if( $item->children ) {
                
                $items = $items->merge(
                    $item->children->filter(function($child) use($selected_ids, &$selected_sub_items){
                        return in_array( $child->id, $selected_ids ); 
                    })
                );
                    
            } else {
                if( in_array( $item->id, $selected_ids ) ) {
                    $items->push($item);
                }
            }
                
            return $items;
                
        }, collect([]));
            
    } else {
        $_selected = null;

        //$items->each(function($item) use(&$_selected){
            //$item->id =
        //});

    }

    $id = $id ?? uniqid();


    $is_multiple = $multiple ?? false;

    $is_selected = function( $id ) use( $is_multiple, $selected_ids){
        if($is_multiple) {
            return in_array( $id, $selected_ids);
        }
        return $id == $selected_ids;
    };

    $unique_id = 'dropdown_'.uniqid();

    $preview_item_class = 'px-2 py-1 dark:bg-white dark:text-gray-800 font-semibold border rounded-lg inline-block mb-2';

@endphp


<fieldset class="{{ $class }}" id="{{ $unique_id }}">
    @if(isset($label))
        <legend class="font-semibold ml-4">{{ $label }}</legend>
    @endif

    <div class="relative px-2">
        <div 
            id="{{ 'dropdown'.$id.'Button' }}" 
            data-dropdown-toggle="{{ 'dropdown'.$id }}" 
            data-dropdown-placement="bottom" 
            class="font-medium rounded-lg text-sm text-center flex items-center w-full min-h-10" 
            type="button"
        >
            
            <div class="rounded-md flex-grow text-left line-clamp-2 preview flex gap-2 flex-wrap">

                @if($multiple ?? false)
                    @foreach( $_selected as $item )
                        <div class="{{$preview_item_class}}" data-item-id="{{$item->id}}">
                            <span> {{ isset($item->id) ? $item->id . " - ":'' }} {{$item->name}}</span>
                            <button class="border h-6 w-6 rounded-full ml-2">&times</button>
                        </div>
                    @endforeach
                @endif
            </div>

            <svg class="w-2.5 h-2.5 ms-3 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>

        </div> 

        <div id="{{ 'dropdown'.$id }}" class="z-10 hidden bg-white rounded-lg shadow  dark:bg-gray-700 left-0 right-0 w-full">
            <div class="min-h-[50px] max-h-[200px] overflow-y-auto w-full border rounded-md">

                <ul class="border rounded-md list">
                    @forelse ( $items as $item)
                        @if($item->children)
                            <li class="border-b border-gray-400 sub-list">

                                <div class="px-2 py-1  dark:bg-gray-800 pb-2 border-b font-bold">{{ $item->id }} - {{  $item->name }}</div>

                                <ul class="ml-4">
                                    @foreach ($item->children as $child)
                                        <li class="list-item border-b flex items-center dark:border-gray-600  {{ $is_selected($child->id) ? 'text-gray-700 dark:text-gray-300 dark:bg-blue-800':'text-gray-900  dark:text-gray-300' }}">
                                            <label class="flex items-center px-2 py-2  w-full cursor-pointer">
                                                <input 
                                                    data-id="{{ $child->id }}"
                                                    type="{{ ( $multiple ?? false ) ? 'checkbox':'radio' }}" 
                                                    name="{{ $name ?? '' }}" 
                                                    {{ $is_selected($child->id) ? 'checked':'' }} 
                                                    value="{{ $child->id }}"    
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                                >
                                                <div class="ms-2 text-sm font-medium label">
                                                    {{$child->id}} - {{$child->name}}
                                                </div>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                                
                            </li>

                        @else

                            <li class="list-item border-b flex items-center dark:border-gray-600  {{ $is_selected( $item->id ) ? 'text-gray-700 dark:text-gray-300 dark:bg-blue-800':'text-gray-900  dark:text-gray-300' }}">
                                <label class="flex items-center px-2 py-2  w-full cursor-pointer">
                                    <input 
                                        data-id="{{ $item->id }}"
                                        type="{{ ( $multiple ?? false ) ? 'checkbox':'radio' }}" 
                                        name="{{ $name ?? '' }}" {{ $is_selected( $item->id ) ? 'checked':'' }} 
                                        value="{{ $item->id }}"    
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    >
                                    <div class="ms-2 text-sm font-medium label">
                                        {{$item->id}} - {{$item->name}}
                                    </div>
                                </label>
                            </li>
                        @endif
                    @empty
                        <li class="border-b flex items-center">
                            <span>--No Data Found--</span>
                        </li>
                    @endforelse
                    
                </ul>
            </div>
        </div>
    </div>
</fieldset>

<script>

// <div class="px-2 py-1 dark:bg-white dark:text-gray-800 font-semibold border rounded-lg inline-block mb-2">{{$item->name}}</div>

(function(getOptions){
        const options = getOptions();
        const inputDropdown = document.getElementById( options.id );

        const dropdown_items = inputDropdown.querySelectorAll('ul.list li.list-item, ul.sub-list .list-item');
        const preview = inputDropdown.querySelector('.preview');

        inputDropdown.querySelectorAll(`[data-item-id]`).forEach(function(previewItem){
            previewItem.querySelector('button').addEventListener('click', function(e){
                e.stopPropagation();
                const id = previewItem.dataset.itemId;
                removeItem( previewItem, inputDropdown.querySelector(`[data-id="${id}"]`) )
            })
        });


        function removeItem(item,checkbox){
            item.remove();
            checkbox.checked =  false
        }

        dropdown_items.forEach(function(list_item){

            // console.log(list_item.querySelector('div.label').innerHTML);

            list_item.querySelector('input').addEventListener('change', function(e){


                const label = list_item.querySelector('div.label').innerHTML.trim();

                console.log({options});

                if( options.multiple ) {
                    
                    const item = document.createElement('div');
                    const itemId = list_item.querySelector('input').dataset.id;

                    const handleInputOnUncheck = function( item ){
                        if( item ) {
                            item.remove();
                        }
                    };

                    

                    if( e.target.checked ) {
                       
                        //"px-2 py-1 dark:bg-white dark:text-gray-800 font-semibold border rounded-lg inline-block mb-2"
                        item.classList.add(...`px-2 py-1 dark:bg-white dark:text-gray-800 font-semibold border rounded-lg inline-block mb-2 item_id_${itemId}`.split(" "))

                        const close = document.createElement('button');
                        const span = document.createElement('span');
                        span.innerHTML = label;
                        close.innerHTML = "&times;"
                        close.classList.add(..."border h-6 w-6 rounded-full ml-2".split(' '))
                        item.appendChild(span);
                        item.appendChild(close);

                        close.addEventListener('click', (e) => {
                            e.stopPropagation();
                            removeItem(item,list_item.querySelector('input'));
                        });

                        preview.appendChild( item );
                         
                        list_item.querySelector('input').addEventListener('change', () => {
                            handleInputOnUncheck( item );
                        });

                    } else {
                        console.log({item}, 'onUnCheck');
                        handleInputOnUncheck( inputDropdown.querySelector(`[data-item-id="${itemId}"]`) );
                    }


                } else {
                    preview.innerHTML = label;
                }

            })
        })


    })(() => {

        //'items', 'selected', 'id', 'label','class', 'name', 'multiple'

        let items = []; 
        try{
            // items = JSON.parse( items );
            items = {!! json_encode($items) !!};
        }catch( err ){
            items = [];
            console.log(err)
        }

        return {
            items,
            id: '{{ $unique_id }}',
            multiple: Boolean( parseInt('{{ $multiple ?? 0 }}')),
        
        };

    });

</script>