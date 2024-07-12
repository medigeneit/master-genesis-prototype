<div class="flex justify-center gap-4">
    <form action="{{ route('modules.topics.destroy', [$module->id, $module_topic->id] ) }}" method="POST" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button 
            href="{{ route('modules.topics.destroy', [$module->id, $module_topic->id] ) }}" 
            class="border rounded bg-green-600 px-2 py-0.5 shadow-sm text-white"
        >Remove</button>
    </form>
</div>