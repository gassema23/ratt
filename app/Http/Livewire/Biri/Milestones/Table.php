<?php

namespace App\Http\Livewire\Biri\Milestones;

use App\Models\BiriMilestone;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class Table extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

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
     * @return Builder<\App\Models\BiriMilestone>
     */
    public function datasource(): Builder
    {
        return BiriMilestone::query();
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
            ->addColumn('network_header_tech')
            ->addColumn('wbs_element')
            ->addColumn('dapp_mist_formatted', fn (BiriMilestone $model) => $model->dapp_mist->format('Y-m-d'))
            ->addColumn('updated_at_formatted', fn (BiriMilestone $model) => $model->updated_at->format('Y-m-d H:i:s'));
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
            Column::make('wbs element', 'wbs_element')->sortable()->searchable(),
            Column::make('DAPP', 'dapp_mist_formatted', 'dapp_mist')->sortable()->searchable(),
            Column::make('Last update', 'updated_at_formatted', 'updated_at')->sortable(),
        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid BiriMilestone Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        return [
            Button::add('modalshowrecord')
                ->bladeComponent('modalshowrecord', ['id' => 'id', 'route' => 'biri.milestones.show']),
            Button::add('editrecord')
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
     * PowerGrid BiriMilestone Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [
            //Hide button edit for ID 1
            Rule::button('modalshowrecord')
                ->when(fn () => !auth()->user()->can('biri-milestones-view'))
                ->hide(),
            Rule::button('editrecord')
                ->when(fn () => !auth()->user()->can('biri-milestones-update'))
                ->hide(),
            Rule::button('deleterecord')
                ->when(fn () => !auth()->user()->can('biri-milestones-delete'))
                ->hide(),
        ];
    }
}
