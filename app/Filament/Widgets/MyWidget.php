<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MyWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        
        return [
            Stat::make('Total de Clientes', '100')
                ->description('Clientes ativos')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Pedidos Pendentes', '15')
                ->description('Aguardando confecção')
                ->color('warning'),

            Stat::make('Lucro Mensal', 'R$ 5.000,00')
                ->description('3% de aumento')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            //
        ];
    }
}
