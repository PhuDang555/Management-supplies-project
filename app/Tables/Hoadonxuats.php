<?php

namespace App\Tables;

use App\Models\Hoadonxuat;
use App\Models\User;
use App\Models\Khachhang;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;

class Hoadonxuats extends AbstractTable
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
        return Hoadonxuat::query();
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
            ->withGlobalSearch(columns: ['id'])
            ->column('id', sortable: true)
            ->column(label: 'UserName', key :'user.name')
            ->column(label: 'Khach hang', key :'khachhang.name')
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
                key: 'khachhang_id',
                options: Khachhang::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Class',
                noFilterOption: true,
                noFilterOptionLabel: 'All Classes'
            )
            ->bulkAction(
                label: 'Delete Selected Students',
                each: fn (Hoadonxuat $hoadonxuat) => $hoadonxuat->delete(),
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
