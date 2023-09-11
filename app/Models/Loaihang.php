<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loaihang extends Model
{
    use HasFactory,SoftDeletes,Prunable;

    protected $fillable = [
        'name',
        'mota'

    ];

    public function prunable()
    {
        return $this->where('deleted_at', '<=', now()->addMinutes(100));
    }

    public function hanghoas()
    {
        return $this->hasMany(Hanghoa::class, 'loaihang_id');
    }
}
