<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DataController extends Controller {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /*public function gethome(Request $request) {
      $events = \teambernieny\Event::with('neighborhood')->orderby('Date', 'DESC')->get();
      return view('home')->with([
        'events' => $events
      ]);
    }
    */
}
