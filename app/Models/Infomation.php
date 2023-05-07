<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infomation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id_from',
        'tweet_id',
        'infomation_type',
        'infomation_id'
    ];
}
