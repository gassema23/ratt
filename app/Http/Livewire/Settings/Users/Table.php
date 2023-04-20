<?php

namespace App\Http\Livewire\Settings\Users;

use App\Models\User;
use App\Traits\HasDelete;
use App\Traits\HasInvite;
use Illuminate\Support\Carbon;
use App\Http\Livewire\Settings\Users;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete, HasInvite;
    public $model = User::class;
    public $section_name;
    public $emits = ['refresh'];

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            ['refresh' => '$refresh'],
            ['sectionFilter'],
        );
    }
    protected $queryString = [
        'section_name' => ['except' => '', 'as' => 's']
    ];
    public function sectionFilter($section_name)
    {
        $this->reset('section_name');
        $this->section_name = $section_name;
        $this->emit('pg:eventRefresh-default');
        $this->emitTo(Users\Index::class, 'change', $this->section_name);
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
            Exportable::make('export')
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
     * @return Builder<\App\Models\User>
     */
    public function datasource(): Builder
    {
        return User::query()
            ->when($this->section_name, function ($q) {
                $q->when($this->section_name == 'active', function ($query) {
                    $query->active();
                })->when($this->section_name == 'pending', function ($query) {
                    $query->innactive();
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
            ->addColumn('employe_id')
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('teamname', fn (User $model) => $model->currentTeam->name)
            ->addColumn('updated_at_formatted', fn (User $model) => Carbon::parse($model->updated_at)->diffForHumans());
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
            Column::make(trans('employe id'), 'employe_id')
                ->sortable()
                ->searchable(),
            Column::make(trans('name'), 'name')
                ->sortable()
                ->searchable(),
            Column::make(trans('email address'), 'email')
                ->sortable()
                ->searchable(),
            Column::make(trans('Team'), 'teamname')
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
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('resendinvite')
                ->bladeComponent('resendinvite', ['id' => 'id']),
            Button::add('showrecord')
                ->bladeComponent('showrecord', ['id' => 'id', 'route' => 'admin.settings.users.show']),
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'settings.users.edit']),
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
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [
            //Hide button edit for ID 1
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('users-edit') || $this->section_name != 'active')
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('users-delete'))
                ->hide(),
            Rule::button('showrecord')
                ->when(fn () => !auth()->user()->can('users-view') || $this->section_name != 'active')
                ->hide(),
            Rule::button('resendinvite')
                ->when(fn () => !auth()->user()->can('users-edit') || $this->section_name != 'pending')
                ->hide(),
        ];
    }
}
