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
        $twoweeks = time() - (7 * 24 * 60 * 60 * 2);
        $events = \teambernieny\Event::with('neighborhood')->with('files')->where('Date','>', date('Y-m-d',$twoweeks))->where('id','!=','1')->orderby('Date', 'DESC')->get();
        return view('home')->with([
          'events' => $events
        ]);
    }

    public function getAdminHome(){
      $twoweeks = time() - (7 * 24 * 60 * 60 * 2);
      $events = \teambernieny\Event::with('neighborhood')->where('Date','>', date('Y-m-d',$twoweeks))->where('id', '!=', '1')->orderby('Date', 'DESC')->get();
      return view('adminhome')->with([
        'events' => $events
      ]);
    }
}
