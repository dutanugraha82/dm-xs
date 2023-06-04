<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;
    protected $table = 'results';
    protected $fillable =
    [
        'users_id',
        'conclusion',
        'status_dm',
    ];

    public function users(){
        return $this->belongsTo(User::class,'id');
    }
}
