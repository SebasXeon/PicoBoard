<?php
$web_routes = [
    '' => 'HomeController@index',
    '/404' => 'ExceptionController@pageNotFound',
    '/([a-zA-Z0-9\-]+)' => 'BoardController@index',
];