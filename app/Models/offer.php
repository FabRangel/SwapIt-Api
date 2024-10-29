<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    protected $table = 'offers';

    protected $fillable = [
        'id_product',
        'id_user_offer',
        'id_product_offered',
        'status_offer',
        'offer_date',
    ];

    protected $casts = [
        'offer_date' => 'datetime',
    ];

    public function productOffered()
    {
        return $this->belongsTo(Product::class, 'id_product_offered');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function userOffer()
    {
        return $this->belongsTo(User::class, 'id_user_offer');
    }
}
