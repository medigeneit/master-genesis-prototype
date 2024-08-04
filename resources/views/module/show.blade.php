<x-app-layout>

    <x-slot name="title">module.show || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">module.index</x-slot>

    <div>
        <h2>Module</h2>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-10 mt-2">
            <tbody>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border">Module Name</th>
                    <td scope="col" class="px-6 py-3 border">{{ $module->name }}</td>
                </tr>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border">Clases</th>
                    <td scope="col" class="px-6 py-3 border">{!!  $module->has_lecture ? '&check;':''; !!}</td>
                </tr>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border">Feedback Clases</th>
                    <td scope="col" class="px-6 py-3 border">{!!  $module->has_feedback ? '&check;':''; !!}</td>
                </tr>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border">Exams</th>
                    <td scope="col" class="px-6 py-3 border">{!!  $module->has_exam ? '&check;':''; !!}</td>
                </tr>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border">Solve Clases</th>
                    <td scope="col" class="px-6 py-3 border">{!!  $module->has_solve ? '&check;':''; !!}</td>
                </tr>

                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    <th scope="col" class="px-6 py-3 border">Batches</th>
                    <td scope="col" class="px-6 py-3 border">
                        <div class="rounded px-3 py-0.5 bg-green-600 inline">
                            {!!  $module->batches->count() !!}
                        </div>

                    </td>
                </tr>


            </tbody>
        </table>


        <x-data-table 
            :items="$module_contents" 
            :columns="$module_content_columns"
        >
            <x-slot name="heading">
                Module Cotents
            </x-slot>
        </x-data-table>

        {{-- <x-data-table 
            :items="$module_topics" 
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
                    'valueKey' => function($module_topic) use($module){
                        return view('module.module-topics-list-action', compact('module','module_topic'));
                    },
                    'label' => 'Action',
                    'th_class' => 'text-center',
                    'td_class' => 'text-center bg-green-100 dark:bg-green-600/20'
                ],



            ]"
            >
            <x-slot name="heading">
                Module Topics
                <a href="{{ route('modules.topics.create', [$module->id]) }}">Create Module Topics</a>
            </x-slot>
            
        </x-data-table> --}}
    </div>
    

    @section('scripts')
        <!-- Your script here -->
    @endsection

</x-app-layout>