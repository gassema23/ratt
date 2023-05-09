<?php

namespace App\Http\Livewire\Biri;

use App\Models\BiriIsq;
use App\Traits\HasDelete;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete;
    public $model = BiriIsq::class;
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
            Exportable::make(trans('SuiviBiri') . '-' . Carbon::parse(now())->timestamp)
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
     * @return Builder<\App\Models\BiriIsq>
     */
    public function datasource(): Builder
    {
        return BiriIsq::query()
            ->with(['milestone'])
            ->join('biri_milestones', 'biri_milestones.network', '=', 'biri_isqs.network')
            ->select('biri_isqs.*', 'biri_milestones.title as milestone_title')
            ->latest()
            ->distinct('biri_isqs.network');
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
            'milestone' => [
                'title'
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
            ->addColumn('project_definition')
            ->addColumn('network')
            ->addColumn('sap_header')
            ->addColumn('milestone_title', fn (BiriIsq $model) => e($model->milestone->title))
            ->addColumn('updated_at_formatted', fn (BiriIsq $model) => Carbon::parse($model->updated_at)->diffForHumans());
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
            Column::make(trans('project'), 'project_definition')
                ->searchable()
                ->sortable(),
            Column::make(trans('network'), 'network')
                ->searchable()
                ->sortable(),
            Column::make(trans('sap header'), 'sap_header')
                ->searchable()
                ->sortable(),
            Column::make(trans('project name'), 'milestone_title')
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
    */

    /**
     * PowerGrid BiriIsq Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('biri-isq.edit', ['biri-isq' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('biri-isq.destroy', ['biri-isq' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid BiriIsq Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($biri-isq) => $biri-isq->id === 1)
                ->hide(),
        ];
    }
    */
}
