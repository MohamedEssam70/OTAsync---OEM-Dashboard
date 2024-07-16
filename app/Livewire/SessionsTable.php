<?php

namespace App\Livewire;

use App\Enums\SessionStatus;
use App\Models\Firmware;
use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SessionsTable extends DataTableComponent
{
    protected $model = Session::class;

    public $id;

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
            ->setTableRowUrl(function($row) {
                return route('session.view', $row->id);
            });;
    }

    public function setTableRowClass($row): ?string
    {
        return 'bg-white';
    }

    public function builder(): Builder
    {
        return Session::query()
            ->with('vehicle')
            ->withCount('troubles')
            ->withCount('frames')
            ->withCount('monitors');
    }

    public function columns(): array
    {
        return [
            Column::make("ID")
                ->label(fn($row, Column $column) => $row->id),
            Column::make("Vehicle")
                ->label(function($row, Column $column){
                    return
                    '<div class="row">
                        <span class="lh-1">'.$row->vehicle->vin.'</span>
                        <small class="text-muted">PIN: '.$row->vehicle->pin.'</small>
                    </div>
                    ';
                })
                ->html(),
            Column::make("Status")
                ->label(function($row, Column $column){
                    return
                    ($row->status == SessionStatus::Active ? '<span class="badge rounded-pill bg-success text-blink me-1">&nbsp;'.$row->status->value.'&nbsp;</span>' : '')
                    .($row->status == SessionStatus::Closed ? '<span class="badge rounded-pill bg-danger-subtle me-1">'.$row->status->value.'</span>' : '');
                })
                ->html(),
            Column::make("Date")
                ->label(function($row, Column $column){
                    return
                    '<span class="text-truncate d-flex lh-1">'.Carbon::parse($row->created_at)->toFormattedDateString().'</span>
                    <small class="text-muted">'.Carbon::parse($row->created_at)->toTimeString().'</small>';
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


