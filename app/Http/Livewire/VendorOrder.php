<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Collection;
use Livewire\Component;

class VendorOrder extends Component
{

    public Collection $tShirts;
    public Collection $hoodies;
    /**
     * @var string[]
     */
    public array $colors;
    /**
     * @var string[]
     */
    public array $sizes;
    public float $totalCost;

    public function mount()
    {
        $this->tShirts = OrderProduct::where('product', 't_shirt')
            ->get()
            ->groupBy('color')
            ->mapWithKeys(function($collection, $index) {
                return [
                    $index => $collection->groupBy('size_type')->mapWithKeys(
                        function ($collection, $index) {
                            return [$index => $collection->countBy('size')];
                        }
                    )
                ];
            });
        $this->hoodies = OrderProduct::where('product', 'hoodie')
            ->get()
            ->groupBy('color')
            ->mapWithKeys(function($collection, $index) {
                return [
                    $index => $collection->groupBy('size_type')->mapWithKeys(
                        function ($collection, $index) {
                            return [$index => $collection->countBy('size')];
                        }
                    )
                ];
            });
        $this->colors = OrderProduct::COLORS;
        $this->sizes = OrderProduct::SIZES;
        $this->totalCost = Order::all()->load('orderProducts')->sum('total');
    }

    public function render()
    {
        return view('livewire.vendor-order');
    }
}
