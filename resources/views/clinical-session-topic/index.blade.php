<x-app-layout>

    <x-slot name="title">Session Topics || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">Session Topics</x-slot>

    <div>
        <x-data-table 
            :items="$clinical_session_topics" 
            :columns="[
                [
                    'valueKey' => 'id', 
                    'label' => 'ID' 
                ],
                [
                    'valueKey' => function($clinica_session_topic){
                        return $clinica_session_topic->topic->name ?? '';
                    },
                    'label' => 'Topic'
                ],
                [
                    'valueKey' => function($clinica_session_topic){
                        return $clinica_session_topic->session->name ?? '';
                    },
                    'label' => 'Session'
                ],
                [
                    'valueKey' => function($clinical_session_topic){
                        return $clinical_session_topic->faculty_discipline->name ?? '(Basic)';
                    },
                    'label' => 'Clinical (Faculty/Subject)'
                ],
                
            ]"
        >
            <x-slot name="heading">Session Topics</x-slot>
        </x-data-table>
    </div>

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>