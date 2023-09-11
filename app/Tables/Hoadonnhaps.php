<?php

namespace App\Tables;

use App\Models\Hoadonnhap;
use App\Models\User;
use App\Models\Nhacungcap;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;

class Hoadonnhaps extends AbstractTable
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
        return Hoadonnhap::query();
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
            ->withGlobalSearch(columns: ['id',''])
            ->column('id', sortable: true)
            ->column(label: 'UserName', key :'user.name')
            ->column(label: 'Nhacungcap', key :'nhacungcap.name')
            ->column('created_at')
            ->column(label: 'Actions', exportAs: false)
            ->export()
            ->selectFilter(
                key: 'user_id',
                options: User::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Class',
                noFilterOption: true,
                noFilterOptionLabel: 'All Classes'
            )
            ->selectFilter(
                key: 'nhacungcap_id',
                options: Nhacungcap::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Class',
                noFilterOption: true,
                noFilterOptionLabel: 'All Classes'
            )
            ->bulkAction(
                label: 'Delete Selected Students',
                each: fn (Hoadonnhap $hoadonnhap) => $hoadonnhap->delete(),
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
