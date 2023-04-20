<?php

namespace App\Http\Livewire\Geographics\Sites;

use App\Models\Site;
use App\Models\Country;
use App\Traits\HasDelete;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete;
    public $model = Site::class;
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
            Exportable::make(trans('Sites') . '-' . Carbon::parse(now())->timestamp)
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
     * @return Builder<\App\Models\Site>
     */
    public function datasource(): Builder
    {
        return Site::query()
            ->with(['city', 'city.region', 'city.region.state', 'city.region.state.country'])
            ->join('cities', 'sites.city_id', '=', 'cities.id')
            ->join('regions', 'cities.region_id', '=', 'regions.id')
            ->join('states', 'regions.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->select('sites.*', 'countries.name as countryname', 'states.name as statename', 'regions.name as regionname', 'cities.name as cityname');
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
            'city' => [
                'name'
            ],
            'city.region' => [
                'name'
            ],
            'city.region.state' => [
                'name'
            ],
            'city.region.state.country' => [
                'name'
            ]
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
            ->addColumn('countryname', fn (Site $model) => $model->city->region->state->country->name)
            ->addColumn('statename', fn (Site $model) => $model->city->region->state->name)
            ->addColumn('regionname', fn (Site $model) => $model->city->region->state->name)
            ->addColumn('cityname', fn (Site $model) => $model->city->name)
            ->addColumn('clli', fn (Site $model) => $model->clli)
            ->addColumn('updated_at_formatted', fn (Site $model) => Carbon::parse($model->updated_at)->diffForHumans());
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
            Column::make(trans('country'), 'countryname')
                ->searchable()
                ->sortable()
                ->makeInputText(),
            Column::make(trans('state'), 'statename')
                ->searchable()
                ->sortable()
                ->makeInputText(),
            Column::make(trans('region'), 'regionname')
                ->searchable()
                ->sortable()
                ->makeInputText(),
            Column::make(trans('city'), 'cityname')
                ->searchable()
                ->sortable()
                ->makeInputText(),
            Column::make(trans('clli'), 'clli')
                ->searchable()
                ->sortable()
                ->makeInputText(),
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
     * PowerGrid Site Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('modalshowrecord')
                ->bladeComponent('modalshowrecord', ['id' => 'id', 'route' => 'geographics.sites.show']),
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'geographics.sites.edit']),

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
     * PowerGrid Site Action Rules.
     *
     * @return array<int, RuleActions>
     */
    public function actionRules(): array
    {
        return [
            //Hide button edit for ID 1
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('sites-edit'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('sites-delete'))
                ->hide(),
        ];
    }
}
