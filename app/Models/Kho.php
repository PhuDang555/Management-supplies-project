<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kho extends Model
{
    use HasFactory,SoftDeletes,Prunable;

    protected $fillable = [
        'hanghoa_id',
        'tongsoluong'
    ];
    public function prunable()
    {
        return $this->where('deleted_at', '<=', now()->addMinutes(100));
    }

    public function hanghoa(){
        return $this->belongsTo(Hanghoa::class, 'hanghoa_id');
    }

    public function chitiethoadonxuats(){
        return $this->hasMany(Chitiethoadonxuat::class, 'kho_id');
    }

    public function los(){
        return $this->hasMany(Lo::class, 'kho_id');
    }
}
