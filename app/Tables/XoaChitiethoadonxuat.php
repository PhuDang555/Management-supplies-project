<?php

namespace App\Tables;

use App\Models\Chitiethoadonxuat;
use App\Models\Hoadonxuat;
use App\Models\Hanghoa;
use App\Models\User;
use App\Models\Khachhang;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class XoaChitiethoadonxuat extends AbstractTable
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
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Chitiethoadonxuat::onlyTrashed()->get();
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
            ->withGlobalSearch(columns: ['id','soluong','dongia'])
            ->column('id', sortable: true)
            ->column(label: 'Products', key :'kho.hanghoa.name')
            ->column(label: 'Employee', key :'khachhang.name')
            ->column(label: 'username', key :'user.name')
             ->column(label: 'Quantity', key :'soluong', sortable: true)
            // ->column('dongia', sortable: true)
            ->column('created_at')
            ->column(label: 'Actions', exportAs: false)
            ->export()
            ->bulkAction(
                label: 'Delete Selected Students',
                each: fn (Chitiethoadonxuat $chitiethoadonxuat) => $chitiethoadonxuat->delete(),
                confirm: 'Are you sure you want to delete the selected students?',
                confirmButton: 'Delete',
                cancelButton: 'Cancel',
                after: fn () => Toast::info('Students deleted successfully!'),
            )
            ->selectFilter(
                key: 'hanghoa_id',
                options: Hanghoa::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Product',
                noFilterOption: true,
                noFilterOptionLabel: 'All Product'
            )
            ->selectFilter(
                key: 'khachhang_id',
                options: Khachhang::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Employee',
                noFilterOption: true,
                noFilterOptionLabel: 'All Employee'
            )
            ->selectFilter(
                key: 'user_id',
                options: User::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By User',
                noFilterOption: true,
                noFilterOptionLabel: 'All User'
            )
            ->paginate();


            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
