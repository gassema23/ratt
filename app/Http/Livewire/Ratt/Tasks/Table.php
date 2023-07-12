<?php

namespace App\Http\Livewire\Ratt\Tasks;

use App\Models\Task;
use App\Traits\HasDelete;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete;
    public $model = Task::class;
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
     * @return Builder<\App\Models\Task>
     */
    public function datasource(): Builder
    {
        return Task::query()
            ->with(['team', 'parent', 'scenarios'])
            ->join('teams', 'tasks.team_id', '=', 'teams.id')
            ->leftJoin('tasks as parents', 'tasks.team_id', '=', 'parents.id')
            ->select('tasks.*', 'teams.name as teamname', 'parents.name as parentname');
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
            'team' => ['name'],
            'parent' => ['name'],
            'scenarios' => ['name'],
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
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('scenarioname', fn (Task $model) => implode(', ', collect($model->scenarios)->pluck('name')->toArray()))
            ->addColumn('name')
            ->addColumn('parentname', fn (Task $model) => $model->parent->name ?? '')
            ->addColumn('teamname', fn (Task $model) => $model->team->name)
            ->addColumn('updated_at_formatted', fn (Task $model) => Carbon::parse($model->updated_at)->diffForHumans());
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
            Column::make(trans('scenarios'), 'scenarioname')
                ->searchable(),
            Column::make(trans('name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(trans('dependency'), 'parentname')
                ->sortable()
                ->searchable(),
            Column::make(trans('team'), 'teamname')
                ->sortable()
                ->searchable(),
            Column::make(trans('last update'), 'updated_at_formatted', 'updated_at')
                ->searchable()
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
     * PowerGrid Task Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'ratt.tasks.edit']),
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
     * PowerGrid Task Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('tasks-update'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('tasks-delete'))
                ->hide(),
        ];
    }
}
