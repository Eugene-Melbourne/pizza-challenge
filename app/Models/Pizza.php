<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $status_id
 * @property \Carbon\Carbon|null $status_set_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property Customer|null $customer
 * @property PizzaStatus|null $status
 */
class Pizza extends Model
{
    protected $fillable = [
        'customer_id',
        'status_id',
        'status_set_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'status_id' => 'integer',
        'status_set_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<PizzaStatus, Pizza>
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(PizzaStatus::class, 'status_id');
    }

    /**
     * @return BelongsTo<Customer, Pizza>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
