<?php

namespace App\Tables;

use App\Models\Khachhang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\SpladeTable;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;

class Khachhangs extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return auth()->check();
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Khachhang::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['id','name','phone','diachi'])
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('phone', sortable: true)
            ->column(label:'address',key:'diachi', sortable: true)
            ->column(label: 'Actions', exportAs: false)
            // ->rowLink(function(Khachhang $khachhang){
            //     return view('khachhangs.show',$khachhang);
            // })
            ->export()
            ->bulkAction(
                label: 'Delete Selected Customers',
                each: fn (Khachhang $khachhang) => $khachhang->delete(),
                confirm: 'Are you sure you want to delete the selected customers?',
                confirmButton: 'Delete',
                cancelButton: 'Cancel',
                after: fn () => Toast::info('Customers deleted successfully!'),
            )

            ->paginate(10);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}




