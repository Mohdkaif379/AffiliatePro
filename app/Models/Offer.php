<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';
    protected $fillable = [
        'offer_title',
        'description',
        'offer_category',
        'offer_url',
        'random_url',
        'advertiser_name',
        'advertiser_price',
        'affiliate_price',
        'schedule',
        'device_brand',
        'os_version',
        'operating_system',
        'device',
        'country',
        'state',
        'city',
        'user_language',
        'browser',
        'upload_file',
        'terms_conditions',
        'status',
    ];
    protected $casts = [
        'advertiser_price' => 'decimal:2',
        'affiliate_price'  => 'decimal:2',
        'schedule'       => 'date',

    ];

    // App\Models\Offer.php
    public function advertiser()
    {
        return $this->belongsTo(User::class, 'advertiser_name', 'id');
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'assigned_offers', 'offer_id', 'user_id');
    }
}
