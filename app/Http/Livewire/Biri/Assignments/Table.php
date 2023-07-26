<?php

namespace App\Http\Livewire\Biri\Assignments;

use App\Traits\HasDelete;
use App\Models\BiriAssignment;
use App\Models\BiriIsqMasterData;
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

    public $model = BiriAssignment::class;
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
     * @return Builder<\App\Models\BiriAssignment>
     */
    public function datasource(): Builder
    {
        return BiriIsqMasterData::query()
            ->doesnthave('assignment');
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
            ->addColumn('project_no')
            ->addColumn('network_no')
            ->addColumn('network_header')
            ->addColumn('version_date_formatted', fn (BiriIsqMasterData $model) => $model->version_date->format('Y-m-d H:i:s'));
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
            Column::make('project', 'project_no')->sortable()->searchable(),
            Column::make('network', 'network_no')->sortable()->searchable(),
            Column::make('sap header', 'network_header')->sortable()->searchable(),
            Column::make('Version date', 'version_date_formatted', 'version_date')->sortable(),

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            Filter::datetimepicker('created_at'),
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
     * PowerGrid BiriAssignment Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('modalbutton')
                ->bladeComponent('modalassignment', ['id' => 'id', 'route' => 'biri.assignments.assign']),
            Button::add('editrecord')
                ->bladeComponent('modalremoveassignment', ['id' => 'id']),
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
     * PowerGrid BiriAssignment Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($biri-assignment) => $biri-assignment->id === 1)
                ->hide(),
        ];
    }
    */
}
