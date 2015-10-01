<?php
namespace Davzie\LaravelBootstrap\Composers;
use Illuminate\Support\MessageBag;
use Auth, Session, Config, App;

class Page {

    /**
     * Compose the view with the following variables bound do it
     * @param  View $view The View
     * @return null
     */
    public function compose($view)
    {
        $settings = App::make('Davzie\LaravelBootstrap\Settings\SettingsInterface');
        $lang_model    = App::make('Davzie\LaravelBootstrap\Langs\LangsInterface');

        $view->with('user', Auth::user())
             ->with('app_name', $settings->getAppName() )
             ->with('urlSegment', Config::get('laravel-bootstrap::app.access_url') )
             ->with('menu_items', Config::get('laravel-bootstrap::app.menu_items') )
             ->with('langs_list', $lang_model->getList())
             ->with('default_lang', $lang_model->defaultLang())
             ->with('success', Session::get('success' , new MessageBag ) );
    }

}