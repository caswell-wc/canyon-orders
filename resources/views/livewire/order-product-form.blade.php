<div class="w-full flex flex-col md:flex-row md:w-3/4" >
    <x-input.select
        placeholder="Choose Product..."
        required
        wire:model.lazy="orderProduct.product"
        class="md:flex-shrink-0"
        label="Product"
        name="product"
        :options="$products" />
    <x-input.select
        placeholder="Choose Color..."
        required
        wire:model.lazy="orderProduct.color"
        class="md:flex-shrink-0 md:ml-2"
        label="Color"
        name="color"
        :options="$colors" />
    <x-input.select
        placeholder="Choose Size Category..."
        required
        wire:model.lazy="orderProduct.size_type"
        class="md:flex-shrink-0 md:ml-2"
        label="Size Category"
        name="size_type"
        :options="$sizeTypes" />
    <x-input.select
        placeholder="Choose Size..."
        required
        wire:model.lazy="orderProduct.size"
        class="md:flex-shrink-0 md:ml-2"
        label="Size"
        name="size"
        :options="$sizes" />
    <x-input.text
        class="md:flex-shrink-0 md:ml-2"
        wire:model.lazy="orderProduct.qty"
        type="number"
        name="qty"
        label="Quantity"
        :errors="$errors->get('orderProduct.qty')" />
    <div class="md:flex-shrink-0 md:ml-2">
        <p class="text-sm font-medium text-gray-900">Total:</p>
        <p class="text-sm text-gray-500 mt-3">${{$this->total}}</p>
    </div>
    <div class="flex items-center justify-center ml-6">
        <a href="#" wire:click="$emit('deleteProduct', {{$index}})">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500 text-2xl" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
    </div>
</div>
