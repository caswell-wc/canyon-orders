<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditOrder extends Component
{
    public bool $showModal = false;
    protected $listeners = ['updateOrder', 'orderProductUpdated', 'deleteProduct'];
    public ?Order $order = null;
    public Collection $orderProducts;
    public float $orderTotal = 0;

    protected array $rules = [
        'order.name' => 'string|required',
        'order.phone' => 'string|required'
    ];

    public function mount()
    {
        $this->orderProducts = collect();
    }

    public function updateOrder(int $orderId)
    {
        $this->order = Order::find($orderId)->load('orderProducts');
        $this->orderTotal = $this->order->total;
        $this->orderProducts = collect();
        $this->order->orderProducts->each(function(OrderProduct $orderProduct) {
            $this->orderProducts->push($orderProduct);
        });
        $this->showModal = true;
    }

    public function addProduct(): void
    {
        $this->orderProducts->push(OrderProduct::make([
            'product' => '',
            'color' => '',
            'size_type' => '',
            'size' => '',
            'qty' => 1
        ]));
    }

    public function deleteProduct($index)
    {
        $this->orderProducts->pull($index);
        $this->resetTotal();
    }

    public function orderProductUpdated($index, $field, $value)
    {
        $orderProduct = $this->orderProducts->get($index);
        $orderProduct[$field] = $value;
        $this->orderProducts->put($index, $orderProduct);
        $this->resetTotal();
    }

    public function update()
    {
        $this->order->orderProducts()
            ->whereNotIn('id', $this->orderProducts->pluck('id')->filter(function($id){
                return !empty($id);
            }))
            ->delete();
        $this->orderProducts->each(function($orderProduct) {
            if(is_array($orderProduct)) {
                if(array_key_exists('id', $orderProduct)) {
                    $orderProductObj = $this->order->orderProducts->firstWhere('id', $orderProduct['id']);
                    $orderProduct = $orderProductObj->fill($orderProduct);
                } else {
                    $orderProduct = OrderProduct::make($orderProduct);
                }
            }
            if (empty($orderProduct->order_id)) {
                $this->order->orderProducts()->save($orderProduct);
            } else {
                $orderProduct->save();
            }
        });
        $this->order->save();
        $this->showModal = false;
        $this->emit('orderUpdated');
    }

    public function getTotalProperty()
    {
        return number_format($this->orderTotal, 2);
    }

    public function render()
    {
        return view('livewire.edit-order');
    }

    private function resetTotal(): void
    {
        $this->orderTotal = $this->orderProducts->sum(
            function ($orderProduct) {
                if (is_array($orderProduct)) {
                    $orderProduct = OrderProduct::make($orderProduct);
                }
                return $orderProduct->total;
            }
        );
    }
}
