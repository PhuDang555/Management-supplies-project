<?php

namespace App\Tables;

use App\Models\Nhacungcap;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;

class XoaNhacungcap extends AbstractTable
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
        return Nhacungcap::onlyTrashed()->get();
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
            ->column('diachi', sortable: true)
            ->column(label: 'Actions', exportAs: false)
            ->export()
            ->bulkAction(
                label: 'Delete Selected Providers',
                each: fn (Khachhang $khachhang) => $khachhang->delete(),
                confirm: 'Are you sure you want to delete the selected providers?',
                confirmButton: 'Delete',
                cancelButton: 'Cancel',
                after: fn () => Toast::info('Providers deleted successfully!'),
            );

            // ->paginate(10);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
