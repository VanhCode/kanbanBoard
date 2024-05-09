<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardDetail extends Model
{
    use HasFactory;
    protected $table = 'board_detail';
    protected $fillable = [
        'board_id',
        'member_id'
    ];
}
