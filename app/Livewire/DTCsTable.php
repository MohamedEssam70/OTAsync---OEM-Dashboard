<?php

namespace App\Livewire;

use App\Enums\DTCsTypes;
use App\Enums\SystemsTypes;
use App\Models\DTCs;
use App\Models\Firmware;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DTCsTable extends DataTableComponent
{
    protected $model = Vehicle::class;

    public $id;

    public bool $perPageAll = true;


    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setColumnSelectDisabled()
            ->setOfflineIndicatorEnabled()
            ->setFilterPillsStatus(false)
            ->setFilterLayout('slide-down')
            ->setFilterSlideDownDefaultStatusEnabled()
            ->setTableAttributes([
                'class' => '',
            ])
            ->setThSortButtonAttributes(function(Column $column)
            {
                return [
                    'class' => 'bg-green-500',
                ];
            })
            ->setThAttributes(function(Column $column)
            {
                return [
                    'class' => 'border-top'
                ];
            })
            ->setTrAttributes(function($row, $index)
            {
                return [
                'class' => 'bg-white',
                ];
            })
            ->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
                return [
                'class' => 'py-2',
                ];
            })
            ->setConfigurableAreas([
                'toolbar-right-end' => 'content.diagnostic.dtcs.tableComponant',
            ]);
    }

    public function setTableRowClass($row): ?string
    {
        return 'bg-white';
    }

    public function builder(): Builder
    {
        return DTCs::query();
    }

    public function columns(): array
    {
        return [
            Column::make("Code")
                ->label(function($row, Column $column){
                    return
                    '<span class="m-0">'
                    .($row->type == DTCsTypes::P ? '<strong class="text-danger me-1">'.$row->type->value : '')
                    .($row->type == DTCsTypes::C ? '<strong class="text-warning me-1">'.$row->type->value : '')
                    .($row->type == DTCsTypes::U ? '<strong class="text-info me-1">'.$row->type->value : '')
                    .($row->type == DTCsTypes::B ? '<strong class="text-primary me-1">'.$row->type->value : '')
                    .'</strong>'.$row->code.'</span>';
                })
                ->html(),
            Column::make("System")
                ->label(function($row, Column $column){
                    return '<span class="text-truncate d-flex align-items-center"><span class="badge rounded-pill bg-label-secondary me-1">'.$row->system->value.'</span></span>';

                })
                ->html(),
            Column::make("Manufactor")
                ->label(fn($row, Column $column)=>$row->manufactor),
            Column::make("Description")
                ->label(function($row, Column $column){
                    return
                    '<p class="mb-0">'.$row->description.'</p>';
                })
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

}


