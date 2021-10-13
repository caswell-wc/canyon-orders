<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = $this->faker->randomElement(['hoodie', 't_shirt']);
        $sizeType = $this->faker->randomElement(['adult', 'youth']);
        $sizes = array_keys(OrderProduct::getSizes($sizeType, $product));
        return [
            'order_id' => Order::factory(),
            'product' => $product,
            'color' => $this->faker->randomElement([
                'gold',
                'navy_grey',
                'navy_pink',
                'safety_pink',
                'maroon',
                'sports_grey'
            ]),
            'size_type' => $sizeType,
            'size' => $this->faker->randomElement($sizes),
            'qty' => $this->faker->numberBetween(1, 5)
        ];
    }
}
