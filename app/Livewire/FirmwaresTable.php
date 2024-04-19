<?php

namespace App\Livewire;

use App\Enums\FirmwareStatus;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Registry;
use App\Models\Firmware;
use App\Services\Constants;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class FirmwaresTable extends DataTableComponent
{
    protected $model = Firmware::class;

    public $currentAuditors;
    public $auditors;

    // To show/hide the modal
    public bool $viewingModal = false;

    // The information currently being displayed in the modal
    public $currentModal;

    protected $listeners = ['updateStatus'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'asc')
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
            });
            // ->setConfigurableAreas([
            //     'toolbar-right-end' => 'content\Team\tableComponant',
            // ]);
    }

    public function setTableRowClass($row): ?string
    {
        return 'bg-white';
    }

    public function builder(): Builder
    {
        return Firmware::query()
            ->withCount('VehicleModel');
    }

    public function columns(): array
    {
        return [
            Column::make("Firmware")
                ->label(fn($row, Column $column) => $row->name)
                ->searchable()
                ->unclickable(),
            Column::make("Version")
                ->label(fn($row, Column $column) => $row->version)
                ->unclickable(),
            Column::make("Release Date")
                ->label(function($row, Column $column){
                    return
                    '<span class="text-truncate d-flex lh-1">'.Carbon::parse($row->created_at)->toFormattedDateString().'</span>
                    <small class="text-muted">'.Carbon::parse($row->created_at)->toTimeString().'</small>';
                })
                ->html(),
            Column::make("status")
                ->label(function($row, Column $column)
                {
                    return
                    '<span class="text-truncate d-flex align-items-center">'
                    .($row->status == FirmwareStatus::Valid ?  '<a class="" href="javascript:void(0);" wire:click.prevent="viewModal('.$row->id.')"><span class="badge rounded-pill bg-label-success me-1">'. $row->status->value .'</span></a>' : '')
                    .($row->status == FirmwareStatus::Expired ?  '<a class="" href="javascript:void(0);" wire:click.prevent="viewModal('.$row->id.')"><span class="badge rounded-pill bg-label-secondary me-1">'. $row->status->value .'</span></a>' : '')
                    .($row->status == FirmwareStatus::Beta ?  '<a class="" href="javascript:void(0);" wire:click.prevent="viewModal('.$row->id.')"><span class="badge rounded-pill bg-label-warning me-1">'. $row->status->value .'</span></a>' : '')
                    .($row->status == FirmwareStatus::Expires_Soon ?  '<a class="" href="javascript:void(0);" wire:click.prevent="viewModal('.$row->id.')"><span class="badge rounded-pill bg-label-danger me-1">'. $row->status->value .'</span></a>' : '')
                    ;
                })
                ->html()
                ->unclickable(),
            // Column::make("Reports")
            //     ->label(fn($row, Column $column) => '5'),
            Column::make("Broadcast")
                ->label(function($row, Column $column){
                    return
                    '<div class="row align-items-center">
                        <div class="col-auto me-1">
                            <span class="text-truncate d-flex text-info lh-1">MODEL</span>
                            <small class="text-muted">'.$row->VehicleModel->name.'</small>
                        </div>
                        <div class="col">
                            <span>Progress</span>
                            <div class="d-flex align-items-center gap-3">
                                <div class="progress w-100" style="height: 8px;"><div class="progress-bar" style="width:'.$this->statisticsModel($row->id)["progress"].'%" aria-valuenow="'.$this->statisticsModel($row->id)["progress"].'%" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                            <small class="text-muted">'.$this->statisticsModel($row->id)["atchived"].'/'.$this->statisticsModel($row->id)["target"].'</small>
                        </div>
                    </div>';
                })
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
            // SelectFilter::make('Active')
            // ->options([
            //     '' => 'All',
            //     '1' => 'Yes',
            //     '0' => 'No',
            // ])
            // ->filter(function(Builder $builder, string $value) {
            //     if ($value === '1') {
            //         $builder->where('active', true);
            //     } elseif ($value === '0') {
            //         $builder->where('active', false);
            //     }
            // }),
        ];
    }

    public function customView(): string
    {
        return 'content.firmware.update-status-modal';
    }

    public function viewModal($modelId)
    {
        $this->viewingModal = true;
        $this->currentModal = Firmware::findOrFail($modelId);
        $this->dispatch('openModal', $this->currentModal->status);
    }

    public function updateStatus($status)
    {
        $this->currentModal->update(['status' => $status]);
    }

    public function statisticsModel($id)
    {
        $vehicle_model = Firmware::findOrFail($id)->VehicleModel;
        $target = $vehicle_model->vehicles->count();
        $atchived = $vehicle_model->vehicles->where("firmware", $id)->count();
        $progress = ($atchived/$target)*100;
        return ["target" => $target, "atchived" => $atchived, "progress" => $progress];
    }
}


