<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

class HotelsController extends BaseController
{
    public function index()
    {
        return view('hotels.index');
    }

    public function search()
    {
        return view('hotels.search');
    }
}
