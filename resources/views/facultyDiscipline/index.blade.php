<x-app-layout>

    <x-slot name="title">facultyDiscipline.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">Faculty/Disciplines</x-slot>

    <div>
        <x-data-table 
            :items="$facultyDisciplines" 
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
            <x-slot name="heading">Faculty/Discipline</x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>
 