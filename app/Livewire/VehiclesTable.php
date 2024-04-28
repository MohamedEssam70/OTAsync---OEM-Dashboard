<?php

namespace App\Livewire;

use App\Models\Firmware;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class VehiclesTable extends DataTableComponent
{
    protected $model = Vehicle::class;

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
            ->setConfigurableAreas([
                'toolbar-right-end' => 'content\vehicles\tableComponant',
            ]);
    }

    public function setTableRowClass($row): ?string
    {
        return 'bg-white';
    }

    public function builder(): Builder
    {
        return Vehicle::query()
            ->where('model', $this->id)
            ->withCount('models')
            ->withCount('firmwares');
    }

    public function columns(): array
    {
        return [
            Column::make("Vehicle")
                ->label(function($row, Column $column){
                    return
                    '<div class="row align-items-center">
                        <div class="col-auto me-1">
                            <span class="text-truncate d-flex lh-1">VIN NUMBER</span>
                            <small class="text-muted">'.$row->vin.'</small>
                        </div>
                        <div class="col">
                            <span class="text-truncate d-flex lh-1">PIN NUMBER</span>
                            <small class="text-muted">'.$row->pin.'</small>
                        </div>
                    </div>
                    ';
                })
                ->html(),
            Column::make("Firmware Updates")
                ->label(function($row, Column $column){
                    return 
                    '<div class="row align-items-center">
                        <div class="col me-1">
                            <span class="text-truncate d-flex lh-1">CUREENT FIRMWARE</span>
                            <small class="text-muted">'
                            . ($row->currentFirmware?->name ?? '--') .'
                            </small>                            
                        </div>
                        <div class="col me-1">
                            <span class="text-truncate d-flex lh-1">UPDATED ON</span>
                            <small class="text-muted">'
                            .(empty($row->currentFirmware) ? '--' : Carbon::parse($row->currentFirmware->updated_at)->toFormattedDateString()).'
                            </small>
                        </div>
                        <div class="col">
                        <span class="text-truncate d-flex align-items-center">'
                        .($this->checkUpdate($row) ?  '<span class="badge rounded-pill bg-label-success me-1">UP TO DATE</span>' : '<span class="badge rounded-pill bg-label-warning me-1">UPDATE AVAILABLE</span>')
                        .'</span></div>
                        <div class="col">
                        <span class="text-truncate d-flex align-items-center">'
                        .($this->customUpdate($row) ?  '<span class="badge rounded-pill bg-label-primary me-1">SYSTEM UPDATER</span>' : '<span class="badge rounded-pill bg-label-info me-1">CUSTOM UPDATE</span>')
                        .'</span></div>
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

    public function checkUpdate($row)
    {
        $firmwares = Firmware::where('id', $row->firmware)->orWhere('vehicle_model_id', $this->id)->orWhere('vehicle_id', $row->id)->orderByDesc('id')->get();
        return $row->firmware == $firmwares->first()?->id;
    }

    public function customUpdate($row)
    {
        return empty(Firmware::find($row->firmware)?->vehicle_id);
    }
}


