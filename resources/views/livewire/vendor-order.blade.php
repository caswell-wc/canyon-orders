<div class="md:flex md:justify-center my-4 md:my-6">
    <x-slot name="header">
        <div class="flex">
            <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">
                Vendor Order
            </h2>
            <div class="flex-1 flex items-center justify-center px-2 lg:ml-6 lg:justify-end">Total: ${{number_format($totalCost, 2)}}</div>
        </div>
    </x-slot>
    <div class="mx-auto">
        <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
            T-Shirts
        </h2>
        <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($colors as $colorKey => $color)
                <li class="col-span-1 flex shadow-sm rounded-md">
                <div
                    @class([
                        'flex-shrink-0',
                        'flex',
                        'items-center',
                        'text-center',
                        'justify-center',
                        'w-16',
                        'text-white',
                        'text-sm',
                        'font-medium',
                        'rounded-l-md',
                        'bg-yellow-500' => $colorKey === 'gold',
                        'bg-indigo-500' => $colorKey === 'navy_grey',
                        'bg-blue-400' => $colorKey === 'navy_pink',
                        'bg-pink-500' => $colorKey === 'safety_pink',
                        'bg-red-800' => $colorKey === 'maroon',
                        'bg-gray-500' => $colorKey === 'sports_grey',
                    ])
                    >
                    {{explode('w/', $color)[0]}}
                </div>
                <div class="flex-1 flex justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                    <div class="flex-1 px-4 py-2 text-sm truncate">
                        <a href="#" class="text-gray-900 font-medium hover:text-gray-600">
                            @if($colorKey === 'gold' || $colorKey === 'sports_grey')
                                White & Navy Logo
                            @elseif($colorKey === 'navy_grey' || $colorKey === 'safety_pink' || $colorKey === 'maroon')
                                White & Gray Logo
                            @elseif($colorKey === 'navy_pink')
                                White & Pink Logo
                            @endif
                        </a>
                        <div class="grid grid-cols-2">
                            <div class="col-span-1 text-center mr-2">
                                <p class="text-gray-900 border-b">Youth</p>
                                @foreach($sizes as $sizeKey => $size)
                                    @php
                                        $count = $tShirts->get($colorKey)->get('youth')->get($sizeKey);
                                    @endphp
                                    @if($count)
                                        <p class="text-gray-500">{{substr($size, 0, 3)}} - {{$count}}</p>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-span-1 text-center">
                                <p class="text-gray-900 border-b">Adult</p>
                                @foreach($sizes as $sizeKey => $size)
                                    @php
                                        $count = $tShirts->get($colorKey)->get('adult')->get($sizeKey);
                                    @endphp
                                    @if($count)
                                        <p class="text-gray-500">{{substr($size, 0, 3)}} - {{$count}}</p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

        <h2 class="max-w-6xl mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">
            Hoodies
        </h2>
        <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($colors as $colorKey => $color)
                <li class="col-span-1 flex shadow-sm rounded-md">
                    <div
                        @class([
                            'flex-shrink-0',
                            'flex',
                            'items-center',
                            'text-center',
                            'justify-center',
                            'w-16',
                            'text-white',
                            'text-sm',
                            'font-medium',
                            'rounded-l-md',
                            'bg-yellow-500' => $colorKey === 'gold',
                            'bg-indigo-500' => $colorKey === 'navy_grey',
                            'bg-blue-400' => $colorKey === 'navy_pink',
                            'bg-pink-500' => $colorKey === 'safety_pink',
                            'bg-red-800' => $colorKey === 'maroon',
                            'bg-gray-500' => $colorKey === 'sports_grey',
                        ])
                    >
                        {{explode('w/', $color)[0]}}
                    </div>
                    <div class="flex-1 flex justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                        <div class="flex-1 px-4 py-2 text-sm truncate">
                            <a href="#" class="text-gray-900 font-medium hover:text-gray-600">
                                @if($colorKey === 'gold' || $colorKey === 'sports_grey')
                                    White & Navy Logo
                                @elseif($colorKey === 'navy_grey' || $colorKey === 'safety_pink' || $colorKey === 'maroon')
                                    White & Gray Logo
                                @elseif($colorKey === 'navy_pink')
                                    White & Pink Logo
                                @endif
                            </a>
                            <div class="grid grid-cols-2">
                                <div class="col-span-1 text-center mr-2">
                                    <p class="text-gray-900 border-b">Youth</p>
                                    @foreach($sizes as $sizeKey => $size)
                                        @php
                                            $count = $hoodies->get($colorKey)->get('youth')->get($sizeKey);
                                        @endphp
                                        @if($count)
                                            <p class="text-gray-500">{{substr($size, 0, 3)}} - {{$count}}</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-span-1 text-center">
                                    <p class="text-gray-900 border-b">Adult</p>
                                    @foreach($sizes as $sizeKey => $size)
                                        @php
                                            $count = $hoodies->get($colorKey)->get('adult')->get($sizeKey);
                                        @endphp
                                        @if($count)
                                            <p class="text-gray-500">{{substr($size, 0, 3)}} - {{$count}}</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
