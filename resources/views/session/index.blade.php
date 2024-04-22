<x-app-layout>

    <x-slot name="title">session.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">session.index</x-slot>

    <div>
        <x-data-table 
            :items="$sessions" 
            :columns="[
                [
                    'valueKey' => 'id', 
                    'label' => 'ID' 
                ],
                [
                    'valueKey' => 'year',
                    'label' => 'Year'
                ],
                [
                    'valueKey' => function($session){
                        return $session->course->name ?? '';
                    },
                    'label' => 'Institute'
                ],
                [
                    'valueKey' => 'name',
                    'label' => 'Name'
                ],
                
            ]"
        >
            <x-slot name="heading">Course Sessions</x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>