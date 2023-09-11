<?php

namespace App\Tables;

use App\Models\Loaihang;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class Loaihangs extends AbstractTable
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
        return Loaihang::query();
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
            ->withGlobalSearch(columns: ['id','name','mota'])
            ->column('id', sortable: true)
            ->column('name', sortable: true)
            ->column('mota', sortable: true)
            ->column(label: 'Actions', exportAs: false)
            ->export()
            ->bulkAction(
                label: 'Delete Selected Customers',
                each: fn (Loaihang $loaihang) => $loaihang->delete(),
                confirm: 'Are you sure you want to delete the selected Commodities?',
                confirmButton: 'Delete',
                cancelButton: 'Cancel',
                after: fn () => Toast::info('Commodities deleted successfully!'),
            )

            ->paginate(10);
            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
