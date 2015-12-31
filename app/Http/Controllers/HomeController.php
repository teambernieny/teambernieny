<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Requests;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $events = \teambernieny\Event::with('neighborhood')->orderby('Date', 'DESC')->get();
        return view('home')->with([
          'events' => $events
        ]);
    }
}
