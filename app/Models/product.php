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
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

     // Setter para interest_categories
     public function setInterestCategoriesAttribute($value)
     {
         if (is_array($value)) {
             // Convertir array a cadena separada por comas
             $this->attributes['interest_categories'] = implode(',', $value);
         } else {
             // Si ya es un string, asegurarse de que esté bien formateado
             $this->attributes['interest_categories'] = $value;
         }
     }
 
     // Getter para interest_categories (si quieres devolverlo como array cuando lo accedas)
     public function getInterestCategoriesAttribute($value)
     {
         return explode(',', $value);  // Convierte la cadena separada por comas en un array
     }


}
