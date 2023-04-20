<?php

namespace App\Http\Livewire\Geographics\Countries;

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
    public $model = Country::class;
    public $emits = ['refresh'];
    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            ['refresh' => '$refresh']
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
            Exportable::make(trans('Countries') . '-' . Carbon::parse(now())->timestamp)
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
     * @return Builder<\App\Models\Country>
     */
    public function datasource(): Builder
    {
        return Country::query();
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
            ->addColumn('country', fn (Country $model) => $model->name)
            ->addColumn('region')
            ->addColumn('sub_region')
            ->addColumn('capital')
            ->addColumn('updated_at_formatted', fn (Country $model) => Carbon::parse($model->updated_at)->diffForHumans());
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
            Column::make(trans('country'), 'country', 'name')
                ->sortable()
                ->searchable(),
            Column::make(trans('region'), 'region')
                ->sortable()
                ->searchable(),
            Column::make(trans('sub-region'), 'sub_region')
                ->sortable()
                ->searchable(),
            Column::make(trans('capital'), 'capital')
                ->sortable()
                ->searchable(),
            Column::make(trans('last update'), 'updated_at_formatted', 'updated_at')
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
     * PowerGrid Country Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'geographics.countries.edit']),
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
     * PowerGrid Country Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [
            //Hide button edit for ID 1
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('countries-edit'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('countries-delete'))
                ->hide(),
        ];
    }
}
