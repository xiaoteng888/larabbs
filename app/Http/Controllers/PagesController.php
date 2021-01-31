<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class PagesController extends Controller
{
    public function root()
    {   
    	$site = Site::first();
    	return view('layouts.app',compact('site'));
    }
}
