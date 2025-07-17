<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    /**
     * Main documentation index page
     */
    public function index()
    {
        return view('documentation');
    }

    /**
     * API Documentation page (general)
     */
    public function api()
    {
        return view('docs.api');
    }

    /**
     * WebApp API Documentation page
     */
    public function webapp()
    {
        return view('docs.webapp');
    }
}
