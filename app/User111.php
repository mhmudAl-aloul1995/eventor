<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $country_id
 * @property integer $city_id
 * @property string $name
 * @property string $email
 * @property string $phone_code
 * @property string $phone
 * @property string $location
 * @property string $address
 * @property string $address_id
 * @property string $email_verified_at
 * @property string $password
 * @property string $image
 * @property string $remember_token
 * @property string $terms_condations
 * @property string $verify
 * @property string $status
 * @property string $lat
 * @property string $long
 * @property string $enable_notification
 * @property string $enable_location
 * @property string $last_login
 * @property string $ip_number
 * @property string $gender
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property City $city
 * @property Country $country
 * @property AdminNotification[] $adminNotifications
 * @property CustomerPayment[] $customerPayments
 * @property Notification[] $notifications
 * @property Order[] $orders
 */
class User11 extends Model
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
    protected $fillable = ['country_id', 'city_id', 'name', 'email', 'phone_code', 'phone', 'location', 'address', 'address_id', 'email_verified_at', 'password', 'image', 'remember_token', 'terms_condations', 'verify', 'status', 'lat', 'long', 'enable_notification', 'enable_location', 'last_login', 'ip_number', 'gender', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adminNotifications()
    {
        return $this->hasMany('App\AdminNotification');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customerPayments()
    {
        return $this->hasMany('App\CustomerPayment', 'customer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Order', 'customer_id');
    }
}
