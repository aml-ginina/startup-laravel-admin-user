<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Barryvdh\TranslationManager\Models\Translation;
use App\Models\Setting;

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
        //Set the default locale as the first one.
        $locales = Translation::groupBy('locale')
            ->select('locale')
            ->get()
            ->pluck('locale');

        if ($locales instanceof Collection) {
            $locales = $locales->all();
        }
        $locales = array_merge([config('app.locale')], $locales);
        $locales = array_unique($locales);

        $app_logo = Setting::values('logo');
        if(!is_null($app_logo)) {
            $app_logo = asset('images/settings/'.$app_logo);
        }

        $app_logo_light = Setting::values('logo-light');
        if(!is_null($app_logo_light)) {
            $app_logo_light = asset('images/settings/'.$app_logo_light);
        }
        
        view()->share('locales', $locales);
        view()->share('app_logo', $app_logo);
        view()->share('app_logo_light', $app_logo_light);
    }
}
