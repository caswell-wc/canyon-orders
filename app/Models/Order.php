<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 * @package App\Models
 *
 * @property string $name
 * @property string $phone
 *
 * @property Collection orderProducts
 */
class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getTotalAttribute()
    {
        return $this->orderProducts->sum('total');
    }

    public function scopeNameFilter($query, $name)
    {
        return $query->where('name' , 'like', "%$name%");
    }
}
