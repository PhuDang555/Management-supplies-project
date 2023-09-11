<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadonxuat extends Model
{
    use HasFactory;

    protected $fillable = [
        'khachhang_id',
        'user_id'
    ];

    public function chitiethoadonxuats(){
        return $this->hasMany(Chitiethoadonxuat::class, 'hoadonxuat_id');
    }

    public function khachhang(){
        return $this->belongsTo(Khachhang::class, 'khachhang_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
