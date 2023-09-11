<?php

namespace App\Tables;

use App\Models\Hanghoa;
use App\Models\Loaihang;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;


class Hanghoas extends AbstractTable
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
        return Hanghoa::query();
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
            ->column(label: 'Category Product', key :'loaihang.name')
            ->column(label: 'Avatar', exportAs: false)
            ->column(label:'Units',key:'donvitinh', sortable: true)
            ->column(label: 'Actions', exportAs: false)
            ->export()
            ->selectFilter(
                key: 'loaihang_id',
                options: Loaihang::all()->pluck('name', 'id')->toArray(),
                label: 'Filter By Category Product',
                noFilterOption: true,
                noFilterOptionLabel: 'All Category Product'
            )
            ->bulkAction(
                label: 'Delete Selected Product',
                each: fn (Hanghoa $hanghoa) => $hanghoa->delete(),
                confirm: 'Are you sure you want to delete the selected Product?',
                confirmButton: 'Delete',
                cancelButton: 'Cancel',
                after: fn () => Toast::info('Product deleted successfully!'),
            )
            ->paginate();

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
