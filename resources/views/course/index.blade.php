<x-app-layout>

    <x-slot name="title">course.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">course.index</x-slot>

    <div>
        <x-data-table 
            :items="$courses" 
            :columns="[
                [
                    'valueKey' => 'id', 
                    'label' => 'ID' 
                ],
                [
                    'valueKey' => function($course){
                        return $course->institute->name ?? '';
                    },
                    'label' => 'Institute'
                ],
                [
                    'valueKey' => 'name',
                    'label' => 'Name'
                ],
                
            ]"
        >
            <x-slot name="heading">Courses</x-slot>
        </x-data-table>
    </div>
    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>