<?php

namespace App\Http\Livewire\Ratt\Projects;

use App\Models\Project;
use App\Traits\HasDelete;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete, WithExport;

    public bool $deferLoading = true;
    public string $loadingComponent = 'components.table-loading';

    public $model = Project::class;
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
        $this->showCheckBox();
        return [
            Responsive::make(),
            Exportable::make(trans('Projects') . '-' . Carbon::parse(now())->timestamp)
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
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
     * @return Builder<\App\Models\Project>
     */
    public function datasource(): Builder
    {
        return Project::query()
            ->with(['prime', 'planner', 'networks'])
            ->join('users as primes', 'projects.prime_id', 'primes.id')
            ->join('users as planners', 'projects.planner_id', 'planners.id')
            ->select('projects.*', 'planners.name as plannername', 'primes.name as primename')
            ->when(auth()->user()->hasRole(['Manager', 'Super-Admin', 'Admin', 'Manager', 'Guest']), function ($q) {
                $q->withCount('networks');
            })
            ->when(auth()->user()->hasRole(['Manager']), function ($q) {
                $q->where('prime_id', auth()->user()->id)
                    ->orWhere('planner_id', auth()->user()->id);
            })
            ->when(!auth()->user()->hasRole(['Manager', 'Super-Admin', 'Admin', 'Manager', 'Guest']), function ($q) {
                $q->withCount([
                    'networks' => function ($q1) {
                        $q1->whereHas(
                            'networkTasks',
                            function ($q2) {
                                $q2->where('team_id', auth()->user()->current_team_id);
                            }
                        );
                    }
                ])->whereHas('networks.networkTasks', function ($query) {
                    $query->where('team_id', auth()->user()->current_team_id);
                });
            });
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
            'prime' => ['name'],
            'planner' => ['name'],
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
            ->addColumn('project_no', fn (Project $model) => 'P-' . $model->project_no)
            ->addColumn('networks_count', fn (Project $model) => $model->networks_count)
            ->addColumn('plannername', fn (Project $model) => $model->planner->name)
            ->addColumn('primename', fn (Project $model) => $model->prime->name)
            ->addColumn('started_at_formatted', fn (Project $model) => Carbon::parse($model->started_at)->format('d/m/Y'))
            ->addColumn('ended_at_formatted', fn (Project $model) => Carbon::parse($model->ended_at)->format('d/m/Y'))
            ->addColumn('updated_at_formatted', fn (Project $model) => $model->updated_at->format('Y-m-d H:i:s'));
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
            Column::make(trans('project no'), 'project_no')
                ->sortable()
                ->searchable(),
            Column::make(trans('nb. network'), 'networks_count'),
            Column::make(trans('planner'), 'plannername')
                ->searchable()
                ->sortable(),
            Column::make(trans('project manager'), 'primename')
                ->searchable()
                ->sortable(),
            Column::make(trans('started date'), 'started_at_formatted', 'started_at')
                ->searchable()
                ->sortable(),
            Column::make(trans('ended date'), 'ended_at_formatted', 'ended_at')
                ->searchable()
                ->sortable(),
            Column::make(trans('Last update'), 'updated_at_formatted', 'updated_at')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText(trans('project no'), 'project_no')
                ->operators(['contains', 'is', 'is_not']),
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
     * PowerGrid Project Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('showrecord')
                ->bladeComponent('showrecord', ['id' => 'id', 'route' => 'admin.ratt.projects.show']),
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'ratt.projects.edit']),
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
     * PowerGrid Project Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [
            Rule::button('showrecord')
                ->when(fn () => !auth()->user()->can('projects-view'))
                ->hide(),
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('projects-update'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('projects-delete'))
                ->hide(),
        ];
    }
}
