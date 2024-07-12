<x-app-layout>

    <x-slot name="title">batch.create || Master Genesis Prototype v1</x-slot>
    <x-slot name="heading">batch.create</x-slot>


    <form 
        class="w-full mx-auto max-w-4xl p-4 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-6" 
        action="{{ route('batches.store')}}" 
        method="POST"
    >
        <h5 class="text-xl font-medium text-gray-900 dark:text-white text-center">Batch Create</h5>
        @method('POST')
        @csrf
        
        @include('batch.form')

    </form>


    @section('scripts')
        <!-- Your script here -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js" async></script>
    @endsection

</x-app-layout>