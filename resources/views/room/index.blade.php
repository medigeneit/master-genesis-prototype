<x-app-layout>

    <x-slot name="title">room.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">room.index</x-slot>

    <x-data-table 
        :items="$rooms" 
        :columns="[
            [
                'valueKey' => 'id', 
                'label' => 'ID' 
            ],
            [
                'valueKey' => function($room){
                    return $room->branch->name ??'';
                },
                'label' => 'Branch'
            ],
            [
                'valueKey' => 'name',
                'label' => 'Name'
            ]
        ]"
    >
        <x-slot name="heading">Rooms</x-slot>
    </x-data-table>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>