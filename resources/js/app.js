import 'flowbite';
import './bootstrap';

import { initFlowbite } from 'flowbite'


// console.log({initFlowbite});

window.initFlowbite = initFlowbite;
window.all_dropdown_list = {};


function InputDropdown(getOptions){

 

    let componentHooks = [];
    let currentHookIndex = 0;



    // How useState works inside React (simplified).
    function useState(initialState) {
        let pair = componentHooks[currentHookIndex];
        if (pair) {
            // This is not the first render,
            // so the state pair already exists.
            // Return it and prepare for next Hook call.
            currentHookIndex++;
            return pair;
        }

        // This is the first time we're rendering,
        // so create a state pair and store it.
        pair = [initialState, setState];

        function setState(nextState) {
            // When the user requests a state change,
            // put the new value into the pair.
            pair[0] = nextState;
            render();
        }

        // Store the pair for future renders
        // and prepare for the next Hook call.
        componentHooks[currentHookIndex] = pair;
        currentHookIndex++;
        return pair;
    }

    let dropdownItems = getOptions().items;

    let options = getOptions();
    let inputDropdown = null;
    let dropdown_items = null;
    let preview = null;
    let ulList = null;

    
    function removeItem(item,checkbox){
        item.remove();
        checkbox.checked =  false
    }

    function init(){

        console.log({options});

        options = getOptions();
        inputDropdown = document.getElementById( options.id );

        if( inputDropdown ) {

            
   
            dropdown_items = inputDropdown.querySelectorAll('ul.list li.list-item, ul.sub-list .list-item');
            preview = inputDropdown.querySelector('.preview');
            
            ulList = inputDropdown.querySelector('ul.list');
            
            dropdownItems = getOptions().items;
        } else {
            
        }
    }

    // function InputDropdown(){
    //     const [items, setItems] = useState(dropdownItems);

    //     return  {
    //         items:  items
    //     }
    // }

    function render(){
        
        //let dropdown = InputDropdown();

        //const items = dropdown.items;

        //ulList.innerHTML = "dd";
        //console.log({dropdown});


        if( inputDropdown ){

            inputDropdown.querySelectorAll(`[data-item-id]`).forEach(function(previewItem){
                previewItem.querySelector('button').addEventListener('click', function(e){
                    e.stopPropagation();
                    const id = previewItem.dataset.itemId;
                    removeItem( previewItem, inputDropdown.querySelector(`[data-id="${id}"]`) )
                })
            });
        }

        if( dropdown_items ) {
        
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
                            item.classList.add(...`${options.preview_item_class} item_id_${itemId}`.split(" "))

                            const close = document.createElement('button');
                            const span = document.createElement('span');
                            span.innerHTML = label;
                            close.innerHTML = "&times;"
                            close.classList.add(...`${options.preview_item_remove_class}`.split(' '))
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
        }
    }

    init();
    render();

    window.all_dropdown_list[options.id] = () => {
        init();
        render();
    };

}

window.InputDropdown = InputDropdown;