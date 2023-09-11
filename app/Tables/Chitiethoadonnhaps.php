<?php

namespace App\Tables;

use App\Models\Chitiethoadonnhap;
use App\Models\Hoadonnhap;
use App\Models\Hanghoa;
use App\Models\User;
use App\Models\Nhacungcap;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;

class Chitiethoadonnhaps extends AbstractTable
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
        return Chitiethoadonnhap::query();
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
            ->withGlobalSearch(columns: ['id','soluong','dongia','hansudung'])
            ->column('id', sortable: true)
            ->column(label: 'Products', key :'hanghoa.name')
            ->column(label: 'Providers', key :'nhacungcap.name')
            ->column(label: 'username', key :'user.name')
             ->column(label: 'Quantity', key :'soluong', sortable: true)
            ->column(label: 'Price(VND)', key :'dongia', sortable: true)
            ->column(label: 'HSD', key :'hansudung', sortable: true)
            ->column('created_at')
            ->column(label: 'Actions', exportAs: false)
            ->export()
            ->selectFilter(
                key: 'hanghoa_id',
                options: Hanghoa::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Product',
                noFilterOption: true,
                noFilterOptionLabel: 'All Product'
            )
            ->selectFilter(
                key: 'user_id',
                options: User::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By User',
                noFilterOption: true,
                noFilterOptionLabel: 'All User'
            )
            ->selectFilter(
                key: 'nhacungcap_id',
                options: Nhacungcap::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Provider',
                noFilterOption: true,
                noFilterOptionLabel: 'All Provider'
            )
            ->bulkAction(
                label: 'Delete Selected Students',
                each: fn (Chitiethoadonnhap $chitiethoadonnhap) => $chitiethoadonnhap->delete(),
                confirm: 'Are you sure you want to delete the selected students?',
                confirmButton: 'Delete',
                cancelButton: 'Cancel',
                after: fn () => Toast::info('Students deleted successfully!'),
            )
            ->paginate();
            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
