<x-app-layout>

    <x-slot name="title">batch.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">batch.index</x-slot>

    <div>
        <x-data-table 
            :items="$batches"
            show-create-button
            resource-base="batches"
            :columns="[
                [
                    'valueKey' => 'id', 
                    'label' => 'ID' 
                ],
                [
                    'valueKey' => 'name',
                    'label' => 'Name'
                ],
                [
                    'valueKey' => function($module){
                        return $module->module->name ?? '';
                    },
                    'label' => 'Module'
                ],
                [
                    'valueKey' => function($module){
                        return $module->session->name ?? '';
                    },
                    'label' => 'Session'
                ],
                [
                    'valueKey' => function($batch){
                        return view('batch.list-item-action', compact('batch'));
                    },
                    'label' => 'Action',
                    'th_class' => 'text-center',
                    'td_class' => 'text-center bg-green-100 dark:bg-green-600/20'
                ],
                
            ]"
        >
            <x-slot name="heading">
                Batches 
            </x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>