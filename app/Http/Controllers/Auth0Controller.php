<?php

namespace App\Http\Controllers;

use Auth0\Lumen\Contract\Auth0UserRepository;

class Auth0Controller extends Controller
{
    /**
     * @var Auth0UserRepository
     */
    protected $userRepository;

    /**
     * Auth0Controller constructor.
     *
     * @param Auth0UserRepository $userRepository
     */
    public function __construct()
    {
        // $this->userRepository = $userRepository;
        $this->userRepository = app()->make(\Auth0\Lumen\Repository\Auth0UserRepository::class);
    }

    /**
     * Callback action that should be called by auth0, logs the user in.
     */
    public function callback()
    {
        // Get a handle of the Auth0 service (we don't know if it has an alias)
        $service = app()->make('auth0');

        // Try to get the user information
        $profile = $service->getUser();

        // Get the user related to the profile
        $auth0User = $this->userRepository->getUserByUserInfo($profile);

        if ($auth0User) {
            // If we have a user, we are going to log him in, but if
            // there is an onLogin defined we need to allow the Lumen developer
            // to implement the user as he wants an also let him store it.
            if ($service->hasOnLogin()) {
                $user = $service->callOnLogin($auth0User);
            } else {
                // If not, the user will be fine
                $user = $auth0User;
            }
            app()->make('auth')->viaRequest('api', function() use ($user){
                return $user;
            });
        }

        return redirect(env('AUTH0_CALLBACK_REDIRECT', '/');
    }
}
