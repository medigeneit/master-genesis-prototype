<x-app-layout>

    <x-slot name="title">topic.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">topic.index</x-slot>
    <div>
        <x-data-table 
            :items="$topics" 
            :columns="[
                [
                    'valueKey' => 'id', 
                    'label' => 'ID' 
                ],
                [
                    'valueKey' => 'name',
                    'label' => 'Name'
                ],
                
            ]"
        >
            <x-slot name="heading">Topics</x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>