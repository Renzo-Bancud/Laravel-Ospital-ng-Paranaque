<?php

namespace App\Http\Controllers;

use App\Department;
use App\Doctor;
use App\Http\Requests\Doctor\CreateDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\TimeSchedule;
use App\User;
use App\Patient;
use App\Medicine;
use App\Activitylog;
use App\Test_charge_ticket;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
    //User::doctor() ito ay scope sa user model na kung saan connect nia yung ibang model  
    public function index()
    {    
        $token = uniqid('', true); // generate a more unique ID
        $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
        $token .= time(); // add the current timestamp
        session()->put('form_token', $token); // store the token in the session

        $count_doctor = User::where('type', 2)->count();
        return view('users.doctors.index',['token' => $token])->with('doctors', User::doctor()->get())
            ->with('count_doctor', $count_doctor)
            ->with('departments', Department::all());
    }


    public function getTimeScheduleByDoctor(Request $request)
    {

        if (!$request->id) {
            $html = '<li class="tm"  value="">No Time Schedule For This Doctor</li>';
        } else {
            $html = '';
            $doctor = User::find($request->id);
            $timeSchedules = $doctor->timeSchedules;
            foreach ($timeSchedules as $timeSchedule) {
                $html .= '<li class="tm list-group-item" value="' . $timeSchedule->id . '"><span class="icon icon-clock-o icon-lg icon-fw">' . $timeSchedule->week_day . '</li>';
            }
        }
        return response()->json(['html' => $html]);
    }

    public function getDayoffScheduleByDoctor(Request $request)
    {

        if (!$request->id) {
            $html = '<li class="tm"  value="">No Day Off Schedule For This Doctor</li>';
        } else {
            $doctor = User::find($request->id);
            $dayoffSchedules = $doctor->dayoffSchedules;
            $TS = collect();
            foreach ($dayoffSchedules as $dayoffSchedule) {
                $TS->push($dayoffSchedule);
            }
            $json = $TS->toJson();
        }
        return response()->json(['html' => $json]);
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
    ]);

    if ($validator->fails()) {
        // return to the previous page with validation error messages
        return back()->withErrors($validator)->withInput();
    }

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

    $doctor = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'picture' => $filename,
        'employee_id' => $request->employee_id,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'birth_date' => $request->birth_date,
        'age' => $request->age,
        'gender' => $request->gender,
        'mobile' => $request->mobile,
        'type' => 2,
        'dept_id' => $request->departments,
    ]);
    $lastInsertId = $doctor->id; 

    if($doctor){
        $data = array(
            'user_id' => auth()->user()->id,
            'user_type' => 'Admin Staff',
            'activity_type' => 'Create Department Account',
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
    return redirect(route('doctors.index'));
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
                'type' => 2,
                'dept_id' => $request->departments,
            ]);



            $updatestaff = DB::table('users')->where('id',$request->staff_id)->update($data);


            if($updatestaff){
                $data = array(
                    'user_id' => auth()->user()->id,
                    'user_type' => 'Admin Staff',
                    'activity_type' => 'Update Department Account',
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
                        'type' => 2,
                        'dept_id' => $request->departments,
                    ]);
    
                    $updatestaff = DB::table('users')->where('id',$request->staff_id)->update($data);


                        if($updatestaff){
                            $data = array(
                                'user_id' => auth()->user()->id,
                                'user_type' => 'Admin Staff',
                                'activity_type' => 'Update Department Account',
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
                    'type' => 2,
                    'dept_id' => $request->departments,
                ]);

                $updatestaff = DB::table('users')->where('id',$request->staff_id)->update($data);


                    if($updatestaff){
                        $data = array(
                            'user_id' => auth()->user()->id,
                            'user_type' => 'Admin Staff',
                            'activity_type' => 'Update Department Account',
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
        return redirect(route('doctors.index'));
    }

    public function destroystaff(Request $request)
    {
        $id = $request->staff_id;
        $destroystaff = DB::table('users')->where('id',$id)->where('type',2)->delete();


        if($destroystaff){
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Delete Department Account',
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
        $deactivate = DB::table('users')->where('id',$id)->where('type',2)->update(array('isActivated' => 0));

        if($deactivate){
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Deactivate Department Account',
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
        $activate = DB::table('users')->where('id',$id)->where('type',2)->update(array('isActivated' => 1));

        if($activate){
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Activate Department Account',
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


    // public function generateTicket(Request $request)
    // {
       
    //    if(Auth::user()->type == 2 && Auth::user()->dept_id == 3){
       
    //     $validator = Validator::make($request->all(), [
    //         'test' => 'required',
    //         'type' => 'required',
    //         'amount' => 'required',
    //     ]);
        
    //    }
       
    //     $validator = Validator::make($request->all(), [
    //         'test' => 'required',
    //         'amount' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     $token = $request->input('token');
    //     $storedToken = session('form_token');

    //     if ($token !== $storedToken) {
    //      return redirect()->back()->with('error','Double form submission detected.');
    //     }

 
    //     // Sanitize user input
    //     $uniqueNumber = str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
    //     $ticket_no = date('dhis') . '' . $uniqueNumber;
    //     $did = strip_tags($request->input('did'));
  

    //     $data = [];
        
    //     if(Auth::user()->type == 2 && Auth::user()->dept_id == 3){
        
    //        for ($i = 0; $i < count($request->test); $i++) {
    //         $data[] = [
    //             'ticket_number' => $ticket_no,
    //             'dept_id' => $did,
    //             'test' => $request->test[$i],
    //             'radiology_type' => $request->type[$i],
    //             'amount' => $request->amount[$i],
    //             'created_at' => Carbon::now(),
    //             'updated_at' => Carbon::now(),
    //         ];
    //        }
        
    //     }else{
        
    //       for ($i = 0; $i < count($request->test); $i++) {
    //         $data[] = [
    //             'ticket_number' => $ticket_no,
    //             'dept_id' => $did,
    //             'test' => $request->test[$i],
    //             'amount' => $request->amount[$i],
    //             'created_at' => Carbon::now(),
    //             'updated_at' => Carbon::now(),
    //         ];
    //        }
        
    //     }
        
    //     $store_ticket = DB::table('test_charge_tickets')->insert($data);
    //     $lastInsertId = DB::table('test_charge_tickets')->insertGetId($data);


    //     if($store_ticket){
    //         $data_logs = array(
    //             'user_id' => auth()->user()->id,
    //             'user_type' => 'Department Staff',
    //             'activity_type' => 'Create Charge Ticket',
    //             'ip_address' => $request->ip(),
    //             'device_info' => $request->header('User-Agent'),
    //             'details' => 'Table Record ID'.' '.$lastInsertId ,
    //             'status' => 'success',
    //             'created_at' => Carbon::now(),
    //             'updated_at' => Carbon::now(),
    //          );
              
    //          DB::table('activitylogs')->insert($data_logs);
    //     }

    //     session()->forget('form_token');

    //     // flash message
    //     session()->flash('success', 'Charge Ticket Created.');
    //     return back();
    // }


    public function generateTicket(Request $request)
    {

        // Validate user input
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'birthday' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'item' => 'required',
            'qty' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $token = $request->input('token');
        $storedToken = session('form_token');

        if ($token !== $storedToken) {
         return redirect()->back()->with('error','Double form submission detected.');
        }

        // Sanitize user input
        $fname = strip_tags($request->input('firstname'));
        $lastname = strip_tags($request->input('lastname'));
        $birthday = strip_tags($request->input('birthday'));
        $age = strip_tags($request->input('age'));
        $uniqueNumber = str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        $ticket_no = date('dhis') . '' . $uniqueNumber;
        $did = strip_tags($request->input('did'));

        if($request->hasFile('scanfile')) {
            $request_path = public_path('upload') . '/' . $request->scanfile;
            if (file_exists($request_path)) {
                File::delete($request_path);
            }
    
            $scandoc = $request->file('scanfile');
    
            $filename = $scandoc->getClientOriginalName();
            $scandoc->move(public_path('upload'), $filename);
        } else {
            $filename = null;
        }

        if(Auth::user()->type == 2 && Auth::user()->dept_id == 1){
            $utype = "Laboratory Department";
        }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 2){
            $utype = "Pharmacy Department";
        }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 3){
            $utype = "Radiology Department";
        }else{
            $utype = "Dialysis Department";
        }

        $data = [];

        if(Auth::user()->type == 2 && Auth::user()->dept_id == 1){

            $labID = $request->item;
            $check_laboratories = DB::table('laboratory_deliveries')->join('laboratories','laboratory_deliveries.lab_id','=','laboratories.id')
            ->whereIn('laboratory_deliveries.lab_id', $labID)->get();
            foreach ($check_laboratories as $laboratory) {
                // Check if the quantity of the medicine is less than or equal to 0 or 10
                if ($laboratory->qty <= 0) {
                    // return to the previous page with error message
                    return redirect()->back()->with('error', 'The item ' . $laboratory->test . ' item is out of stock. Please restock.');
                // }else{
                //     if($request->qty > $laboratory->qty){
                //         return redirect()->back()->with('error', 'You have only ' . $laboratory->qty . ' stock left.');
                //     }
                }
            }
    
        }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 2){
        
        $medID = $request->item;
        $check_medicines = DB::table('medicines')->join('pharmacies','medicines.pharma_id','=','pharmacies.id')
        ->whereIn('medicines.pharma_id', $medID)->get();
        foreach ($check_medicines as $medicine) {
            // Check if the quantity of the medicine is less than or equal to 0 or 10
            if ($medicine->quantity <= 0) {
                // return to the previous page with error message
                return redirect()->back()->with('error', 'The item ' . $medicine->medicine . ' is out of stock. Please restock.');
            // }else{
            //     if($request->qty > $medicine->quantity){
            //         return redirect()->back()->with('error', 'You have only ' . $medicine->quantity . ' stock left.');
            //     }

            }
        }

        }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 3){
        
            $radioID = $request->item;
            $check_radiologies = DB::table('radiology_deliveries')->join('radiologies','radiology_deliveries.radiology_id','=','radiologies.id')
            ->whereIn('radiology_deliveries.radiology_id', $radioID)->get();
            foreach ($check_radiologies  as $radiology) {
                // Check if the quantity of the medicine is less than or equal to 0 or 10
                if ($radiology->qty <= 0) {
                    // return to the previous page with error message
                    return redirect()->back()->with('error', 'The item ' . $radiology->test . ' is out of stock. Please restock.');
                // }else{
                //     if($request->qty > $radiology->qty){
                //         return redirect()->back()->with('error', 'You have only ' . $radiology->qty . ' stock left.');
                //     }
    
                }
            }
    
        }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 4){
        
            $dialysisID = $request->item;
            $check_dialysis = DB::table('hemodialysis_deliveries')->join('hemodialysis','hemodialysis_deliveries.dialysis_id','=','hemodialysis.id')
            ->whereIn('hemodialysis_deliveries.dialysis_id', $dialysisID)->get();
            foreach ($check_dialysis  as $dialysis) {
                // Check if the quantity of the medicine is less than or equal to 0 or 10
                if ($dialysis->qty <= 0) {
                    // return to the previous page with error message
                    return redirect()->back()->with('error', 'The item ' . $dialysis->test . ' is out of stock. Please restock.');
                }
            }
    
        }else{
            return back()->with('error','Youre not allowed to create charge ticket.');
        }

        // Prepare data for insert
        for ($i = 0; $i < count($request->item); $i++) {
        
        if(Auth::user()->type == 2 && Auth::user()->dept_id == 2){
         //Decrement the quantity of the laboratory
        $med_id = $request->item[$i];
        $qty_purchase = intval($request->qty[$i]);
        $update_medicines = DB::table('medicines')->where('pharma_id', $med_id)->update(['quantity' => DB::raw("quantity - $qty_purchase")]);
        }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 1){
            
        //Decrement the quantity of the medicine
        $lab_id = $request->item[$i];
        $qty_purchase = intval($request->qty[$i]);
        $update_lab = DB::table('laboratory_deliveries')->where('lab_id', $lab_id)->update(['qty' => DB::raw("qty - $qty_purchase")]);
        } elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 3){
            //Decrement the quantity of the radiology
            $radio_id = $request->item[$i];
            $qty_purchase = intval($request->qty[$i]);
            $update_radio = DB::table('radiology_deliveries')->where('radiology_id', $radio_id)->update(['qty' => DB::raw("qty - $qty_purchase")]);
        } elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 4){
            //Decrement the quantity of the radiology
            $dialysis_id = $request->item[$i];
            $qty_purchase = intval($request->qty[$i]);
            $update_dialysis = DB::table('hemodialysis_deliveries')->where('dialysis_id', $dialysis_id)->update(['qty' => DB::raw("qty - $qty_purchase")]);
        }else{
            return back()->with('error','Youre not allowed to create charge ticket.');
        }
    
            $data[] = [
                'ticket_number' => $ticket_no,
                'dept_id' => $did,
                'item_id' => $request->item[$i],
                'qty' => $request->qty[$i],
                'amount' => $request->amount[$i],
                'date_created' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Store the ticket information
        $store_ticket = DB::table('test_charge_tickets')->insert($data);
       
        if($store_ticket){
        
        $patient = Patient::create([
            'upload_request' => $filename,
            'firstname' => $fname,
            'lastname' => $lastname,
            'bday' => $birthday,
            'age' => $age,
            'gender' => $request->gender,
            'patient_ticket' => $ticket_no,
        ]);

        $lastInsertId = $patient->id; 


        if($patient){
            $data_patient_logs = array(
                'user_id' => auth()->user()->id,
                'user_type' => $utype,
                'activity_type' => 'Create Charge Ticket',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$lastInsertId,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data_patient_logs);

        }else{
            return back()->with('error','There is problem inserting data');
        }

        
            $data_logs = array(
               'user_id' => auth()->user()->id,
               'user_type' => $utype,
               'activity_type' => 'Create Charge Ticket',
               'ip_address' => $request->ip(),
               'device_info' => $request->header('User-Agent'),
               'details' => 'Multiple insert ticket #'.$ticket_no,
               'status' => 'success',
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
            );
             
            DB::table('activitylogs')->insert($data_logs);
        }

        session()->forget('form_token');

    
        // Set success flash message
        session()->flash('success', 'Ticket Created.');

        // Redirect to the desired page
        return back();
    }

    public function getToprintTicket($ticket_number)
    {
    
            if(Auth::user()->type == 2 && Auth::user()->dept_id == 1){
                $print_tickets = DB::table('test_charge_tickets')
                ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
                ->join('laboratories','test_charge_tickets.item_id','=','laboratories.id')
                ->join('laboratory_categories','laboratories.category_id','=','laboratory_categories.id')
                ->where('test_charge_tickets.dept_id', Auth::user()->dept_id)
                ->where('test_charge_tickets.ticket_number', $ticket_number)
                ->get();
            }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 2){
                $print_tickets = DB::table('test_charge_tickets')
                ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
                ->join('pharmacies','test_charge_tickets.item_id','=','pharmacies.id')
                ->join('pharmacy_categories','pharmacies.category_id','=','pharmacy_categories.id')
                ->where('test_charge_tickets.dept_id', Auth::user()->dept_id)
                ->where('test_charge_tickets.ticket_number', $ticket_number)
                ->get();
            }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 3){
                $print_tickets = DB::table('test_charge_tickets')
                ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
                ->join('radiologies','test_charge_tickets.item_id','=','radiologies.id')
                ->join('radiology_categories','radiologies.category_id','=','radiology_categories.id')
                ->where('test_charge_tickets.dept_id', Auth::user()->dept_id)
                ->where('test_charge_tickets.ticket_number', $ticket_number)
                ->get();
            }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 4){
                $print_tickets = DB::table('test_charge_tickets')
                ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
                ->join('hemodialysis','test_charge_tickets.item_id','=','hemodialysis.id')
                ->join('hemodialysis_categories','hemodialysis.category_id','=','hemodialysis_categories.id')
                ->where('test_charge_tickets.dept_id', Auth::user()->dept_id)
                ->where('test_charge_tickets.ticket_number', $ticket_number)
                ->get();
            }else{
               return back()->with('error','Your department is missing!');
            }
        


        $print_dept = DB::table('test_charge_tickets')
            ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
            ->where('test_charge_tickets.dept_id', Auth::user()->dept_id)
            ->where('test_charge_tickets.ticket_number', $ticket_number)
            ->first();


        return view('users.doctors.print_ticket', compact('print_dept'))->with('print_tickets', $print_tickets);

    }

    public function getApproveRequest(){

     
        $patients = DB::table('patients')
        ->join('test_charge_tickets', 'patients.patient_ticket', '=', 'test_charge_tickets.ticket_number')
        ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
        ->select('patients.*','test_charge_tickets.*','departments.*','patients.id as pid','patients.created_at as date_request')
        ->where('patients.request_status',3)
        ->where('test_charge_tickets.dept_id', Auth::user()->dept_id)
        ->groupBy('test_charge_tickets.ticket_number')
        ->get();


        return view('users.doctors.approve_request')
        ->with('patients', $patients);
    }

    public function CompletePatientRequest(Request $request)
    {
        $id = $request->pid;
        $tnid = $request->tid;
        $complete = DB::table('patients')->where('id', $id)->update(array('request_status' => 4));

        if($complete){
           DB::table('test_charge_tickets')->where('ticket_number', $tnid)->update(array('ticket_status' => 2));
        }
        
        if(Auth::user()->type == 2 && Auth::user()->dept_id == 1){
            $utype = "Laboratory Department";
        }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 2){
            $utype = "Pharmacy Department";
        }elseif(Auth::user()->type == 2 && Auth::user()->dept_id == 3){
            $utype = "Radiology Department";
        }else{
            $utype = "Dialysis Department";
        }

        if($complete){
            $data = array(
               'user_id' => auth()->user()->id,
               'user_type' => $utype,
               'activity_type' => 'Complete Patient Request',
               'ip_address' => $request->ip(),
               'device_info' => $request->header('User-Agent'),
               'details' => 'Table Record ID'.' '.$tnid,
               'status' => 'success',
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
            );
             
            DB::table('activitylogs')->insert($data);
        }
          
        // flash message
        session()->flash('success', 'Patient Request Complete.');
        return back();
    }


    public function getCompleteRequest(){

     
        $patients = DB::table('patients')
        ->join('test_charge_tickets', 'patients.patient_ticket', '=', 'test_charge_tickets.ticket_number')
        ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
        ->select('patients.*','test_charge_tickets.*','departments.*','patients.id as pid','patients.created_at as date_request')
        ->where('patients.request_status',4)
        ->where('test_charge_tickets.dept_id', Auth::user()->dept_id)
        ->groupBy('test_charge_tickets.ticket_number')
        ->get();

        return view('users.doctors.complete_request')
        ->with('patients', $patients);
    }



}