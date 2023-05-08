<?php

namespace App\Http\Livewire\Biri\Activities;

use App\Traits\HasDelete;
use App\Models\BiriActivity;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete;
    public $model = BiriActivity::class;
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
     * @return Builder<\App\Models\BiriActivity>
     */
    public function datasource(): Builder
    {
        return BiriActivity::query();
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
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('technology_name')
            ->addColumn('equipment_name')
            ->addColumn('activity_name')
            ->addColumn('activity_description')
            ->addColumn('average')
            ->addColumn('average_actual')
            ->addColumn('ps50_plan')
            ->addColumn('ps50_activity')
            ->addColumn('updated_at_formatted', fn (BiriActivity $model) => $model->updated_at->diffForHumans());
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
            Column::make(trans('technology'), 'technology_name')
                ->searchable()
                ->sortable(),
            Column::make(trans('equipment'), 'equipment_name')
                ->searchable()
                ->sortable(),
            Column::make(trans('activity'), 'activity_name')
                ->searchable()
                ->sortable(),
            Column::make(trans('activity desc.'), 'activity_description')
                ->searchable()
                ->sortable(),
            Column::make(trans('avg.'), 'average')
                ->searchable()
                ->sortable(),
            Column::make(trans('actual avg.'), 'average_actual')
                ->searchable()
                ->sortable(),
            Column::make(trans('PS50 plan'), 'ps50_plan')
                ->searchable()
                ->sortable(),
            Column::make(trans('PS50 act.'), 'ps50_activity')
                ->searchable()
                ->sortable(),
            Column::make(trans('Last update'), 'updated_at_formatted', 'updated_at')
                ->sortable(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid BiriActivity Action Buttons.
     *
     * @return array<int, Button>
     */

     public function actions(): array
     {
         return [
             Button::add('editrecord')
                 ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'biri.activities.edit']),

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
     * PowerGrid BiriActivity Action Rules.
     *
     * @return array<int, RuleActions>
     */

     public function actionRules(): array
     {
         return [
             //Hide button edit for ID 1
             Rule::button('editrecord')
                 ->when(fn () => !auth()->user()->can('activities-update'))
                 ->hide(),
             Rule::button('deleterecord')
                 ->when(fn () => !auth()->user()->can('activities-delete'))
                 ->hide(),
         ];
     }
}
