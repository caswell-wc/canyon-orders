<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;

class OrderProductForm extends Component
{
    public int $index;
    public OrderProduct $orderProduct;
    public array $products = OrderProduct::PRODUCTS;
    public array $colors = OrderProduct::COLORS;
    public array $sizeTypes = OrderProduct::SIZE_TYPES;
    public array $sizes = OrderProduct::SIZES;

    #[ArrayShape(['orderProduct.product'   => "array",
                  'orderProduct.color'     => "array",
                  'orderProduct.size_type' => "array",
                  'orderProduct.size'      => "array",
                  'orderProduct.qty'       => "string[]"
    ])]
    protected function rules(): array
    {
        return [
            'orderProduct.product' => ['required', Rule::in(array_keys($this->products))],
            'orderProduct.color' => ['required', Rule::in(array_keys($this->colors))],
            'orderProduct.size_type' => ['required', Rule::in(array_keys($this->sizeTypes))],
            'orderProduct.size' => ['required', Rule::in(array_keys($this->sizes))],
            'orderProduct.qty' => ['required', 'integer', 'min:1'],
        ];
    }

    public function updated($name, $value): void
    {
        if (str_contains($name, '.')) {
            $name = explode('.', $name)[1];
        }
        $this->emit('orderProductUpdated', $this->index, $name, $value);
    }

    public function updatedOrderProductSizeType(): void
    {
        if (!empty($this->orderProduct->product)) {
            $this->updateSizes();
        }
    }

    public function updatedOrderProductProduct(): void
    {
        if (!empty($this->orderProduct['size_type'])) {
            $this->updateSizes();
        }
    }

    public function getTotalProperty(): string
    {
        return number_format($this->orderProduct->total, 2);
    }

    public function render(): View
    {
        return view('livewire.order-product-form');
    }

    protected function updateSizes(): void
    {
        $this->sizes = OrderProduct::getSizes($this->orderProduct->size_type, $this->orderProduct->product);
    }
}
