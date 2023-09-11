<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lo extends Model
{
    use HasFactory;

    protected $fillable = [
        'chitiethoadonnhap_id',
        'kho_id',
        'status',
        'soluong',
    ];

    public function chitiethoadonnhap(){
        return $this->belongsTo(Chitiethoadonnhap::class, 'chitiethoadonnhap_id');
    }

    public function kho(){
        return $this->belongsTo(Kho::class, 'kho_id');
    }

    // public static function getTotalExpiredProducts()
    // {
    //     $currentDate = now();

    //     return self::whereHas('chitiethoadonnhap.lo', function ($query) use ($currentDate) {
    //         $query->where('status', 1)
    //               ->where('hansudung', '<', $currentDate);
    //     })->sum('soluong');
    // }

}
