<?php

namespace App\Tables;

use App\Models\Hanghoa;
use App\Models\Loaihang;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class XoaHanghoa extends AbstractTable
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
        return Hanghoa::onlyTrashed()->get();
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
            ->withGlobalSearch(columns: ['id', 'name', 'donvitinh'])
            ->column('id', sortable: true)
            ->column('name')
            ->column('donvitinh')

            ->column(label: 'Avatar', exportAs: false)
            ->column(label: 'LoaiHang', key :'loaihang.name')
            ->column(label: 'Actions', exportAs: false)
            ->export()
            ->selectFilter(
                key: 'loaihang_id',
                options: Loaihang::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Class',
                noFilterOption: true,
                noFilterOptionLabel: 'All Classes'
            )
            ->bulkAction(
                label: 'Delete Selected Students',
                each: fn (Hanghoa $hanghoa) => $hanghoa->delete(),
                confirm: 'Are you sure you want to delete the selected students?',
                confirmButton: 'Delete',
                cancelButton: 'Cancel',
                after: fn () => Toast::info('Students deleted successfully!'),
            );

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
