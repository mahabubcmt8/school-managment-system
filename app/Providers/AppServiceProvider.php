<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        $settings = Settings::latest()->first();

        config([
            'site.name' => $settings->system_name ?? 'SCHOOL MANAGEMENT SYSTEM',
            'site.title' => $settings->system_title ?? 'SCHOOL MANAGEMENT SYSTEM',
            'site.email' => $settings->email ?? '',
            'site.phone' => $settings->phone ?? '',
            'site.address' => $settings->addresss ?? '',
            'site.description' => $settings->system_description ?? '',
            'site.favicon' => $settings->favicon ? asset('storage/images/settings/' . $settings->favicon) : asset('backend/assets/images/logo.png'),
            'site.logo' => $settings->logo ? asset('storage/images/settings/' . $settings->logo) : asset('backend/assets/images/logo.png'),
            'site.facebook' => $settings->facebook ?? 'www.facebook.com',
            'site.youtube' => $settings->youtube ?? 'www.youtube.com',
            'site.twitter' => $settings->twitter ?? 'www.twitter.com',
            'site.linkedin' => $settings->linkedin ?? 'www.linkedin.com',
            'site.timezone' => $settings->timezone ?? 'DHAKA',
            'site.currency_symbol' => $settings->currency_symbol ?? '৳',
        ]);
    }
}
