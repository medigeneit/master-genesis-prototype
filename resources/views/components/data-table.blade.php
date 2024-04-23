@props(['items','columns'])

 
<div class="relative overflow-x-auto shadow-md sm:rounded border">
    @if(isset($heading))
        <div class="py-2 px-4 bg-gray-200 dark:text-white dark:bg-gray-800">
            <div class="text-lg font-semibold">{!! $heading !!}</div>
        </div>
    @endif

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>

                @foreach ($columns as $col)
                    <th scope="col" class="px-6 py-3">
                        {{ $col['label']  }}
                    </th>                    
                @endforeach

            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    @foreach ($columns as $col)
                        <td scope="col" class="px-6 py-3">
                            @if (is_callable($col['valueKey']))
                                {!! $col['valueKey']($item) !!}
                            @else
                                {{    $item[ $col['valueKey'] ]  }}
                            @endif
                            
                        </td>                    
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td  colspan="10">...No Data Found...</td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>
