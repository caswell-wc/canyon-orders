<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderProduct
 * @package App\Models
 *
 * @property int $id
 * @property string $product
 * @property string $color
 * @property string $size_type
 * @property string $size
 * @property int $qty
 * @property float $total
 */
class OrderProduct extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const PRODUCTS = ['hoodie' => 'Hoodie', 't_shirt' => 'T-Shirt'];
    public const COLORS = [
        'gold' => 'Gold',
        'navy_grey' => 'Navy w/ Grey Logo',
        'navy_pink' => 'Navy w/ Pink Logo',
        'safety_pink' => 'Safety Pink',
        'maroon' => 'Maroon',
        'sports_grey' => 'Sports Grey'
    ];
    public const SIZE_TYPES = ['youth' => 'Youth', 'adult' => 'Adult'];
    public const SIZES = [
        'xs' => 'XS',
        's' => 'S',
        'm' => 'M',
        'l' => 'L',
        'xl' => 'XL',
        '2xl' => '2XL (+$2.00)',
        '3xl' => '3XL (+$4.00)',
        '4xl' => '4XL (+$6.00)',
    ];

    public function getTotalAttribute(): float
    {
        $basePrice = match($this->product) {
            't_shirt' => 9,
            'hoodie' => 25,
            default => 0
        };
        $sizeAdjustment = match($this->size) {
            '2xl' => 2,
            '3xl' => 4,
            '4xl' => 6,
            default => 0
        };
        return ($basePrice + $sizeAdjustment) * $this->qty;
    }

    public static function getSizes(string $size_type, string $product): array
    {
        if ($size_type === 'adult') {
            return [
                's'   => 'S',
                'm'   => 'M',
                'l'   => 'L',
                'xl'  => 'XL',
                '2xl' => '2XL (+$2)',
                '3xl' => '3XL (+$4)',
                '4xl' => '4XL (+$6)'
            ];
        } else {
            return match($product) {
                't_shirt' => ['xs' => 'XS', 's' => 'S', 'm' => 'M', 'l' => 'L', 'xl' => 'XL'],
                'hoodie' => ['m' => 'M', 'l' => 'L', 'xl' => 'XL']
            };
        }
    }
}
