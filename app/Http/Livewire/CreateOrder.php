<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateOrder extends Component
{
    public string $name = '';
    public string $phone = '';
    public Collection $orderProducts;
    public float $rawTotal = 0;

    protected $listeners = ['orderProductUpdated', 'deleteProduct'];

    protected array $rules = [
        'name' => 'string|required',
        'phone' => 'string|required'
    ];

    public function mount(): void
    {
        $this->orderProducts = collect();
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
    }

    public function orderProductUpdated($index, $field, $value): void
    {
        $orderProduct = $this->orderProducts->get($index);
        $orderProduct[$field] = $value;
        $this->orderProducts[$index] = $orderProduct;

        $this->rawTotal = $this->orderProducts->sum(function($orderProduct){
            if (is_array($orderProduct)) {
                $orderProduct = OrderProduct::make($orderProduct);
            }
            return $orderProduct->total;
        });
    }

    public function getTotalProperty(): string
    {
        return number_format($this->rawTotal, 2);
    }

    public function saveOrder()
    {
        $this->validate();
        DB::transaction(function() {
            $order = Order::create([
                'name' => $this->name,
                'phone' => $this->phone
            ]);
            $this->orderProducts->each(function($orderProduct) use ($order) {
                if (is_array($orderProduct)) {
                    $orderProduct = OrderProduct::make($orderProduct);
                }
                $order->orderProducts()->save($orderProduct);
            });
        });

        session()->flash('message', 'Order has been Created!!');
        $this->reset(['name', 'phone']);
        $this->orderProducts = collect();
    }

    public function render(): View
    {
        return view('livewire.create-order');
    }
}
