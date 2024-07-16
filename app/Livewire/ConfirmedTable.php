<?php

namespace App\Livewire;

use App\Enums\DTCsTypes;
use App\Enums\TroubleTypes;
use App\Models\Monitor;
use App\Models\Trouble;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ConfirmedTable extends DataTableComponent
{
    protected $model = Trouble::class;

    public $id;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
            ->setColumnSelectDisabled()
            ->setOfflineIndicatorEnabled()
            ->setPerPageVisibilityDisabled()
            ->setSearchVisibilityDisabled()
            ->setPaginationVisibilityDisabled()
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
                    'class' => ''
                ];
            })
            ->setTrAttributes(function($row, $index)
            {
                return [
                'class' => 'bg-white',
                ];
            });
    }

    public function setTableRowClass($row): ?string
    {
        return 'bg-white';
    }

    public function builder(): Builder
    {
        return Trouble::query()
            ->where('session_id', $this->id)
            ->where('type', TroubleTypes::Confirmed)
            ->where('cleard', false)
            ->with('session')
            ->with('dtcs');
    }

    public function columns(): array
    {
        return [
            Column::make("Code")
                ->label(function($row, Column $column){
                    return
                    '<span class="m-0">'
                    .($row->dtcs->type == DTCsTypes::P ? '<strong class="text-danger me-1">'.$row->dtcs->type->value : '')
                    .($row->dtcs->type == DTCsTypes::C ? '<strong class="text-warning me-1">'.$row->dtcs->type->value : '')
                    .($row->dtcs->type == DTCsTypes::U ? '<strong class="text-info me-1">'.$row->dtcs->type->value : '')
                    .($row->dtcs->type == DTCsTypes::B ? '<strong class="text-primary me-1">'.$row->dtcs->type->value : '')
                    .'</strong>'.$row->dtcs->code.'</span>';
                })
                ->html(),
            Column::make("System")
                ->label(fn($row, Column $column) => $row->dtcs->system),
            Column::make("Manufacturer")
                ->label(fn($row, Column $column) => $row->dtcs->manufactor),
            Column::make("Description")
                ->label(fn($row, Column $column) => $row->dtcs->description),
            Column::make("", "cleard")
                ->label(function($row, Column $column){
                    if(!$row->cleard)
                    {
                        return
                        '<button type="button" class="btn btn-success btn-sm ms-2">
                        <span>
                            <span class="">Clear</span>
                        </span>
                        </button>';
                    }
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


