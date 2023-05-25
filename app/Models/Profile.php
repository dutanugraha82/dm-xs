<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = [
        'users_id',
        'address',
        'phone',
        'photo',
        'birthday',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class,'id');
    }
}
