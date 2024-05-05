<x-app-layout>

    <x-slot name="title">batch.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">batch.index</x-slot>

    <div>
        <x-data-table 
            :items="$batches" 
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
                
            ]"
        >
            <x-slot name="heading">Faculty/Discipline</x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>