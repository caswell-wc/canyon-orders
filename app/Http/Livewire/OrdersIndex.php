<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersIndex extends Component
{
    use WithPagination;

    public string $search = '';
    protected $listeners = ['searchUpdated', 'orderDeleted' => 'resetPage', 'orderUpdated' => 'resetPage'];

    private const ORDERS_PER_PAGE = 15;

    public function searchUpdated($search): void
    {
        $this->search = $search;
        $this->resetPage();
    }

    public function render()
    {
        $orders = Order::with('orderProducts');
        if ($this->search) {
            $orders->nameFilter($this->search);
        }
        return view('livewire.orders-index', [
            'orders' => $orders->paginate(self::ORDERS_PER_PAGE)
        ]);
    }
}
