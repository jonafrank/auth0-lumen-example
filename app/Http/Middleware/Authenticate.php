<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    protected $userRepository;
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
        $this->userRepository = app()->make(\Auth0\Lumen\Repository\Auth0UserRepository::class);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $service = app()->make('auth0');
        $profile = $service->getUser();
        dump($profile);
        $auth0User = $this->userRepository->getUserByUserInfo($profile);
        $this->auth->viaRequest('api', function() use ($auth0User) {
            return $auth0User;
        });
        return $next($request);
    }
}
