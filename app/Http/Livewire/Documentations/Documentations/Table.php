<?php

namespace App\Http\Livewire\Documentations\Documentations;

use App\Models\Category;
use App\Traits\HasDelete;
use App\Models\Documentation;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Traits\Filter;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class Table extends PowerGridComponent
{
    use ActionButton, HasDelete;
    public $model = Documentation::class;
    public $tag_name;
    public $emits = ['refresh'];

    public bool $deferLoading = true;
    public string $loadingComponent = 'components.table-loading';

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            ['refresh' => '$refresh'],
            ['tagFilter'],
        );
    }
    protected $queryString = [
        'tag_name' => ['except' => '', 'as' => 't']
    ];
    public function tagFilter($tag_name)
    {
        $this->reset('tag_name');
        $this->tag_name = $tag_name;
        $this->emit('pg:eventRefresh-default');
        $this->emitTo(Index::class, 'change', $this->tag_name);
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
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
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
     * @return Builder<\App\Models\Documentation>
     */
    public function datasource(): Builder
    {
        return Documentation::query()
            ->with(['category', 'tagged'])
            ->when($this->tag_name, function ($q) {
                $q->withAnyTag($this->tag_name);
            })
            ->join('categories', 'documentations.category_id', '=', 'categories.id')
            ->select('documentations.*', 'categories.name as categoryname');
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
            'category' => [
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
            ->addColumn('name')
            ->addColumn('slug')
            ->addColumn('categoryname', fn (Documentation $model) => $model->category->name)
            ->addColumn('tagsname', fn (Documentation $model) => implode(' ',$model->tagsPills($this->tag_name)))
            ->addColumn('updated_at_formatted', fn (Documentation $model) => $model->updated_at->format('Y-m-d H:i:s'));
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
            Column::make('title', 'name')
                ->searchable()
                ->sortable(),
            Column::make('category', 'categoryname')
                ->searchable()
                ->sortable(),
            Column::make('tags', 'tagsname'),
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
     * PowerGrid Documentation Action Buttons.
     *
     * @return array<int, Button>
     */
    public function actions(): array
    {
        return [
            Button::add('showrecord')
                ->bladeComponent('showrecord', ['id' => 'slug', 'route' => 'admin.documentations.show']),
            Button::add('editrecord')
                ->bladeComponent('editrecord', ['id' => 'id', 'route' => 'documentations.documentations.edit']),
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
     * PowerGrid Documentation Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($documentation) => $documentation->id === 1)
                ->hide(),
        ];
    }
    */
}
