<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $key
 * @property Pizza[] $pizzas
 */
class PizzaStatus extends Model
{
    public const KEY_ORDER_PLACED = 'order_placed';

    public const KEY_STARTED = 'started';

    public const KEY_IN_OVEN = 'in_oven';

    public const KEY_READY = 'ready';

    public const KEY_DISPATCHED = 'dispatched';

    public const ORDER = [
        self::KEY_ORDER_PLACED,
        self::KEY_STARTED,
        self::KEY_IN_OVEN,
        self::KEY_READY,
        self::KEY_DISPATCHED,
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public $timestamps = false;

    protected $fillable = ['key'];

    /**
     * @return HasMany<Pizza, PizzaStatus>
     */
    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class, 'status_is');
    }

    public function isLastStatus(): bool
    {
        $order = self::ORDER;

        return $this->key === end($order);
    }

    public function getIndex(): int
    {
        $index = array_search($this->key, self::ORDER, true);
        if (! is_int($index)) {
            throw new \RuntimeException('Index should be integer, got type'.gettype($index).'.');
        }

        return $index;
    }

    public static function getNextStatusKey(string $key): ?string
    {
        $currentIndex = array_search($key, self::ORDER, true);
        if (! is_int($currentIndex)) {
            throw new \RuntimeException('Index should be integer, got type'.gettype($currentIndex).'.');
        }
        if ($currentIndex === count(self::ORDER) - 1) {
            return null;
        }

        return self::ORDER[$currentIndex + 1];
    }

    public static function getByKey(string $key): ?self
    {
        return self::query()->where('key', $key)->first();
    }
}
