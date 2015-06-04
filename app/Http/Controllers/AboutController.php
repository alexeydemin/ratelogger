<?php namespace tinkoff\Http\Controllers;

use tinkoff\Http\Requests;
use tinkoff\Http\Controllers\Controller;
use tinkoff\Exchange;

use Illuminate\Http\Request;

class AboutController extends Controller {

    function create()
    {
        $article = Exchange::all()->first();
        //dd( $article->category );
        return view('about.index')->with('articles', $article);
    }

    function keep(Request $request)
    {
        $this->validate($request, ['dummy' => 'required']  );

        return 'list';
    }


}
