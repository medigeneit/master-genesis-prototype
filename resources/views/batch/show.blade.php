<x-app-layout>

    <x-slot name="title">batch.show || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">batch.index</x-slot>

    <div class="max-w-6xl mx-auto">
        <h2 class="w-full border-b dark:border-gray-700 text-xl font-bold">Batch</h2>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-10 mt-2">
            <tbody>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border dark:border-gray-500 bg-gray-100 dark:bg-gray-700">Batch Name</th>
                    <td scope="col" class="px-6 py-3 border dark:border-gray-500 bg-gray-100 dark:bg-gray-700 text-lg font-semibold">{{ $batch->name }}</td>
                </tr>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border dark:border-gray-500 bg-gray-100 dark:bg-gray-700">Session</th>
                    <td scope="col" class="px-6 py-3 border dark:border-gray-500 bg-gray-100 dark:bg-gray-700">{!!  $batch->session->name ?? '' !!}</td>
                </tr>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border dark:border-gray-500 bg-gray-100 dark:bg-gray-700">Module</th>
                    <td scope="col" class="px-6 py-3 border dark:border-gray-500 bg-gray-100 dark:bg-gray-700">{!!  $batch->module->name ?? '' !!}</td>
                </tr>

            </tbody>
        </table>


        <x-data-table 
            :items="$contents" 
            :columns="[

                [
                    'valueKey' => 'id', 
                    'label' => 'ID',
                    'td_class' => 'bg-green-100/40 dark:bg-gray-700/50',
                ],

                [
                    'valueKey' => function($content){
                        return $content->material->name ?? '';
                    },
                    'label' => 'Name',
                    'td_class' => 'bg-green-100/40 dark:bg-gray-700/50',
                ],
                [
                    'valueKey' => function($content){
                        return ($content->material->type ?? '') == '2' ? 'Exam':'Lecture Video';
                    },
                    'label' => 'Type',
                    'td_class' => 'bg-green-100/40 dark:bg-gray-700/50',
                ],

                // [
                //     'valueKey' => function($batch_topic) use($batch){
                //         // return view('batch.batch-topics-list-action', compact('batch','batch_topic'));
                //     },
                //     'label' => 'Action',
                //     'th_class' => 'text-center',
                //     'td_class' => 'text-center bg-green-100 dark:bg-green-600/20'
                // ],
 
            ]"
            >
            <x-slot name="heading">
                Contents
                {{-- <a href="{{ route('batchs.topics.create', [$batch->id]) }}">Create Batch Topics</a> --}}
            </x-slot>
            
        </x-data-table>


        <x-data-table 
            class="mt-10"
            :items="$batch->module->topics" 
            :columns="[

                [
                    'valueKey' => 'id', 
                    'label' => 'ID',
                    'td_class' => 'bg-green-100/40 dark:bg-gray-700/50',
                ],

                [
                    'valueKey' => 'name',
                    'label' => 'Name',
                    'td_class' => 'bg-green-100/40 dark:bg-gray-700/50',
                ],

                [
                    'valueKey' => function($batch_topic) use($batch){
                        // return view('batch.batch-topics-list-action', compact('batch','batch_topic'));
                    },
                    'label' => 'Action',
                    'th_class' => 'text-center',
                    'td_class' => 'text-center bg-green-100 dark:bg-green-600/20'
                ],
 
            ]"
            >
            <x-slot name="heading">
                Batch Topics
                {{-- <a href="{{ route('batchs.topics.create', [$batch->id]) }}">Create Batch Topics</a> --}}
            </x-slot>
            
        </x-data-table>
    </div>
    

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>