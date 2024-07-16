<?php

namespace App\Livewire;

use App\Enums\DTCsTypes;
use App\Enums\TroubleTypes;
use App\Models\Monitor;
use App\Models\Trouble;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class LogsTable extends DataTableComponent
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
            Column::make("Read At")
                ->label(function($row, Column $column){
                    return
                    '<span class="text-truncate d-flex lh-1">'.Carbon::parse($row->created_at)->toTimeString().'</span>
                    <small class="text-muted">'.Carbon::parse($row->created_at)->toFormattedDateString().'</small>';
                })
                ->html(),
            Column::make("Cleared")
                ->label(function($row, Column $column){
                    if($row->cleard)
                    {
                        return
                        '
                        <div class="align-items-center row">
                            <div class="col-2">
                                <i class="fa-solid fa-circle-check text-success" style="font-size: 25px;"></i>
                            </div>
                            <div class="col">
                                <span class="text-truncate d-flex lh-1">'.Carbon::parse($row->updated_at)->toTimeString().'</span>
                                <small class="text-muted">'.Carbon::parse($row->updated_at)->toFormattedDateString().'</small>
                            </div>
                        </div>
                        ';
                    }
                    else
                    {
                        return
                        '<i class="fa-solid fa-circle-xmark text-danger" style="font-size: 25px;"></i>';
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


