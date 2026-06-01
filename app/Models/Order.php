<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'name',
        'phone',
        'whatsapp',
        'email',
        'address',
        'landmark',
        'city',
        'state',
        'pincode',
        'subtotal',
        'discount_amount',
        'net_amount',
        'payment_status',
        'order_status',
        'transport_name',
        'lr_number',
        'notes',
    ];

    /**
     * Auto-generate order number on creation.
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ATC-' . date('Ymd') . '-' . strtoupper(Str::random(5));
            }
        });
    }

    /**
     * Get line items for this order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get a color badge class for the order status.
     */
    public function getOrderStatusBadgeAttribute(): string
    {
        return match ($this->order_status) {
            'pending' => 'bg-warning text-dark',
            'approved' => 'bg-info text-white',
            'processing' => 'bg-primary text-white',
            'shipped' => 'bg-purple text-white', // custom purple
            'delivered' => 'bg-success text-white',
            'cancelled' => 'bg-danger text-white',
            default => 'bg-secondary text-white',
        };
    }

    /**
     * Get a color badge class for the payment status.
     */
    public function getPaymentStatusBadgeAttribute(): string
    {
        return match ($this->payment_status) {
            'pending' => 'bg-danger text-white',
            'paid' => 'bg-success text-white',
            'verified' => 'bg-success text-white',
            default => 'bg-secondary text-white',
        };
    }
}
