<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function create(Request $request): View
    {
        $id = (int)$request->route('id');

        return view('applications.create', ['id' => $id]);
    }
}
