<?php

namespace teambernieny\Http\Controllers;

use teambernieny\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class FileController extends Controller {


    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    public function getAdd(Request $request){

      return view('add.file');
    }
    public function postAdd(Request $request){

      return view('add.file');
    }
}
