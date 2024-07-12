@props(['items','columns', 'resourceBase','showCreateButton'])

 
<div class="relative overflow-x-auto shadow-md sm:rounded ">
    
    @if(isset($heading))
        <div class="py-2 px-4 bg-gray-200 dark:text-white dark:bg-gray-700 flex gap-4 items-cebter">
            @if($showCreateButton ?? false)
                <a href="/{{ $resourceBase }}/create" class="rounded-full h-6 w-6 border  text-center leading-[20px]">+</a>
            @endif
            <div class="text-lg font-semibold flex-grow">{!! $heading !!}</div>
        </div>
    @endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
            <tr>

                @foreach ($columns as $col)
                    <th scope="col" class="px-6 py-3 {{ $col['th_class'] ?? '' }}">
                        {{ $col['label']  }}
                    </th>                    
                @endforeach

            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr class="bg-white dark:text-gray-300 border-b dark:bg-gray-600 dark:border-gray-700">
                    @foreach ($columns as $col)
                        <td scope="col" class="px-6 py-3 {{ $col['td_class'] ?? '' }}">
                            @if (is_callable($col['valueKey']))
                                {!! $col['valueKey']($item) !!}
                            @else
                                {{ $item[ $col['valueKey']] }}
                            @endif
                        </td>                    
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td  colspan="10" class="text-center py-2 px-1">...No Data Found...</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
