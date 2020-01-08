<?php


namespace app\assets;


use yii\web\AssetBundle;

class ForIndex extends AssetBundle
{
    public $basePath = '@webroot'; //алиас каталога с файлами, который соответствует @web
    public $baseUrl = '@web';//Алиас пути к файлам
    public $css = [
        'forindex/css/linearicons.css',
        'forindex/css/owl.carousel.css',
        'forindex/css/font-awesome.min.css',
        'forindex/css/animate.css',
        'forindex/css/bootstrap.css',
        'forindex/css/main.css',

    ];
    public $js = [
        'forindex/js/vendor/jquery-2.2.4.min.js',
        'forindex/js/vendor/bootstrap.min.jss',
        'forindex/js/jquery.ajaxchimp.min.js',
        'forindex/js/jquery.sticky.js',
        'forindex/js/owl.carousel.min.js',
        'forindex/js/mixitup.min.js',
        'forindex/js/main.js'
    ];


}