<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'domain'     => config('admin.route.domain'),
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', 'UserController');
    $router->resource('permission', 'PermissionController');
    $router->resource('roles', 'RoleController');
    $router->resource('topics', 'TopicController');
    $router->resource('categories', 'CategoryController');
    $router->resource('sites', 'SiteController');
    $router->resource('links', 'LinkController');
});
