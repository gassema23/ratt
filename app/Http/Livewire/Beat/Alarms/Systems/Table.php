<?php

namespace App\Http\Livewire\Beat\Alarms\Systems;

use App\Traits\HasDelete;
use App\Models\AlarmSystem;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete;

    public $model = AlarmSystem::class;

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
     * @return Builder<\App\Models\AlarmSystem>
     */
    public function datasource(): Builder
    {
        return AlarmSystem::query()
            ->with(['site', 'systemType'])
            ->join('sites', 'alarm_systems.site_id', '=', 'sites.id')
            ->join('alarm_system_types', 'alarm_systems.alarm_system_type_id', '=', 'alarm_system_types.id')
            ->select('alarm_systems.*', 'sites.clli as site_clli', 'sites.name as site_name', 'alarm_system_types.label as system_type_label');
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
            'site' => [
                'name', '
                clli'
            ],
            'systemType' => [
                'label'
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
            ->addColumn('system_type_label', fn (AlarmSystem $model) => $model->systemType->label)
            ->addColumn('site_name', fn (AlarmSystem $model) => $model->site->name)
            ->addColumn('site_clli', fn (AlarmSystem $model) => $model->site->clli)
            ->addColumn('network_element', fn (AlarmSystem $model) => $model->network_element)
            ->addColumn('location_number')
            ->addColumn('ipv4')
            ->addColumn('updated_at_formatted', fn (AlarmSystem $model) => $model->updated_at->diffForHumans());
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
            Column::make(trans('system type'), 'system_type_label')
                ->sortable()
                ->searchable(),
            Column::make(trans('Site'), 'site_name')
                ->sortable()
                ->searchable(),
            Column::make(trans('clli'), 'site_clli')
                ->sortable()
                ->searchable(),
            Column::make(trans('network element'), 'network_element')
                ->sortable()
                ->searchable(),
            Column::make(trans('location number'), 'location_number')
                ->sortable()
                ->searchable(),
            Column::make(trans('ipv4'), 'ipv4')
                ->sortable()
                ->searchable(),
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
     * PowerGrid AlarmSystem Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('modalshowrecord')
                ->bladeComponent('modalshowrecord', ['id' => 'id', 'route' => 'beat.alarms.systems.show']),
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'beat.alarms.systems.edit']),
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
     * PowerGrid AlarmSystem Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('alarmSystem-update'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('alarmSystem-delete'))
                ->hide(),
        ];
    }
}
