<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Redirect to the Dashboard controller
        return redirect()->to('/dashboard');
    }
}