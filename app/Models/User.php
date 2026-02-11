<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'company_name',
        'mobile_no',
        'email',
        'password',
        'status',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    
    public function roleDetail()
    {
        return $this->belongsTo(Role::class, 'role', 'id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'advertiser_name', 'id');
    }

    public function assignedOffers()
    {
        return $this->belongsToMany(Offer::class, 'assigned_offers', 'user_id', 'offer_id');
    }

    public function userPermission()
    {
        return $this->hasOne(UserPermission::class);
    }
}
