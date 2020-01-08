<?php


namespace app\assets;


use yii\web\AssetBundle;

class MyClassAsset extends AssetBundle
{
    public $basePath = '@webroot'; //алиас каталога с файлами, который соответствует @web
    public $baseUrl = '@web';//Алиас пути к файлам
    public $css = [
        'css/bootstrap.min.css',
        'css/styleNews.css',
        'css/site.css',
        'css/ready.css',
        'css/ws.css',
        'css/demo.css',
        'js/datepicker/css/jquery.datetimepicker.css'

    ];
    public $js = [
        'js/core/jquery.3.2.1.min.js',
        'js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js',
        'js/core/popper.min.js',
        'js/core/bootstrap.min.js',
        'js/plugin/chartist/chartist.min.js',
        'js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js',
        'js/plugin/bootstrap-notify/bootstrap-notify.min.js',
        'js/plugin/bootstrap-toggle/bootstrap-toggle.min.js',
        'js/plugin/jquery-mapael/jquery.mapael.min.js',
        'js/plugin/jquery-mapael/maps/world_countries.min.js',
        'js/plugin/chart-circle/circles.min.js',
        'js/plugin/jquery-scrollbar/jquery.scrollbar.min.js',
        'js/ready.min.js',
        'js/datepicker/js/jquery.datetimepicker.js'
    ];


}