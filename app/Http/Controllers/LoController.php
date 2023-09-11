<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables\Los;
use App\Models\Lo;
use App\Models\Kho;
use App\Models\Hanghoa;
use App\Models\Chitiethoadonnhap;
use ProtoneMedia\Splade\SpladeTable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Event;

class LoController extends Controller
{
    public function detail($id){

        $kho = Kho::find($id);

        $hanghoa_id = Hanghoa::find($kho->hanghoa_id); // Thay thế 1 bằng mã hàng hóa cần tính tổng
        // Lấy tổng số lượng hàng hóa còn hạn
        // $tong_con_han = Chitiethoadonnhap::where('hanghoa_id', $hanghoa_id->id)
        //     ->where('hansudung', '>', now())
        //     ->sum('soluong');
        // dd($tong_con_han);
        // $khos = Kho::with('los')->get();
        // dd($khos);

        // $totals = Kho::with('los')->find();
        // $totals = $totals->map(function ($item){
            $tong_het_han;
            $tong_con_han;
            $kho->los->map(function ($itemlo) use (&$tong_het_han,&$tong_con_han) {
                $soluong = $itemlo->soluong;
                $status = $itemlo->status;

                if($status == 1 ){
                    return  $tong_het_han += $soluong;
                }else{
                    return  $tong_con_han += $soluong;
                }
            });
            // return [
            //     "tonghethan" => $tonghethan,
            //     "tongconhan" => $tongconhan,
            // ];
        // });
        // dd($totals);

        // $tong_con_han = $totals['tongconhan'];
        // $tong_het_han = $totals['tonghethan'];
        // $tong_het_han = Chitiethoadonnhap::where('hanghoa_id', $hanghoa_id->id)
        //     ->where('hansudung', '<=', now())
        //     ->sum('soluong');

        return view('los.index', [
            'los' => SpladeTable::for(Lo::where('kho_id',$id)->get())
                ->withGlobalSearch()
                ->column('id', searchable: true, sortable: true,)
                ->column(label:'Quantity',key:'soluong', sortable: true)
                ->column(label: 'Input Date ',searchable: true, sortable: true, key :'chitiethoadonnhap.hansudung')
                ->column('status', searchable: true, sortable: true,)
                // ->paginate(10)

        ],compact('tong_con_han','tong_het_han'));
    }

    public function changeStatus($id){

        $getStatus = Lo::select('status')->where('id', $id)->first();

        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');

        if($getStatus->status == 0){
            $status = 1;
        }else{
            $status = 0;
        }

        Lo::where('id', $id)->update(['status'=>$status]);

        return redirect()->back();

        // $hoadons = Chitiethoadonnhap::all();

        // foreach ($hoadons as $hoadon) {
        //     foreach ($hoadon->los as $lo) {
        //         if (Carbon::now()->gt($lo->hansudung)) {
        //             $lo->status = 0;
        //         } else {
        //             $lo->status = 1;
        //         }
        //         $lo->save();
        //     }
        // }

        // return response()->json(['message' => 'Cập nhật trạng thái lô thành công']);

    }
}
