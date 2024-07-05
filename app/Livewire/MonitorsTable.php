<?php

namespace App\Livewire;

use App\Models\Monitor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MonitorsTable extends DataTableComponent
{
    protected $model = Monitor::class;

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
        return Monitor::query()
            ->where('session_id', $this->id)
            ->with('session');
    }

    public function columns(): array
    {
        return [
            Column::make("PID")
                ->label(fn($row, Column $column) => $row->pid),
            Column::make("Description")
                ->label(fn($row, Column $column) => $row->description),
            Column::make("Value")
                ->label(function($row, Column $column){
                    return
                    !empty($row->value) ? $row->value.' '.$row->unit : '-';
                }),
            Column::make("Min")
                ->label(function($row, Column $column){
                    return
                    !empty($row->min) ? $row->min.' '.$row->unit : '-';
                }),
            Column::make("Average")
                ->label(function($row, Column $column){
                    return
                    !empty($row->avg) ? $row->avg.' '.$row->unit : '-';
                }),
            Column::make("Max")
                ->label(function($row, Column $column){
                    return
                    !empty($row->max) ? $row->max.' '.$row->unit : '-';
                }),
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }
}


