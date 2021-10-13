<div
    x-data="{isOpen: @entangle('showModal')}"
    x-show="isOpen"
    class="fixed z-10 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-6 text-center sm:block sm:p-0">
        <div
            x-show="isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div
            x-show="isOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:p-6">
            <div>
                <div class="my-2 text-gray-800 border-b">Update Order</div>
                <form class="px-2 divide-y divide-gray-200 mt-4">
                    <div class="space-y-8 divide-y divide-gray-200">
                        <div>
                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                    <x-input.text
                                        type="text"
                                        wire:model.lazy="order.name"
                                        name="name"
                                        label="Name"
                                        :errors="$errors->get('name')" />
                                </div>
                                <div class="sm:col-span-4">
                                    <x-input.text
                                        wire:model.lazy="order.phone"
                                        type="tel"
                                        name="phone"
                                        label="Phone Number"
                                        :errors="$errors->get('name')" />
                                </div>
                            </div>
                        </div>

                        <div class="pt-8">
                            <div>
                                @foreach($orderProducts as $index => $orderProduct)
                                    <livewire:order-product-form :index="$index" :order-product="$orderProduct" wire:key="order-product-{{$index}}"/>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                <a wire:click="addProduct" class="flex text-center text-indigo-700 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="ml-1">Add New Product</span>
                                </a>
                                <div class="flex justify-end">
                                    <span class="font-semibold font-medium">Total:</span>
                                    <span class="ml-2 text-center">${{$this->total}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-end">
                            <button
                                @click="isOpen = false"
                                type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </button>
                            <button
                                wire:click.prevent="update"
                                type="submit"
                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm
                                    font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none
                                    focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
