<x-app-layout>

    <x-slot name="title">booking.create || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">booking.create</x-slot>


    <form 
        class="w-full mx-auto max-w-4xl p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-6" 
        action="{{ route('modules.topics.store', [$module->id])}}" 
        method="POST"
    >
        <h5 class="text-xl font-medium text-gray-900 dark:text-white text-center">Module Topic Assign</h5>
        @method('POST')
        @csrf
        
       
        <div class="w-full">

            <div class="mb-5">
                <div class="font-semibold">
                    Module
                </div>
                <div class="text-lg border-b dark:border-gray-600">
                    {{ $module->name }}
                </div>
            </div>
        
            

            <x-input-dropdown
                label="Topics"
                :items="$topics"
                name="topic_ids[]"
                multiple
            />
    
            <ul>
                @foreach ($errors->get('room_id.*') as $error)
                    @foreach ($error as $message)
                        <li class="text-red-500">{{ $message }}</li>
                    @endforeach
                @endforeach
            </ul>
    
            <div class="mt-8 flex justify-between">
                <a href="{{ route('modules.show', [$module->id]) }}" class="px-4 py-2 bg-sky-600 rounded font-semibold">Back</a>
                <button type="submit" class="px-4 py-2 bg-sky-600 rounded font-semibold">Assign Topics</button>
            </div>
            
        </div>
        

    </form>


    @section('scripts')
        <!-- Your script here -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js" async></script>
    @endsection

</x-app-layout>