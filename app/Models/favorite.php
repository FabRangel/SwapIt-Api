<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class favorite extends Model
{
    protected $table = 'favorites';

    protected $fillable = [
        'id_user',
        'id_product',
        'date_added',
    ];

    protected $casts = [
        'date_added' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
