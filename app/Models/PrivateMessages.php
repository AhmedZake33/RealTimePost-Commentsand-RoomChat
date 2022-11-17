<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMessages extends Model
{
    use HasFactory;
    protected $table = 'private_messages';
    public $fillable = ['sender_id','recived_id','message'];
}
