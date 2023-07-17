<?php

namespace App\Http\Livewire\Biri\Activities;

use App\Traits\HasDelete;
use App\Models\BiriActivity;
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
        return BiriActivity::query()
            ->with(['category', 'equipment', 'technology'])
            ->join('biri_technologies', 'biri_activities.technology_id', '=', 'biri_technologies.id')
            ->join('biri_equipment', 'biri_activities.equipment_id', '=', 'biri_equipment.id')
            ->join('biri_category_activities', 'biri_activities.category_id', '=', 'biri_category_activities.id')
            ->select([
                'biri_activities.*',
                'biri_technologies.label as technology_name',
                'biri_equipment.label as equipment_name',
                'biri_category_activities.label as category_name',
            ]);
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
        return [
            'technology' => [
                'label'
            ],
            'equipment' => [
                'label'
            ],
            'category' => [
                'label'
            ],
        ];
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
            ->addColumn('technology_name', fn (BiriActivity $model) => $model->technology->label)
            ->addColumn('equipment_name', fn (BiriActivity $model) => $model->equipment->label)
            ->addColumn('category_name', fn (BiriActivity $model) => $model->category->label)
            ->addColumn('description')
            ->addColumn('avg_single')
            ->addColumn('ps50_plan')
            ->addColumn('ps50_act')
            ->addColumn('avg_actual')
            ->addColumn('updated_at_formatted', fn (BiriActivity $model) => $model->updated_at->format('Y-m-d H:i:s'));
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
                ->sortable(),
            Column::make(trans('equipment'), 'equipment_name')
                ->sortable(),
            Column::make(trans('category'), 'category_name')
                ->sortable(),
            Column::make(trans('activity'), 'description')
                ->sortable(),
            Column::make(trans('avg. single'), 'avg_single'),
            Column::make(trans('ps50 plan'), 'ps50_plan'),
            Column::make(trans('ps50 activity'), 'ps50_act'),
            Column::make(trans('avg. actual'), 'avg_actual'),
            Column::make(trans('Last update'), 'updated_at_formatted', 'updated_at')
                ->sortable(),
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [];
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
                ->when(fn () => !auth()->user()->can('biri-activities-update'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('biri-activities-delete'))
                ->hide(),
        ];
    }
}
