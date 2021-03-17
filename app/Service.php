<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $supplier_id
 * @property string $name
 * @property string $description
 * @property string $priority
 * @property float $price
 * @property boolean $is_vat
 * @property string $vat_no
 * @property string $Infants_from
 * @property string $Infants_to
 * @property string $children_from
 * @property string $children_to
 * @property string $Adults_from
 * @property string $Adults_to
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Supplier $supplier
 * @property ServicesBooking[] $servicesBookings
 * @property ServicesDetail[] $servicesDetails
 */
class Service extends Model
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
    protected $fillable = ['supplier_id', 'name', 'description', 'priority', 'price', 'is_vat', 'vat_no', 'Infants_from', 'Infants_to', 'children_from', 'children_to', 'Adults_from', 'Adults_to', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicesBookings()
    {
        return $this->hasMany('App\ServicesBooking', 'services_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicesDetails()
    {
        return $this->hasMany('App\ServicesDetail');
    }
}
