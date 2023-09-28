<?php

namespace App\Http\Livewire\biri\Assignments\Assignations;

use App\Models\BiriAssignment;
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
     * @return Builder<\App\Models\BiriAssignment>
     */
    public function datasource(): Builder
    {
        return BiriAssignment::query()
            ->with([
                'isq',
                'tech',
                'desnTech',
                'milestone'
            ])
            ->leftJoin('biri_isq_master_data', 'biri_assignments.network_no', '=', 'biri_isq_master_data.network_no')
            ->leftJoin('users as desn_user', 'biri_assignments.desn_user_id', '=', 'desn_user.id')
            ->leftJoin('users as tech_user', 'biri_assignments.tech_user_id', '=', 'tech_user.id')
            ->leftJoin('biri_milestones', 'biri_assignments.network_no', '=', 'biri_milestones.network_no')
            ->select([
                'biri_isq_master_data.*',
                'biri_assignments.*',
                'tech_user.name as tech_name',
                'desn_user.name as desn_name',
                'biri_milestones.label as project_name',
            ]);
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
            ->addColumn('project', fn (BiriAssignment $model) => $model->isq->project_no ?? 'N/A')
            ->addColumn('network_no')
            ->addColumn('sap_header', fn (BiriAssignment $model) => $model->isq->network_header ?? 'N/A')
            ->addColumn('project_name', fn (BiriAssignment $model) => $model->milestone->label ?? 'N/A')
            ->addColumn('clli_name', fn (BiriAssignment $model) => $model->isq->clli_name ?? 'N/A')
            ->addColumn('desn_name', fn (BiriAssignment $model) => $model->desnTech->name)
            ->addColumn('desn_req_formatted', fn (BiriAssignment $model) => $model->desn_req->format('Y-m-d'))
            ->addColumn('tech_name', fn (BiriAssignment $model) => $model->tech->name)
            ->addColumn('fich_eng_req_formatted', fn (BiriAssignment $model) => $model->fich_eng_req->format('Y-m-d'))
            ->addColumn('updated_at_formatted', fn (BiriAssignment $model) => $model->updated_at->format('Y-m-d H:i:s'));
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
            Column::make('Project', 'project', 'isq.project_no')->searchable()->sortable(),
            Column::make('Network', 'network_no')->searchable()->sortable(),
            Column::make('SAP Header', 'sap_header', 'isq.network_header')->searchable()->sortable(),
            Column::make('Project name', 'project_name', 'milestone.label')->searchable()->sortable(),
            Column::make('CLLI', 'clli_name')->searchable()->sortable(),
            Column::make('DESN name', 'desn_name', 'desnTech.name')->searchable()->sortable(),
            Column::make('DESN required at', 'desn_req_formatted', 'desn_req')->sortable(),
            Column::make('Technician name', 'tech_name', 'tech.name')->searchable()->sortable(),
            Column::make('Engineering sheet required at', 'fich_eng_req_formatted', 'fich_eng_req')->sortable(),
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
     * PowerGrid BiriAssignment Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::add('modalshowrecord')
                ->bladeComponent('modalshowrecord', ['id' => 'id', 'route' => 'biri.assignments.assignations.show']),
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
     * PowerGrid BiriAssignment Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($biri-assignment) => $biri-assignment->id === 1)
                ->hide(),
        ];
    }
    */
}
