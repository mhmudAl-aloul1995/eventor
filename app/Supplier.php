<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $location
 * @property string $phone
 * @property string $email
 * @property string $website
 * @property string $description
 * @property string $logo
 * @property string $favicon
 * @property float $balance
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property OrdersDtl[] $ordersDtls
 * @property Service[] $services
 * @property SupplierPayment[] $supplierPayments
 */
class Supplier extends Model
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
    protected $fillable = ['name', 'address', 'location', 'phone', 'email', 'website', 'description', 'logo', 'favicon', 'balance', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordersDtls()
    {
        return $this->hasMany('App\OrdersDtl');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany('App\Service');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplierPayments()
    {
        return $this->hasMany('App\SupplierPayment');
    }
}
