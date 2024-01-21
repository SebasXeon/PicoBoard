<?php

namespace App\Routes;

class WebRoutes{
    public function routes(){
        return [
            '' => 'HomeController@index',
            '/404' => 'ExceptionController@pageNotFound',
            '/([a-zA-Z0-9\-]+)' => 'BoardController@index',
            '/([a-zA-Z0-9\-]+)/thread/([0-9]+)' => 'ThreadController@index',
        ];
    }
}