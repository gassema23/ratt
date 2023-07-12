<?php

namespace App\Http\Livewire\Beat\Settings\Alarms\Lists;

use App\Models\AlarmList;
use App\Traits\HasDelete;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete, WithExport;

    public bool $deferLoading = true;
    public string $loadingComponent = 'components.table-loading';

    public $model = AlarmList::class;

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
     * @return Builder<\App\Models\AlarmList>
     */
    public function datasource(): Builder
    {
        return AlarmList::query()
            ->with(['severity', 'type'])
            ->join('alarm_types', 'alarm_lists.alarm_type_id', '=', 'alarm_types.id')
            ->join('alarm_severities', 'alarm_lists.alarm_severity_id', '=', 'alarm_severities.id')
            ->select('alarm_lists.*', 'alarm_types.label as alarm_label', 'alarm_severities.label as alarm_severity');
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
            'severity' => [
                'label'
            ],
            'type' => [
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
            ->addColumn('alarm_type', fn (AlarmList $model) => $model->type->label)
            ->addColumn('model')
            ->addColumn('item_number')
            ->addColumn('alarm_severity', fn (AlarmList $model) => $model->severity->label)
            ->addColumn('updated_at_formatted', fn (AlarmList $model) => $model->updated_at->format('Y-m-d H:i'));
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
            Column::make(trans('type'), 'alarm_type')
                ->sortable()
                ->searchable(),
            Column::make(trans('model'), 'model')
                ->sortable()
                ->searchable(),
            Column::make(trans('item number'), 'item_number')
                ->sortable()
                ->searchable(),
            Column::make(trans('severity'), 'alarm_severity')
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
     * PowerGrid AlarmList Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('modalshowrecord')
                ->bladeComponent('modalshowrecord', ['id' => 'id', 'route' => 'beat.settings.alarms.lists.show']),
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'beat.settings.alarms.lists.edit']),
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
     * PowerGrid AlarmList Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('alarmList-update'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('alarmList-delete'))
                ->hide(),
        ];
    }
}
