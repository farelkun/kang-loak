<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kyc extends Model
{
    use HasFactory;

    protected $table = 'kyc';

    protected $fillable = [
        'user_id',
        'address',
        'place_of_birth',
        'date_of_birth',
        'id_card_attachment',
        'selfie_id_card_attachment',
        'approval',
        'message',
        'step'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
