<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoadonnhap extends Model
{
    use HasFactory;

    protected $fillable = [
        'nhacungcap_id',
        'user_id'
    ];

    public function chitiethoadonnhaps(){
        return $this->hasMany(Chitiethoadonnhap::class, 'hoadonnhap_id');
    }

    public function nhacungcap(){
        return $this->belongsTo(Nhacungcap::class, 'nhacungcap_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
