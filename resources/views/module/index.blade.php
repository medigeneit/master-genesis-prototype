<x-app-layout>

    <x-slot name="title">module.index || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">module.index</x-slot>

    <div>
        <x-data-table 
            :items="$modules" 
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
                        return $module->has_exam ? '&check;':'';
                    },
                    'label' => 'Exam'
                ],
                [
                    'valueKey' => function($module){
                        return $module->has_solve ? '&check;':'';
                    },
                    'label' => 'Solve Class'
                ],
                [
                    'valueKey' => function($module){
                        return $module->has_lecture ? '&check;':'';
                    },
                    'label' => 'Lectures'
                ],
                [
                    'valueKey' => function($module){
                        return $module->has_feedback ? '&check;':'';
                    },
                    'label' => 'Feedback Class'
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