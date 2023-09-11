<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Chitiethoadonnhap extends Model
{
    use HasFactory,SoftDeletes,Prunable;

    protected $fillable = [
        'hanghoa_id',
        'user_id',
        'nhacungcap_id',
        'soluong',
        'dongia',
        'hansudung',
    ];
    public function prunable()
    {
        return $this->where('deleted_at', '<=', now()->addMinutes(100));
    }

    public function hanghoa(){
        return $this->belongsTo(Hanghoa::class, 'hanghoa_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function nhacungcap(){
        return $this->belongsTo(Nhacungcap::class, 'nhacungcap_id');
    }

    public function los(){
        return $this->hasOne(Lo::class, 'chitiethoadonnhap_id');
    }

}
