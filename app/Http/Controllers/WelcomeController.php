<?php

// WelcomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// WelcomeController


class WelcomeController extends Controller
{
    //welcome method
    public function welcome()
    {
        return view('welcome');
    }
}