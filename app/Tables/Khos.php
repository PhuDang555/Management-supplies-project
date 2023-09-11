<?php

namespace App\Tables;

use App\Models\Kho;
use App\Models\User;
use App\Models\Lo;
use App\Models\Hanghoa;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use Carbon\Carbon;

class Khos extends AbstractTable
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
        return Kho::query();
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
            ->withGlobalSearch(columns: ['id', 'tongsoluong'])
            // ->column('id', sortable: true)
            ->column(label: 'Product', key :'hanghoa.name',sortable: true)
            ->column(label:'Total Quantity',key:'tongsoluong', sortable: true)
            // ->column(label:'soluonghethan',key:'tonghethang', sortable: true)
            ->column(label: 'Actions', exportAs: false)
            ->export()
            // ->column('action')
            // ->bulkAction(
            //     label: 'Delete Selected Warehouse?',
            //     each: fn (Kho $kho) => $kho->delete(),
            //     confirm: 'Are you sure you want to delete the selected Product in Warehouse?',
            //     confirmButton: 'Delete',
            //     cancelButton: 'Cancel',
            //     after: fn () => Toast::info('Product in Warehouse deleted successfully!'),
            // )
            ->paginate();

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}
