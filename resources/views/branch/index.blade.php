<x-app-layout>

    <x-slot name="title">branch.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">branch.index</x-slot>

    <div>
        <x-data-table 
            :items="$branches" 
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
            <x-slot name="heading">Branches</x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>