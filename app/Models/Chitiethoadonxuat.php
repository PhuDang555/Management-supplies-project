<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Chitiethoadonxuat extends Model
{
    use HasFactory,SoftDeletes,Prunable;

    protected $fillable = [
        'kho_id',
        'khachhang_id',
        'user_id',
        'soluong',
        // 'dongia'
    ];
    public function prunable()
    {
        return $this->where('deleted_at', '<=', now()->addMinutes(100));
    }

    public function kho(){
        return $this->belongsTo(Kho::class, 'kho_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function khachhang(){
        return $this->belongsTo(Khachhang::class, 'khachhang_id');
    }

}
