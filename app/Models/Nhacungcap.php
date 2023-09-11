<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Nhacungcap extends Model
{
    use HasFactory,SoftDeletes,Prunable;

    protected $fillable = [
        'name',
        'phone',
        'diachi'
    ];

    public function prunable()
    {
        return $this->where('deleted_at', '<=', now()->addMinutes(100));
    }

    public function chitiethoadonnhaps()
    {
        return $this->hasMany(Chitiethoadonnhap::class, 'nhacungcap_id');
    }
}
