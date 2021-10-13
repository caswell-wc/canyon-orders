<div
    x-data="{isOpen: @entangle('showWindow')}"
    x-show="isOpen"
    class="fixed inset-0 overflow-hidden"
    aria-labelledby="slide-over-title"
    role="dialog"
    aria-modal="true">
    <div class="absolute inset-0 overflow-hidden">
        <div @click="isOpen = false" class="absolute inset-0" aria-hidden="true">
            <div class="fixed inset-y-0 right-0 pl-10 max-w-full flex">
                <div
                    x-show="isOpen"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="w-screen max-w-md">
                    <div class="h-full flex flex-col py-6 bg-white shadow-xl overflow-y-scroll">
                        <div class="px-4 sm:px-6">
                            <div class="flex items-start justify-between">
                                <h2 class="text-lg font-bold text-gray-900 sm:text-2xl" id="slide-over-title">
                                    @if(!empty($this->order)) {{$this->order->name}} @endif
                                </h2>
                                <div class="ml-3 h-7 flex items-center">
                                    <button
                                        @click="isOpen = false"
                                        type="button"
                                        class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none
                                            focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <span class="sr-only">Close panel</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 relative flex-1 px-4 sm:px-6">
                            @if(!empty($this->order))
                                <div>
                                    <p class="text-sm text-gray-500">{{$order->phone}}</p>
                                    <div class="flex items-center mt-4">
                                        <h4 class="text-lg font-semibold text-gray-900">Items Ordered:</h4>
                                    </div>
                                    <ul role="list" class="divide-y divide-gray-200">
                                        @foreach($order->orderProducts as $orderProduct)
                                            <li class="relative bg-white py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600">
                                                <div class="flex justify-between space-x-3">
                                                    <div class="min-w-0 flex-1">
                                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                                        <p class="text-sm font-medium text-gray-900">
                                                            {{$this->getDisplayValue('product', $orderProduct->product)}} - {{$orderProduct->qty}}
                                                        </p>
                                                        <p class="text-sm text-gray-500">{{$this->getDisplayValue('color', $orderProduct->color)}}</p>
                                                        <p class="text-sm text-gray-500">
                                                            {{$this->getDisplayValue('size_type', $orderProduct->size_type)}}
                                                            - {{$this->getDisplayValue('size', $orderProduct->size)}}
                                                        </p>
                                                    </div>
                                                    <div class="flex-shrink-0 whitespace-nowrap text-sm text-gray-500">
                                                        ${{number_format($orderProduct->total, 2)}}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="flex justify-between border-t border-gray-300 mt-2">
                                        <div class="flex-1">Total:</div>
                                        <div class="text-gray-700">${{number_format($order->total, 2)}}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
