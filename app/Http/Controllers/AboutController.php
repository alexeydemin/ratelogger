<?php namespace tinkoff\Http\Controllers;

use tinkoff\Http\Requests;
use tinkoff\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AboutController extends Controller {

    function index()
    {
        return view('about.index');
    }

}
