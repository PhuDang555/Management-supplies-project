<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Hanghoa extends Model
{
    use HasFactory,SoftDeletes,Prunable;

    protected $fillable = [
        'name',
        'loaihang_id',
        'avatar',
        'donvitinh'
    ];
    public function prunable()
    {
        return $this->where('deleted_at', '<=', now()->addMinutes(100));
    }

    public function loaihang(){
        return $this->belongsTo(Loaihang::class, 'loaihang_id');
    }

    public function khos(){
        return $this->hasOne(Kho::class, 'hanghoa_id');
    }

    public function chitiethoadonnhaps(){
        return $this->hasMany(Kho::class, 'hanghoa_id');
    }

}
