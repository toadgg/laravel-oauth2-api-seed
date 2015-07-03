<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::get('test', ['middleware' => 'oauth', function() {
//    echo "oauth 认证成功 user id: " . Authorizer::getResourceOwnerId();
    echo App\User::find(Authorizer::getResourceOwnerId());
}]);

Route::get('test2', function() {
//    echo "oauth 认证成功 user id: " . Authorizer::getResourceOwnerId();
    echo Request::header('Authorization');
});

$api = app('api.router');
$api->version('v1', function ($api) {
    $api->get('users/{id}',['middleware' => 'oauth'], 'Api\V1\UserController@show');
    $api->post('users/register', 'Api\V1\UserController@register');
});
