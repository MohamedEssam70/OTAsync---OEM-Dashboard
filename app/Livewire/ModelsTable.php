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

class ModelsTable extends DataTableComponent
{
    protected $model = VehicleModel::class;

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
            ->setConfigurableAreas([
                'toolbar-right-end' => 'content.vehicles_model.tableComponant',
            ])
            ->setTableRowUrl(function($row) {
                return route('vehicles', $row->id);
            });
    }

    public function setTableRowClass($row): ?string
    {
        return 'bg-white';
    }

    public function builder(): Builder
    {
        return VehicleModel::query()
            ->withCount('vehicles')
            ->withCount('firmwares');
    }

    public function columns(): array
    {
        return [
            Column::make("Model")
                ->label(fn($row, Column $column) => $row->name)
                ->searchable(),
            Column::make("Serial Number")
                ->label(fn($row, Column $column) => $row->serial),
            Column::make("No. of Vehicles")
                ->label(function($row, Column $column){
                    return '<div class="w-px-50 d-flex align-items-center"><i class="fa-solid fa-car-rear me-2 text-primary"></i>'.$row->vehicles->count().'</div>';
                })
                ->html(),
            Column::make("Firmware Updates")
                ->label(function($row, Column $column){
                    return 
                    '<div class="row align-items-center">
                        <div class="col-auto me-1">
                            <div class="w-px-50 d-flex align-items-center"><i class="fa-solid fa-file-code me-2 text-black"></i>'.$row->firmwares->count().'</div>
                        </div>
                        <div class="col me-1">
                            <span class="text-truncate d-flex lh-1">CUREENT FIRMWARE</span>
                            <small class="text-muted">'
                            .(is_null($row->firmwares->last())? '--' : $row->firmwares->last()?->name).'
                            </small>                            
                        </div>
                        <div class="col me-1">
                            <span class="text-truncate d-flex lh-1">LAST UPDATE</span>
                            <small class="text-muted">'
                            .(is_null($row->firmwares->last())? '--' : Carbon::parse($row->firmwares->last()?->created_at)->toFormattedDateString()).'
                            </small>
                        </div>
                    </div>';
                })
                ->html(),
            Column::make("Up to Date Vehicles")
                ->label(function($row, Column $column){
                    return
                    '<div class="d-flex align-items-center gap-3">
                        <div class="progress w-100" style="height: 8px;">
                            <div class="progress-bar text-bg-success" style="width:'.$this->statistics($row).'%" aria-valuenow="'.$this->statistics($row).'%" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <small class="text-muted">'.$this->statistics($row).'%</small>
                    </div>';
                })
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    public function statistics($row)
    {
        $firmware = $row->firmwares->last()?->id;
        $target = $row->vehicles->count();
        $atchived = ($row->firmwares->count())? $row->vehicles->where("firmware", $firmware)->count() : 0;
        return $target!=0 ? round(($atchived/$target)*100, 1) : 0;
    }
}


