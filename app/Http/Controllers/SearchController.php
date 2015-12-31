<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SearchController extends Controller {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    public function getSearch(Request $request){

      return view('search.home');
    }
    public function postSearch(Request $request){

      return view('search.home');
    }






}
