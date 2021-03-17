<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property string $discount
 * @property string $max_use
 * @property string $start_date
 * @property string $end_date
 * @property string $use_count
 * @property string $status
 * @property float $total_apply
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property ApplyingCoupon[] $applyingCoupons
 * @property Order[] $orders
 */
class Coupon extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'code', 'type', 'discount', 'max_use', 'start_date', 'end_date', 'use_count', 'status', 'total_apply', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applyingCoupons()
    {
        return $this->hasMany('App\ApplyingCoupon');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
