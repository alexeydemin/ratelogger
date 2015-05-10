<?php namespace App\Http\Controllers;

use App\Parser;

class ParserController extends Controller {
//use Parser;

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function index()
    {
        $parser = new Parser();
        $parser->parse();
        //return view('welcomezz');
    }
}