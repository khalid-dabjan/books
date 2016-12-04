<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthersController extends Controller
{
    public function getAuthersList() {
        return view('authers.authersList');
    }
}
