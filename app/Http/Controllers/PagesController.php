<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Animal;
use App\Location;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        return view('pages.data_manage.index');
    }
}
