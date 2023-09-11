<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XoakhachhangController extends Controller
{
    public function delete(){
        $delete = Khachhang::onlyTrashed()->get();

        return view('.delete',compact('delete'));
    }
}
