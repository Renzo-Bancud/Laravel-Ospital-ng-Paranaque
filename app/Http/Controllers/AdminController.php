<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Cashin;
use App\Cashout;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        return view('users.admin.index');
    }

    public function billing()
    {   
        $patients = DB::table('patients')
        ->join('test_charge_tickets', 'test_charge_tickets.ticket_number','=','patients.patient_ticket')
        ->join('radiologies','test_charge_tickets.item_id','=','radiologies.id')
        ->select('patients.*','patients.id as pid','test_charge_tickets.*','test_charge_tickets.amount as price','radiologies.*')
        ->get();

        return view('billing')->with('patients',$patients);
    }
}
