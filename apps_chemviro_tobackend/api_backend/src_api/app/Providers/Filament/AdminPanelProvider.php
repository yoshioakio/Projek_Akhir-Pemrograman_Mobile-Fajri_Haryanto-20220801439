<?php

namespace App\Providers\Filament;

use App\Filament\Admin\Resources\WidgetsResource\Widgets;
use App\Filament\Admin\Resources\WidgetsResource\Widgets\LatestSalesOrder;
use App\Filament\Admin\Resources\WidgetsResource\Widgets\LatestTasks;
use App\Filament\Admin\Resources\WidgetsResource\Widgets\StatusInvoice;
use App\Filament\Admin\Resources\WidgetsResource\Widgets\TaskStatusWidget;
use App\Filament\Admin\Resources\WidgetsResource\Widgets\TotalSalesOrder;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Rupadana\ApiService\ApiServicePlugin;

// use App\Filament\Admin\Resources\WidgetsResource\Widgets\MonthlyRevenueChart;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->spa(true)
            ->login()
            ->passwordReset()
            ->defaultThemeMode(ThemeMode::Light)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->maxContentWidth('7xl')
            ->sidebarCollapsibleOnDesktop(true)
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            // ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                // \Awcodes\Overlook\Widgets\OverlookWidget::class,
                // \App\Filament\Admin\Resources\UserResource\Widgets\Roles::class,
                // \App\Filament\Admin\Resources\OrderResource\Widgets\TotalOrder::class,
                // \App\Filament\Admin\Resources\OrderResource\Widgets\LatestOrder::class,
                // \App\Filament\Admin\Resources\InvoiceResource\Widgets\StatusInvoice::class,
                TotalSalesOrder::class,
                StatusInvoice::class,
                LatestSalesOrder::class,
                TaskStatusWidget::class,
                LatestTasks::class,
                // MonthlyRevenueChart::class,
            ])
            ->plugins([
                \Jeffgreco13\FilamentBreezy\BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true,
                        shouldRegisterNavigation: false,
                        hasAvatars: true,
                        slug: 'profile'
                    ),

                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
                    ->gridColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 3,
                    ])
                    ->sectionColumnSpan(1)
                    ->checkboxListColumns([
                        'default' => 1,
                        'sm' => 2,
                        'lg' => 2,
                    ]),

                \Hasnayeen\Themes\ThemesPlugin::make(),

                \Awcodes\LightSwitch\LightSwitchPlugin::make()
                    ->position(\Awcodes\LightSwitch\Enums\Alignment::BottomCenter)
                    ->enabledOn([
                        'auth.login',
                        'auth.password',
                    ]),
                \Swis\Filament\Backgrounds\FilamentBackgroundsPlugin::make()
                    ->showAttribution(false),

                \Awcodes\Overlook\OverlookPlugin::make()
                    ->includes([
                        \App\Filament\Admin\Resources\UserResource::class,
                    ]),

                \Njxqlus\FilamentProgressbar\FilamentProgressbarPlugin::make()->color('#29b'),
                ApiServicePlugin::make(),
            ])
            ->navigationGroups([

                NavigationGroup::make()
                    ->label('Administration')
                    ->icon('heroicon-o-cog-8-tooth'),
                NavigationGroup::make()
                    ->label('Company Management')
                    ->icon('heroicon-o-building-office'),
                NavigationGroup::make()
                    ->label('Client Management')
                    ->icon('heroicon-o-building-office-2'),
                NavigationGroup::make()
                    ->label('Master Data Product')
                    ->icon('heroicon-o-circle-stack'),
                NavigationGroup::make()
                    ->label('Product Management')
                    ->icon('heroicon-o-building-storefront'),
                NavigationGroup::make()
                    ->label('Sales Management')
                    ->icon('heroicon-o-sparkles'),
                NavigationGroup::make()
                    ->label('Lab Management')
                    ->icon('heroicon-o-beaker'),
                NavigationGroup::make()
                    ->label('Finance Management')
                    ->icon('heroicon-o-currency-dollar'),
            ])
            ->resources([
                config('filament-logger.activity_resource'),
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,

                \Hasnayeen\Themes\Http\Middleware\SetTheme::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
