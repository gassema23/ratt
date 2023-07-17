<?php

namespace App\Http\Livewire\Biri\Technologies;

use App\Traits\HasDelete;
use App\Models\BiriTechnology;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete;

    public bool $deferLoading = true;
    public string $loadingComponent = 'components.table-loading';

    public $model = BiriTechnology::class;
    public $emits = [
        'refresh'
    ];
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'refresh' => '$refresh',
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\BiriTechnology>
     */
    public function datasource(): Builder
    {
        return BiriTechnology::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('label')
            ->addColumn('updated_at_formatted', fn (BiriTechnology $model) => $model->updated_at->format('Y-m-d H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make(trans('technology'), 'label'),
            Column::make(trans('Last update'), 'updated_at_formatted', 'updated_at')
                ->sortable(),
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid BiriTechnology Action Buttons.
     *
     * @return array<int, Button>
     */


     public function actions(): array
     {
         return [
             Button::add('editrecord')
                 ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'biri.technologies.edit']),

             Button::add('deleterecord')
                 ->bladeComponent('deleterecord', ['id' => 'id']),
         ];
     }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid BiriTechnology Action Rules.
     *
     * @return array<int, RuleActions>
     */

     public function actionRules(): array
     {
         return [
             //Hide button edit for ID 1
             Rule::button('editrecord')
                 ->when(fn () => !auth()->user()->can('biri-technologies-update'))
                 ->hide(),
             Rule::button('deleterecord')
                 ->when(fn () => !auth()->user()->can('biri-technologies-delete'))
                 ->hide(),
         ];
     }
}
