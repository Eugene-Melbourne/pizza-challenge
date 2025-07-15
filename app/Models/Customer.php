<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property Pizza[] $pizzas
 */
class Customer extends Model
{
    protected $fillable = ['name'];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return HasMany<Pizza, Customer>
     */
    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class, 'customer_id');
    }
}
