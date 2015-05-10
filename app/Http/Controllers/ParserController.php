<?php namespace tinkoff\Http\Controllers;

use tinkoff\Parser;

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