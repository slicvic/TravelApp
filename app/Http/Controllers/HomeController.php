<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class HomeController extends BaseController
{
    /**
     * Show home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }
}
