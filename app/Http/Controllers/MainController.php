<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helper\NavBarHelper;

class MainController extends Controller
{
    public function getIndex() {
    	$obj = new NavBarHelper();
    	$site_details = $obj->siteData();
    	return view('pages.index', compact('site_details'));
    }
    public function getLogin() {
    	$obj = new NavBarHelper();
    	$site_details = $obj->siteData();
    	return view('pages.login', compact('site_details'));
    }
}
