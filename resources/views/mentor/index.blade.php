<x-app-layout>

    <x-slot name="title">institute.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">Mentors</x-slot>

    <x-data-table 
        :items="$mentors" 
        :columns="[
            [
                'valueKey' => 'id', 
                'label' => 'ID' 
            ],
            [
                'valueKey' => 'name',
                'label' => 'Name'
            ]
        ]"
    >
        <x-slot name="heading">Mentors</x-slot>
    </x-data-table>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>