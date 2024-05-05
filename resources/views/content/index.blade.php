<x-app-layout>

    <x-slot name="title">content.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">content.index</x-slot>

    <div>
        <x-data-table 
            resource-base="contents"
            show-create-button
            :items="$contents" 
            :columns="[
                [
                    'valueKey' => 'id', 
                    'label' => 'ID' 
                ],

                [
                    'valueKey' => function($content){
                        return '..';
                    },
                    'label' => 'Material'
                ],
                [
                    'valueKey' => function($content){
                        return $content->session->name .' ('.$content->session->year.')';
                    },
                    'label' => 'Session'
                ],
                [
                    'valueKey' => function($content){
                        return $content->topic->name;
                    },
                    'label' => 'Topic'
                ]
            ]"
        >
            <x-slot name="heading">Session Topic Contents</x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>