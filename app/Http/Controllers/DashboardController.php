<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables\Nhacungcaps;
use App\Tables\Khachhangs;
use App\Tables\Loaihangs;
use App\Tables\Hanghoas;
use App\Models\Khachhang;
use App\Models\Nhacungcap;
use App\Models\Loaihang;
use App\Models\Hanghoa;
use App\Models\User;
use App\Models\Role;
use App\Models\Kho;
use App\Models\Chitiethoadonxuat;
use App\Models\Chitiethoadonnhap;
class DashboardController extends Controller
{
    public function dashboard(){

        $khachhangs =Khachhangs::class;
        $nhacungcaps = Nhacungcaps::class;
        $loaihangs = Loaihangs::class;
        $hanghoas = Hanghoas::class;

        $khachhang = Khachhang::count('id');
        $nhacungcap = Nhacungcap::count('id');
        $loaihang = Loaihang::count('id');
        $hanghoa = Hanghoa::count('id');
        $user = User::count('id');
        $role = Role::count('id');
        $kho = Kho::count('id');
        $hoadonxuat = Chitiethoadonxuat::count('id');
        $hoadonnhap = Chitiethoadonnhap::count('id');
        // dd( $khachhang);
        return view('dashboard',compact(
            'khachhangs','nhacungcaps','loaihangs','hanghoas',
            'khachhang', 'nhacungcap', 'loaihang','hanghoa','user','kho','role','hoadonxuat','hoadonnhap'
        ));
    }
}
