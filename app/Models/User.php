<?php

namespace App\Models;

use App\Models\Addressess\Address;
use App\Models\Orders\Order;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Products\Product;
use Str;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;
    protected $table = "users";
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    Protected $guard_name ='admin';
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
    public function getImagePathAttribute()
    {
        return $this->image ? url($this->image) : url('assets/logo.png');
    }

    public function getFullPhoneAttribute()
    {
        $full_phone = $this->phone;
        if (Str::length($this->phone) == 9) {
            $full_phone = '+966'.$this->phone;
        }elseif (Str::length($this->phone) == 10) {
            $full_phone = '+966'.substr($this->phone, 1);
        }elseif (Str::length($this->phone) == 12) {
            $full_phone = $this->phone;
        }
        return $full_phone;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'user_id');
    }

    public function addressess()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites', 'user_id', 'product_id');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
