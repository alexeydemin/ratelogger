<?php namespace tinkoff\Http\Controllers;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $items = ['Pack luggage', 'Go to airport', 'Arrive in San Juan'];
        \Log::debug($items);

        \Debugbar::error('Something is definitely going wrong.');
        $name = 'Anraham';
        $datii = date('Y-m-d');
        $lists = array(
                         array('name'=>'Vacation Planning', 'val'=>1),
                         array('name'=>'Grocery Shopping', 'val'=>2),
                         array('name'=>'Camping Trip', 'val'=>3),
                      );
        //$lists = array();
        return view('welcome', compact('name', 'lists', 'datii') );
	}

}
