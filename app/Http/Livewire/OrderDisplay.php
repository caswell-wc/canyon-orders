<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderProduct;
use Livewire\Component;

class OrderDisplay extends Component
{
    public ?Order $order;
    public bool $showWindow = false;

    protected $listeners = ['orderSelected'];

    public function orderSelected($orderId)
    {
            $this->order = Order::find($orderId);
            $this->showWindow = true;
    }

    public function getDisplayValue($field, $value): string
    {
        return match ($field) {
            'product' => OrderProduct::PRODUCTS[$value],
            'size_type' => OrderProduct::SIZE_TYPES[$value],
            'size' => OrderProduct::SIZES[$value],
            'color' => OrderProduct::COLORS[$value]
        };
    }

    public function render()
    {
        return view('livewire.order-display');
    }
}
