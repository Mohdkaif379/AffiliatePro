<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedOffer extends Model
{
    use HasFactory;

    protected $table = 'assigned_offers'; // explicit table name

    protected $fillable = [
        'offer_id',
        'user_id',
    ];

    // If you want timestamps
    public $timestamps = true;

    // Relation to Offer
    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
