<?php

namespace App\Livewire;

use App\Models\VehicleModel;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Services\Constants;
use Illuminate\Support\Facades\Auth;


class ModelsTable extends DataTableComponent
{
    protected $model = VehicleModel::class;

    public $currentAuditors;
    public $auditors;

    // To show/hide the modal
    public bool $viewingModal = false;

    // The information currently being displayed in the modal
    public $currentModal;

    protected $listeners = ['updateStatus', 'resetModal', 'addAuditor', 'removeAuditor'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('name', 'asc')
            ->setColumnSelectDisabled()
            ->setOfflineIndicatorEnabled()
            ->setTableAttributes([
                'class' => 'table-hover',
            ])
            ->setTableRowUrl(function($row) {
                return route('models.show', $row->id);
            });
    }

    public function builder(): Builder
    {
        return VehicleModel::query()
            ->withCount('vehicles');
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "name")
                ->searchable(),
            Column::make("Vehicles")
                ->label(
                    fn($row, Column $column) => $row->vehicles_count
                )
                ->sortable(),
            Column::make("Serial Number", "serial")
                ->searchable(),
            Column::make("Current Firmware")
                ->label(
                    fn($row, Column $column) => $row->firmwares()->orderByDesc('id')->first()->name
                ),
                Column::make("Last Upgrade")
                    ->label(
                        fn($row, Column $column) => $row->firmwares()->orderByDesc('id')->first()->updated_at
                    ),
            // Column::make("Current Firmware", "firmware")
            //     ->format(
            //         fn($value, $row, Column $column) => '<span class="badge '.__("VehicleModel.status.{$row->status->value}").' me-1">'.$row->status->name.'</span>'
            //     )
            //     ->html(),
        ];
    }

    public function customView(): string
    {
        return 'content.modals.VehicleModel-table-modals';
    }

    public function viewModal($modelId)
    {
        $this->viewingModal = true;
        $this->currentModal = VehicleModel::findOrFail($modelId);
        $this->dispatch('openModal', $this->currentModal->status);
    }

    public function viewConvas($modelId)
    {
        $this->viewingModal = true;
        $this->currentModal = VehicleModel::findOrFail($modelId);
        $this->currentAuditors = $this->currentModal->users;
        $this->auditors = User::whereNotIn('id', $this->currentAuditors?->pluck('id'))->role(Constants::REVIEWER_ROLE)->get();
        $this->dispatch('openConvas', $this->currentModal);
    }

    public function resetModal()
    {
        $this->reset('viewingModal', 'currentModal', 'currentAuditors', 'auditors');
    }

    public function updateStatus($status)
    {
        $this->currentModal->update(['status' => $status]);
    }

    public function addAuditor($auditor)
    {
        if(!empty($auditor))
        {
            $this->currentModal->users()->attach($auditor);
        }
    }

    public function removeAuditor($auditor)
    {
        if(!empty($auditor))
        {
            $this->currentModal->users()->detach($auditor);
        }
    }

    public function toggleSwitch($rowId)
    {
        $VehicleModel = VehicleModel::findOrFail($rowId);
        $VehicleModel->update(['lock' => !$VehicleModel->lock]);
    }
}
