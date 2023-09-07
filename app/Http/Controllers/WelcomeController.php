<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EncyclopediaPages;
use App\Contacts;

class WelcomeController extends Controller
{
    public function index(){
   
    return view('welcome');
    }
}
