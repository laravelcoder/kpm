<?php
 // app/widgets/WidgetsServiceProvider.php
namespace Widgets;

use Illuminate\Support\ServiceProvider;
use View;

class WidgetsServiceProvider extends ServiceProvider
{
    public function register()
    {
        View::composer('widgets.last-posts', '\Widgets\LatestNews');
        View::composer('widgets.rubrics', '\Widgets\Rubrics');
        View::composer('widgets.teachers', '\Widgets\Teachers');
        View::composer('widgets.adverts', '\Widgets\Adverts');
    }
}