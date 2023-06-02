<?php

namespace App\Models\SuperAdmin;

use App\Models\Max;
use App\Models\Min;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptoms extends Model
{
    use HasFactory;
    protected $table = 'symptoms';
    protected $fillable = [
        'name',
        'code',
        'low_start',
        'low_end',
        'high_start',
        'high_end',
    ];
}
