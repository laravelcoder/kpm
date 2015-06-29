<?php
namespace Davzie\LaravelBootstrap\Front;
use Illuminate\Support\MessageBag;
use Auth, Session, Config, App, Request;
use Davzie\LaravelBootstrap\Menu\Menu;

class Page {

    /**
     * Compose the view with the following variables bound do it
     * @param  View $view The View
     * @return null
     */
    public function compose($view)
    {
        $settings_model = App::make('Davzie\LaravelBootstrap\Settings\SettingsInterface');
        $lang_model = App::make('Davzie\LaravelBootstrap\Langs\LangsInterface');
        $curr_lang  = $lang_model->getByCode(App::getLocale());

        $langs      = $lang_model->getActive();
        $lang_urls  = [];
        $url        = Request::server('REQUEST_URI');

        foreach ($langs as $lang) {
            $url                    = '/' . trim($url, '/') . '/';
            $lang_urls[$lang->code] = preg_replace('~^\/?[a-z]{2}\/~', "", $url);
            $lang_urls[$lang->code] = trim($lang_urls[$lang->code], '/');

            if ($lang->code != 'uk') {
                $lang_urls[$lang->code] = "$lang->code/" . $lang_urls[$lang->code];
            }

            $lang_urls[$lang->code] = "/" . $lang_urls[$lang->code];
        }

        $menu = Menu::where('parent_id', NULL)->where('lang_id', $curr_lang->id)->orderBy('order')->get();
        $settings = $settings_model->get();

        $view->with('user', Auth::user())
             ->with('lang_urls', $lang_urls)
             ->with('menu', $menu)
             ->with('settings', $settings)
             ->with('default_lang', $lang_model->defaultLang())
             ->with('success', Session::get('success' , new MessageBag ) );
    }

}