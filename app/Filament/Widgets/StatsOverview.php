<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;
use App\Models\Movement;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cantidad de productos', Product::query()->count()),
	    Stat::make('Movimientos de hoy', Movement::query()->whereDate('created_at', Carbon::today())->count())
        ];
    }
}
