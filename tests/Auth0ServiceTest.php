<?php

class Auth0ServiceTest extends TestCase
{
    public $service;

    public function __construct()
    {
        $this->service = app()->make('auth0');
    }

    public function testGetUser()
    {
        $user = $this->service->getUser();
        dd($user);
    }
}
