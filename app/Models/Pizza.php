<?php

namespace App\Models;

use App\Events\PizzaStatusUpdated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function event;

/**
 * @property int $id
 * @property int $customer_id
 * @property int $status_id
 * @property Carbon|null $status_set_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Customer|null $customer
 * @property PizzaStatus|null $status
 */
class Pizza extends Model
{
    /**
     * @use \Illuminate\Database\Eloquent\Factories\HasFactory<\Database\Factories\PizzaFactory>
     */
    use HasFactory;

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

    protected static function booted()
    {
        static::updated(function ($pizza) {
            if ($pizza->isDirty('status_id')) {
                event(new PizzaStatusUpdated($pizza));
            }
        });
    }

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
