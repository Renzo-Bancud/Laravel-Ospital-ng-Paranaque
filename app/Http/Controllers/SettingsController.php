<?php

namespace App\Http\Controllers;

use App\Activitylog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
   public function getActivitylogs(){
      
     $logs = DB::table('activitylogs')->join('users','activitylogs.user_id','=','users.id')
     ->select('users.*','activitylogs.*','activitylogs.status as logstatus')
     ->orderBy('activitylogs.id','DESC')
     ->get();
     return view('activitylogs')->with('logs', $logs);
   }
}
