<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'id_user',
        'message_type',
        'description',
        'seen',
        'date_message',
        'id_recipient',
    ];

    protected $casts = [
        'seen' => 'boolean',
        'date_message' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'id_recipient');
    }
}
