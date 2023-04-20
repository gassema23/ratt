<?php

namespace App\Http\Livewire\Geographics\States;

use App\Models\State;
use App\Traits\HasDelete;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete;
    public $model = State::class;
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
            Exportable::make(trans('States') . '-' . Carbon::parse(now())->timestamp)
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
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\State>
     */
    public function datasource(): Builder
    {
        return State::query()
            ->with(['country', 'type'])
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->join('geographic_types', 'states.type_id', '=', 'geographic_types.id')
            ->select('states.*', 'countries.name as countryname', 'geographic_types.name as typename');
    }
    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'country' => ['name'],
            'type' => ['name'],
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
            ->addColumn('countryname', fn (State $state) => $state->country->name)
            ->addColumn('statename', fn (State $state) => $state->name)
            ->addColumn('abbrname', fn (State $state) => $state->abbr)
            ->addColumn('typename', fn (State $state) => ucfirst(strtolower($state->type->name)))
            ->addColumn('updated_at_formatted', fn (State $model) => Carbon::parse($model->updated_at)->diffForHumans());
    }
    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make(trans('country'), 'countryname')
                ->searchable()
                ->sortable(),
            Column::make(trans('state'), 'statename', 'name')
                ->searchable()
                ->sortable(),
            Column::make(trans('abbr'), 'abbrname', 'abbr')
                ->searchable()
                ->sortable(),
            Column::make(trans('type'), 'typename', 'type')
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
     * PowerGrid State Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'geographics.states.edit']),
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
     * PowerGrid State Action Rules.
     *
     * @return array<int, RuleActions>
     */
    public function actionRules(): array
    {
        return [
            //Hide button edit for ID 1
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('states-edit'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('states-delete'))
                ->hide(),
        ];
    }
}
