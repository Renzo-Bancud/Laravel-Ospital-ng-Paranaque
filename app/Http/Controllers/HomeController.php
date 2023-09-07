<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Department;
use App\Medicine;
use Illuminate\Http\Request;
use App\Patient_procedure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        if (Auth::user()->type == 2) {

            $token = uniqid('', true); // generate a more unique ID
            $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
            $token .= time(); // add the current timestamp
            session()->put('form_token', $token); // store the token in the session

            if (Auth::user()->dept_id == 1) { // Laboratory
                $laboratories = DB::table('laboratories')
                ->join('laboratory_categories','laboratories.category_id','=','laboratory_categories.id')
                ->get();
                $patient_requests = DB::table('test_charge_tickets')
                    ->join('laboratories','test_charge_tickets.item_id','=','laboratories.id')
                    ->join('laboratory_categories','laboratories.category_id','=','laboratory_categories.id')
                    ->groupBy('test_charge_tickets.ticket_number')
                    ->where('dept_id', Auth::user()->dept_id)
                    ->get();
                $department_request = Department::where('dep_id', Auth::user()->dept_id)->first();
                return view('home', ['token' => $token])
                    ->with('patient_requests', $patient_requests)
                    ->with('department_request', $department_request)
                    ->with('departments', Department::all())
                    ->with('laboratories',$laboratories);
            } elseif (Auth::user()->dept_id == 2) { // Pharmacy
                $medicines = DB::table('pharmacies')
                ->join('pharmacy_categories','pharmacies.category_id','=','pharmacy_categories.id')
                ->select('pharmacies.*','pharmacies.id as pharma_id','pharmacy_categories.*')
                ->get();
                $patient_requests = DB::table('test_charge_tickets')
                    ->join('pharmacies','test_charge_tickets.item_id','=','pharmacies.id')
                    ->join('pharmacy_categories','pharmacies.category_id','=','pharmacy_categories.id')
                    ->groupBy('test_charge_tickets.ticket_number')
                    ->where('dept_id', Auth::user()->dept_id)
                    ->get();
                $department_request = Department::where('dep_id', Auth::user()->dept_id)->first();
                return view('home', ['token' => $token])
                    ->with('patient_requests', $patient_requests)
                    ->with('department_request', $department_request)
                    ->with('medicines', $medicines)->with('departments', Department::all());
            } elseif (Auth::user()->dept_id == 3) { // Radiology
                $radiologies = DB::table('radiologies')
                ->join('radiology_categories','radiologies.category_id','=','radiology_categories.id')
                ->get();
                $patient_requests = DB::table('test_charge_tickets')
                    ->join('radiologies','test_charge_tickets.item_id','=','radiologies.id')
                     ->join('radiology_categories','radiologies.category_id','=','radiology_categories.id')
                    ->groupBy('test_charge_tickets.ticket_number')
                    ->where('dept_id', Auth::user()->dept_id)
                    ->get();
                $department_request = Department::where('dep_id', Auth::user()->dept_id)->first();
                return view('home', ['token' => $token])->with('patient_requests', $patient_requests)
                ->with('department_request', $department_request)
                ->with('radiologies',$radiologies)
                ->with('departments', Department::all());
            } elseif (Auth::user()->dept_id == 4) { // Dialysis
                $hemodialysis = DB::table('hemodialysis')
                ->join('hemodialysis_categories','hemodialysis.category_id','=','hemodialysis_categories.id')
                ->get();
                $patient_requests = DB::table('test_charge_tickets')
                    ->join('hemodialysis','test_charge_tickets.item_id','=','hemodialysis.id')
                    ->join('hemodialysis_categories','hemodialysis.category_id','=','hemodialysis_categories.id')
                    ->join('patients','test_charge_tickets.ticket_number','=','patients.patient_ticket')
                    ->groupBy('test_charge_tickets.ticket_number')
                    ->where('dept_id', Auth::user()->dept_id)
                    ->get();
                $department_request = Department::where('dep_id', Auth::user()->dept_id)->first();
                return view('home', ['token' => $token])
                    ->with('patient_requests', $patient_requests)
                    ->with('department_request', $department_request)
                    ->with('hemodialysis',$hemodialysis)
                    ->with('departments', Department::all());
            } else {
                return redirect('login')->with('error', 'Contact admin. We cant find your dept.');
            }
        } elseif (Auth::user()->type == 5) {

            $token = uniqid('', true); // generate a more unique ID
            $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
            $token .= time(); // add the current timestamp
            session()->put('form_token', $token); // store the token in the session


            $patients = DB::table('patients')
                ->join('test_charge_tickets', 'patients.patient_ticket', '=', 'test_charge_tickets.ticket_number')
                ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
                ->select('patients.*','test_charge_tickets.*','departments.*','patients.id as pid','patients.created_at as date_request')
                ->where('patients.request_status',3)
                ->groupBy('test_charge_tickets.ticket_number')
                ->get();

            return view('home',['token' => $token])->with('patients', $patients);


        } elseif (Auth::user()->type == 8) {
            
            $token = uniqid('', true); // generate a more unique ID
            $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
            $token .= time(); // add the current timestamp
            session()->put('form_token', $token); // store the token in the session

            $patient_requests = DB::table('patients')
                ->join('test_charge_tickets', 'patients.patient_ticket', '=', 'test_charge_tickets.ticket_number')
                ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
                ->select('patients.*','test_charge_tickets.*','departments.*','patients.id as pid','patients.created_at as date_request')
                ->groupBy('test_charge_tickets.ticket_number')
                ->get();
            return view('home',['token' => $token])->with('patient_requests', $patient_requests);

        } elseif (Auth::user()->type == 1) {

            
            $charges = DB::table('test_charge_tickets')
            ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
            ->join('patients', 'test_charge_tickets.ticket_number', '=', 'patients.patient_ticket')
            ->select(
                DB::raw('SUM(test_charge_tickets.amount) as total_charge'),
                DB::raw('MONTH(test_charge_tickets.created_at) as month')
            )
            ->whereYear('test_charge_tickets.created_at', date('Y'))
            ->where('test_charge_tickets.ticket_status',2)
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();
        
        $months = [];
        $totalCharges = [];
        
        if (count($charges) > 0) {
            foreach ($charges as $charge) {
                $monthName = date('F', mktime(0, 0, 0, $charge->month, 1));
                $months[] = $monthName;
                $totalCharges[] = $charge->total_charge;
            }
        } else {
            // If there are no charges, set default labels and values
            $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $totalCharges = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        }
        

            $patients = DB::table('test_charge_tickets')
                ->join('patients', function ($join) {
                    $join->on('test_charge_tickets.ticket_number', '=', 'patients.patient_ticket')
                        ->whereRaw('test_charge_tickets.ticket_number COLLATE utf8mb4_unicode_ci = patients.patient_ticket COLLATE utf8mb4_unicode_ci');
                })
                ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
                ->join('users', 'patients.id', '=', 'users.id')
                ->select(
                    'test_charge_tickets.*',
                    'users.*',
                    'departments.*',
                    'patients.*',
                //  DB::raw('COUNT(CASE WHEN patients.request_status IS NULL THEN 1 END) as request_pending_count'),
                //  DB::raw('COUNT(CASE WHEN patients.request_status = 1 THEN 1 END) as request_forapproval_count'),
                //  DB::raw('COUNT(CASE WHEN patients.request_status = 2 THEN 1 END) as request_disapprove_count'),
                //  DB::raw('COUNT(CASE WHEN patients.request_status = 3 THEN 1 END) as request_approve_count'),
                //  DB::raw('COUNT(CASE WHEN patients.request_status = 4 THEN 1 END) as request_completed_count')
                )
                ->groupBy('test_charge_tickets.ticket_number')
                ->orderBy('users.id', 'DESC')
                ->get();

            $count_pending_request = DB::table('patients')->where('request_status', null)->count();

            //Accounts
            $count_patients = DB::table('patients')->count();
            $count_today_patients = DB::table('patients')->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::tomorrow())->count();

            if ($count_patients > 0) {
                $percentage_today_patients = ($count_today_patients / $count_patients) * 100;
            } else {
                $percentage_today_patients = 0;
            }

            $count_malasakits = DB::table('users')->where('type', 8)->count();
            $count_today_malasakit = DB::table('users')->where('type', 8)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::tomorrow())->count();

            if ($count_malasakits > 0) {
                $percentage_today_malasakit = ($count_today_malasakit / $count_malasakits) * 100;
            } else {
                $percentage_today_malasakit = 0;
            }

            $count_departments = DB::table('users')->where('type', 2)->count();
            $count_today_department = DB::table('users')->where('type', 2)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::tomorrow())->count();
             
            if ($count_departments  > 0) {
                $percentage_today_department = ($count_today_department / $count_departments ) * 100;
            } else {
                $percentage_today_department = 0;
            }

            $count_ppps = DB::table('users')->where('type', 5)->count();
            $count_today_ppp = DB::table('users')->where('type', 5)->where('created_at', '>=', Carbon::today())->where('created_at', '<=', Carbon::tomorrow())->count();

            if ($count_ppps  > 0) {
                $percentage_today_ppp = ($count_today_ppp / $count_ppps ) * 100;
            } else {
                $percentage_today_ppp = 0;
            }

            session(['chartData' => [ // add session array so that it will not throw error on all tab undefined this variable
                'months' => $months,
                'totalCharges' => $totalCharges
            ]]);

            return view('home')
            ->with('months', $months)
            ->with('totalCharges', $totalCharges)
            ->with('patients', $patients)
            ->with('count_pending_request', $count_pending_request)
            ->with(['count_patients' => $count_patients, 'percentage_today_patients' => $percentage_today_patients])
            ->with(['count_departments' => $count_departments,'percentage_today_department' => $percentage_today_department])
            ->with(['count_ppps' => $count_ppps, 'percentage_today_ppp' => $percentage_today_ppp])
            ->with(['count_malasakits' => $count_malasakits, 'percentage_today_malasakit' => $percentage_today_malasakit]);
        
        } else {
            return redirect()->route('login')->with('error', 'You dont have the right to access.');
        }
    }

    public function change_password(Request $request)
    {
        $user_id = Crypt::decryptString($request->user_id);
        $get_account = DB::table('users')->where('id', $user_id)->first();
    
        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, $get_account->password)) {
            return back()->with('error', 'Old password does not match');
        }
    
        // Update the user's password with the new password
        $new_password = bcrypt($request->new_password);
        DB::table('users')->where('id', $user_id)->update(['password' => $new_password]);

        $data = array(
            'user_id' => auth()->user()->id,
            'user_type' => 'Any Staff',
            'activity_type' => 'Change Password',
            'ip_address' => $request->ip(),
            'device_info' => $request->header('User-Agent'),
            'details' => 'Table Record ID'.' '.$user_id,
            'status' => 'success',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         );
          
         DB::table('activitylogs')->insert($data);
    
        return back()->with('success', 'Password updated successfully');
    }
    
    public function change_profile(Request $request)
    {
        $user_id = Crypt::decryptString($request->user_id);
        $get_account = DB::table('users')->where('id', $user_id)->first();

        if(empty($request->picture)){

            $filename = $get_account->picture;

            return back();

        }else{
            if($request->hasFile('picture')) {
                $request_path = public_path('upload') . '/' . $request->picture;
                if (file_exists($request_path)) {
                    File::delete($request_path);
                }
        
                $profile = $request->file('picture');
        
                $filename = $profile->getClientOriginalName();
                $profile->move(public_path('upload'), $filename);
            } else {
                $filename = null;
            }

            DB::table('users')->where('id', $user_id)->update(array('picture' => $filename));

            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Any Staff',
                'activity_type' => 'Change Profile',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$user_id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
    
            return back()->with('success', 'Profile successfully change');
        }
    
       
    }


    public function change_account(Request $request)
    {
        $user_id = Crypt::decryptString($request->user_id);
        $get_account = DB::table('users')->where('id', $user_id)->first();


        $user_email = DB::table('users')->where('email', $request->email)->first();


if ($user_email ) {
    // The email exists in the database
    return back()->with('error','Email already exist!');
} else {

    if(empty($request->email)){

        DB::table('users')->where('id', $user_id)->update(array('first_name' => $request->first_name,'last_name' => $request->last_name));
            
    }elseif(empty($request->first_name) && empty($request->last_name)){

        DB::table('users')->where('id', $user_id)->update(array('email' => $request->email));

    }else{
        DB::table('users')->where('id', $user_id)->update(array('first_name' => $request->first_name,'last_name' => $request->last_name,'email' => $request->email));
    }

  
        $data = array(
            'user_id' => auth()->user()->id,
            'user_type' => 'Any Staff',
            'activity_type' => 'Update Account',
            'ip_address' => $request->ip(),
            'device_info' => $request->header('User-Agent'),
            'details' => 'Table Record ID'.' '.$user_id,
            'status' => 'success',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         );
          
         DB::table('activitylogs')->insert($data);
    }


  
    return back()->with('success', 'Account successfully change');
}


}
    
