<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DeleteOrder extends Component
{

    protected $listeners = ['deleteOrder'];
    /** @var Order|null */
    public ?Order $order = null;
    /** @var bool */
    public bool $showModal = false;

    public function deleteOrder($orderId)
    {
        $this->order = Order::find($orderId);
        $this->showModal = true;
    }

    public function delete()
    {
        if (Auth::guest()) {
            return $this->redirectRoute('login');
        }
        $orderId = $this->order->id;
        $this->order->delete();
        $this->reset();
        $this->emit('orderDeleted', $orderId);
    }

    public function render()
    {
        return view('livewire.delete-order');
    }
}
