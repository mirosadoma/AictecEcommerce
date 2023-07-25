<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;
    protected $table = "users";
    protected $dates = ['deleted_at'];
    Protected $guard_name ='admin';
    protected $guarded = ['id'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
    public function getImagePathAttribute()
    {
        return $this->image ? url($this->image) : url('assets/admin/app-assets/images/portrait/small/avatar-s-11.jpg');
    }
    public function notfs()
    {
        return $this->hasMany(Notification::class);
    }
}
