<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'user_id',
        'ip_address',
        'user_agent',
        'type',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
