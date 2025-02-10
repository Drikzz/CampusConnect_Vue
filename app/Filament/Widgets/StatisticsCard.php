<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;
use App\Models\User;

class StatisticsCard extends Widget
{
    protected static string $view = 'filament.widgets.statistics-card';

    public function render(): View
    {
        $totalUsers = User::count();

        return view(static::$view, [
            'totalUsers' => $totalUsers,
        ]);
    }
}