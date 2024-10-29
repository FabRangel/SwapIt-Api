<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id_user',
        'category',
        'name',
        'description',
        'is_new',
        'funcionality',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'interest_categories',
        'status',
    ];
    
    protected $casts = [
        'is_new' => 'boolean',
        'funcionality' => 'integer',
        'interest_categories' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}