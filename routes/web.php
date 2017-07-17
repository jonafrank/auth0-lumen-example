<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return view('main');
    // return $app->version();
});

$app->get('/secure-route', ['middleware' => 'auth0', function() use ($app) {
    dump(Auth::user());
}]);
$app->get('/auth0/callback', 'Auth0Controller@callback');

$app->get('/api-secure', ['middleware'=> 'auth0.jwt', function() use ($app) {
    dump(Auth::user());
}]);
$app->get('/logout', function() use ($app) {
    $app['auth0']->logout();
    return redirect('/');
});
$app->get('/ping', function() use ($app) {
    return 'pong';
});
