<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Accountant;
use App\Department;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Activitylog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class AccountantController extends Controller
{
    public function index()
    {    
        $token = uniqid('', true); // generate a more unique ID
        $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
        $token .= time(); // add the current timestamp
        session()->put('form_token', $token); // store the token in the session

        return view('users.accountants.list',['token' => $token])->with('accountants', User::accountant()->get());
    }

    public function store(Request $request)
    {

        // Validate user input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_id' => 'required',
            'birth_date' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    

    if ($validator->fails()) {
        // return to the previous page with validation error messages
        return back()->withErrors($validator)->withInput();
    }


    $token = $request->input('token');
    $storedToken = session('form_token');

    if ($token !== $storedToken) {
     return redirect()->back()->with('error','Double form submission detected.');
    }

    if ($request->hasFile('picture')) {
        $image_path = public_path('upload') . '/' . $request->picture;
        if (file_exists($image_path)) {
            File::delete($image_path);
        }

        $picture = $request->file('picture');

        $filename = $picture->getClientOriginalName();
        $picture->move(public_path('upload'), $filename);
    } else {
        $filename = null;
    }
     
    $sanitizedData = $request->only([
        'first_name',
        'last_name',
        'employee_id',
        'birth_date',
        'age',
        'gender',
        'mobile',
        'email',
        'password',
    ]);

    
    $malasakit = DB::insert('INSERT INTO users (first_name, last_name, picture, employee_id, email, password, birth_date, age, gender, mobile, type) 
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
    $sanitizedData['first_name'],
    $sanitizedData['last_name'],
    $filename,
    $sanitizedData['employee_id'],
    $sanitizedData['email'],
    Hash::make($sanitizedData['password']),
    $sanitizedData['birth_date'],
    $sanitizedData['age'],
    $sanitizedData['gender'],
    $sanitizedData['mobile'],
    5, ]);

    $lastInsertId = DB::getPdo()->lastInsertId();

    if($malasakit){
        $data = array(
            'user_id' => auth()->user()->id,
            'user_type' => 'Admin Staff',
            'activity_type' => 'Create PPP Account',
            'ip_address' => $request->ip(),
            'device_info' => $request->header('User-Agent'),
            'details' => 'Table Record ID'.' '.$lastInsertId,
            'status' => 'success',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
         );
          
         DB::table('activitylogs')->insert($data);
    }

    session()->forget('form_token');

    // flash message
    session()->flash('success', 'Account Added.');
   
    // redirect user
    return redirect(route('accountants.index'));

    }

    public function updatestaff(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'employee_id' => 'required',
            'birth_date' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
            // return to the previous page with validation error messages
            return back()->withErrors($validator)->withInput();
        }

    
        $token = $request->input('token');
        $storedToken = session('form_token');

        if ($token !== $storedToken) {
         return redirect()->back()->with('error','Double form submission detected.');
        }
        
        $get_user = DB::table('users')->where('id',$request->staff_id)->first();

        $image_path = public_path('upload') . '/' . $request->picture;
        if (file_exists($image_path)) {
        File::delete($image_path);
        }

        $picture = $request->file('picture');
       

        if(empty($request->picture)){
            $data = ([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'picture' =>  $get_user->picture,
                'employee_id' => $request->employee_id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'birth_date' => $request->birth_date,
                'age' => $request->age,
                'gender' => $request->gender,
                'mobile' => $request->mobile,
            
            ]);



            $updatestaff = DB::table('users')->where('id',$request->staff_id)->update($data);


            if($updatestaff){
                $data = array(
                    'user_id' => auth()->user()->id,
                    'user_type' => 'Admin Staff',
                    'activity_type' => 'Update Malasakit Account',
                    'ip_address' => $request->ip(),
                    'device_info' => $request->header('User-Agent'),
                    'details' => 'Table Record ID'.' '.$request->staff_id,
                    'status' => 'success',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                 );
                  
                 DB::table('activitylogs')->insert($data);
            }


             // flash message
             session()->flash('success', 'Account Updated.');

        }else{

            if($get_user->email === $request->email ){

                if ($picture) {
                    $filename = $picture->getClientOriginalName();
                    $picture->move(public_path('upload'), $filename);
        
                    $data = ([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'picture' => $filename,
                        'employee_id' => $request->employee_id,
                        'email' => $get_user->email,
                        'password' => Hash::make($request->password),
                        'birth_date' => $request->birth_date,
                        'age' => $request->age,
                        'gender' => $request->gender,
                        'mobile' => $request->mobile,
                      

                    ]);
    
                    $updatestaff = DB::table('users')->where('id',$request->staff_id)->update($data);


                        if($updatestaff){
                            $data = array(
                                'user_id' => auth()->user()->id,
                                'user_type' => 'Admin Staff',
                                'activity_type' => 'Update Malasakit Account',
                                'ip_address' => $request->ip(),
                                'device_info' => $request->header('User-Agent'),
                                'details' => 'Table Record ID'.' '.$request->staff_id,
                                'status' => 'success',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            );
                            
                            DB::table('activitylogs')->insert($data);
                        }
    
                    // flash message
                    session()->flash('success', 'Account Updated.');
                } else {
                    session()->flash('error', 'There is problem uploading your file.');
                }
    

            }else{

            $validate_account = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/',
            ], [
                'password.regex' => 'Password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, and one number',
                'email.unique' => 'Email address is already in use.',
            ]);
            
            if ($validate_account->fails()) {
                return back()->with('error', $validate_account->errors()->first());
            }

            
            if ($picture) {
                $filename = $picture->getClientOriginalName();
                $picture->move(public_path('upload'), $filename);
    
                $data = ([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'picture' => $filename,
                    'employee_id' => $request->employee_id,
                    'email' => $get_user->email,
                    'password' => Hash::make($request->password),
                    'birth_date' => $request->birth_date,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'mobile' => $request->mobile,
                ]);

                $updatestaff = DB::table('users')->where('id',$request->staff_id)->update($data);


                    if($updatestaff){
                        $data = array(
                            'user_id' => auth()->user()->id,
                            'user_type' => 'Admin Staff',
                            'activity_type' => 'Update Malasakit Account',
                            'ip_address' => $request->ip(),
                            'device_info' => $request->header('User-Agent'),
                            'details' => 'Table Record ID'.' '.$request->staff_id,
                            'status' => 'success',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        );
                        
                        DB::table('activitylogs')->insert($data);
                    }

                // flash message
                session()->flash('success', 'Account Updated.');
            } else {
                session()->flash('error', 'There is problem uploading your file.');
            }


            }
        }
        session()->forget('form_token');
                
        // redirect user
        return redirect(route('accountants.index'));
    }



    public function destroystaff(Request $request)
    {
        $id = $request->staff_id;
        $destroystaff = DB::table('users')->where('id',$id)->where('type',5)->delete();


        if($destroystaff){
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Delete Malasakit Account',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }



        // flash message
        session()->flash('success', 'Account Deleted.');
        // redirect user
        return back();
    }


    public function deactivatestaff(Request $request)
    {
        $id = $request->staff_id;
        $deactivate = DB::table('users')->where('id',$id)->where('type',5)->update(array('isActivated' => 0));

        if($deactivate){
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Deactivate Malasakit Account',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }


        // flash message
        session()->flash('success', 'Account Deactivated.');
        // redirect user
        return back();
    }



    public function activatestaff(Request $request)
    {
        $id = $request->staff_id;
        $activate = DB::table('users')->where('id',$id)->where('type',5)->update(array('isActivated' => 1));

        if($activate){
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Activate Malasakit Account',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }

        // flash message
        session()->flash('success', 'Account Activated.');
        // redirect user
        return back();
    }


    //USER SIDE 

    public function getChargeTickets()
    {
        $patients = DB::table('patients')
        ->join('test_charge_tickets', 'patients.patient_ticket', '=', 'test_charge_tickets.ticket_number')
        ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
        ->select('patients.*','test_charge_tickets.*','departments.*','patients.id as pid','patients.created_at as date_request')
        ->groupBy('test_charge_tickets.ticket_number')
        ->get();

        
        return view('users.accountants.generated_ticket')->with('patients',  $patients);
    }

    public function getChargeTicketAmount($id, $ticket_number)
    {

        $ticket = DB::table('test_charge_tickets')->where('ticket_number',$ticket_number)->first();
        if($ticket->dept_id == 1){
            $print_tickets = DB::table('test_charge_tickets')
            ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
            ->join('laboratories','test_charge_tickets.item_id','=','laboratories.id')
            ->join('laboratory_categories','laboratories.category_id','=','laboratory_categories.id')
            ->where('test_charge_tickets.dept_id', $ticket->dept_id)
            ->where('test_charge_tickets.ticket_number', $ticket_number)
            ->get();
        }elseif($ticket->dept_id == 2){
            $print_tickets = DB::table('test_charge_tickets')
            ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
            ->join('pharmacies','test_charge_tickets.item_id','=','pharmacies.id')
            ->join('pharmacy_categories','pharmacies.category_id','=','pharmacy_categories.id')
            ->where('test_charge_tickets.dept_id', $ticket->dept_id)
            ->where('test_charge_tickets.ticket_number', $ticket_number)
            ->get();
        }elseif($ticket->dept_id == 3){
            $print_tickets = DB::table('test_charge_tickets')
            ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
            ->join('radiologies','test_charge_tickets.item_id','=','radiologies.id')
            ->join('radiology_categories','radiologies.category_id','=','radiology_categories.id')
            ->where('test_charge_tickets.dept_id', $ticket->dept_id)
            ->where('test_charge_tickets.ticket_number', $ticket_number)
            ->get();
        }elseif($ticket->dept_id == 4){
            $print_tickets = DB::table('test_charge_tickets')
            ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
            ->join('hemodialysis','test_charge_tickets.item_id','=','hemodialysis.id')
            ->join('hemodialysis_categories','hemodialysis.category_id','=','hemodialysis_categories.id')
            ->where('test_charge_tickets.dept_id', $ticket->dept_id)
            ->where('test_charge_tickets.ticket_number', $ticket_number)
            ->get();
        }else{
           return back()->with('error','Your department is missing!');
        }



        $print_dept = DB::table('test_charge_tickets')
            ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
            ->where('test_charge_tickets.ticket_number', $ticket_number)
            ->first();



        return view('users.accountants.charge_amount', compact('print_dept'))->with('print_tickets', $print_tickets)
        ->with('ticket', $ticket);

    }


    public function getCompleteProcedure(Request $request){
        $patients = DB::table('patients')
        ->join('test_charge_tickets', 'patients.patient_ticket', '=', 'test_charge_tickets.ticket_number')
        ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
        ->select('patients.*','test_charge_tickets.*','departments.*','patients.id as pid','patients.created_at as date_request')
        ->where('patients.request_status',4)
        ->groupBy('test_charge_tickets.ticket_number')
        ->orderBy('patients.id','DESC')
        ->get();
         
        if (!empty($patients)) {
            
            $patient_tickets = collect($patients)->pluck('patient_ticket'); // collect its like get also but this this one use pluck to get  object to array
            
            $charge_requests = DB::table('test_charge_tickets')
            ->whereIn('ticket_number', $patient_tickets)
            ->where('dept_id', 3)
            ->get();
            $lab_requests = DB::table('test_charge_tickets')->whereIn('ticket_number',$patient_tickets)->where('dept_id', 1)->get();
            $dialysis_requests = DB::table('test_charge_tickets')->whereIn('ticket_number',$patient_tickets)->where('dept_id', 4)->get();

            $charge_request_meds = []; // initialized array
            foreach($patients as $pt){
                $meds = DB::table('test_charge_tickets')
                ->join('pharmacies','test_charge_tickets.item_id','=','pharmacies.id')
                ->where('test_charge_tickets.ticket_number',$pt->patient_ticket)
                ->where('test_charge_tickets.dept_id',$pt->dep_id)
                ->get()->toArray(); // convert to array because we merge it to array merge
                   
                $charge_request_meds = array_merge($charge_request_meds, $meds);  //so we need to array merge in order to not empty the initialized array     
            }

          
        } else {
            $lab_requests = [];
            $dialysis_requests = [];
            $charge_requests = [];
            $charge_request_meds = []; // return view blade as empty arrray if no data
        }
        
        return view('users.accountants.malasakit_patients_complete_list')->with('patients', $patients)
        ->with('charge_request_meds', $charge_request_meds)
        ->with('charge_requests', $charge_requests)
        ->with('lab_requests', $lab_requests)
        ->with('dialysis_requests', $dialysis_requests);
       
    }

    public function getPPPreports(){

        $pharmacies = DB::table('test_charge_tickets')
        ->join('pharmacies', 'test_charge_tickets.item_id', '=', 'pharmacies.id')
        ->join('pharmacy_categories', 'pharmacies.category_id', '=', 'pharmacy_categories.id')
        ->where('test_charge_tickets.dept_id', 2)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'pharmacies.medicine', 'pharmacy_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();

        $laboratories = DB::table('test_charge_tickets')
        ->join('laboratories', 'test_charge_tickets.item_id', '=', 'laboratories.id')
        ->join('laboratory_categories', 'laboratories.category_id', '=', 'laboratory_categories.id')
        ->where('test_charge_tickets.dept_id', 1)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'laboratories.test', 'laboratory_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();


        $radiologies = DB::table('test_charge_tickets')
        ->join('radiologies', 'test_charge_tickets.item_id', '=', 'radiologies.id')
        ->join('radiology_categories', 'radiologies.category_id', '=', 'radiology_categories.id')
        ->where('test_charge_tickets.dept_id', 3)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'radiologies.test', 'radiology_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();

        $hemodialysis = DB::table('test_charge_tickets')
        ->join('hemodialysis', 'test_charge_tickets.item_id', '=', 'hemodialysis.id')
        ->join('hemodialysis_categories', 'hemodialysis.category_id', '=', 'hemodialysis_categories.id')
        ->where('test_charge_tickets.dept_id', 4)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'hemodialysis.test', 'hemodialysis_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();

        return view('users.accountants.dailyreports')
        ->with('pharmacies',$pharmacies)
        ->with('laboratories',$laboratories)
        ->with('radiologies',$radiologies)
        ->with('hemodialysis',$hemodialysis);

    }

    public function getweeklyPPPreports(){

        $laboratories = DB::table('test_charge_tickets')
        ->join('laboratories', 'test_charge_tickets.item_id', '=', 'laboratories.id')
        ->join('laboratory_categories', 'laboratories.category_id', '=', 'laboratory_categories.id')
        ->where('test_charge_tickets.dept_id', 1)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'laboratories.test', 'laboratory_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();


        $pharmacies = DB::table('test_charge_tickets')
        ->join('pharmacies', 'test_charge_tickets.item_id', '=', 'pharmacies.id')
        ->join('pharmacy_categories', 'pharmacies.category_id', '=', 'pharmacy_categories.id')
        ->where('test_charge_tickets.dept_id', 2)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'pharmacies.medicine', 'pharmacy_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();

        $radiologies = DB::table('test_charge_tickets')
        ->join('radiologies', 'test_charge_tickets.item_id', '=', 'radiologies.id')
        ->join('radiology_categories', 'radiologies.category_id', '=', 'radiology_categories.id')
        ->where('test_charge_tickets.dept_id', 3)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'radiologies.test', 'radiology_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();

        $hemodialysis = DB::table('test_charge_tickets')
        ->join('hemodialysis', 'test_charge_tickets.item_id', '=', 'hemodialysis.id')
        ->join('hemodialysis_categories', 'hemodialysis.category_id', '=', 'hemodialysis_categories.id')
        ->where('test_charge_tickets.dept_id', 4)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'hemodialysis.test', 'hemodialysis_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();



        return view('users.accountants.weeklyreports')
        ->with('pharmacies',$pharmacies)
        ->with('laboratories',$laboratories)
        ->with('radiologies',$radiologies)
        ->with('hemodialysis',$hemodialysis);


    }

    public function getmonthlyPPPreports(){

        $laboratories = DB::table('test_charge_tickets')
        ->join('laboratories', 'test_charge_tickets.item_id', '=', 'laboratories.id')
        ->join('laboratory_categories', 'laboratories.category_id', '=', 'laboratory_categories.id')
        ->where('test_charge_tickets.dept_id', 1)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'laboratories.test', 'laboratory_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();


        $pharmacies = DB::table('test_charge_tickets')
        ->join('pharmacies', 'test_charge_tickets.item_id', '=', 'pharmacies.id')
        ->join('pharmacy_categories', 'pharmacies.category_id', '=', 'pharmacy_categories.id')
        ->where('test_charge_tickets.dept_id', 2)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'pharmacies.medicine', 'pharmacy_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();

        $radiologies = DB::table('test_charge_tickets')
        ->join('radiologies', 'test_charge_tickets.item_id', '=', 'radiologies.id')
        ->join('radiology_categories', 'radiologies.category_id', '=', 'radiology_categories.id')
        ->where('test_charge_tickets.dept_id', 3)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'radiologies.test', 'radiology_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();

        $hemodialysis = DB::table('test_charge_tickets')
        ->join('hemodialysis', 'test_charge_tickets.item_id', '=', 'hemodialysis.id')
        ->join('hemodialysis_categories', 'hemodialysis.category_id', '=', 'hemodialysis_categories.id')
        ->where('test_charge_tickets.dept_id', 4)
        ->where(function ($query) {
            $query->where('test_charge_tickets.ticket_status', 2);
        })
        ->orderBy('test_charge_tickets.created_at', 'ASC')
        ->select('test_charge_tickets.*', 'hemodialysis.test', 'hemodialysis_categories.name', 
         'test_charge_tickets.amount as purchase_amount')
        ->orderBy('test_charge_tickets.date_created')
        ->get();



        return view('users.accountants.monthlyreports')
        ->with('pharmacies',$pharmacies)
        ->with('laboratories',$laboratories)
        ->with('radiologies',$radiologies)
        ->with('hemodialysis',$hemodialysis);


    }

    

    
}
