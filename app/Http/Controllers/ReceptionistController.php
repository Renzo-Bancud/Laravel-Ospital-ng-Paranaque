<?php

namespace App\Http\Controllers;

use App\Department;
use App\Receptionist;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ReceptionistController extends Controller
{
    public function index()
    {   
        $token = uniqid('', true); // generate a more unique ID
        $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
        $token .= time(); // add the current timestamp
        session()->put('form_token', $token); // store the token in the session

        return view('users.receptionists.list',['token' => $token])->with('malasakits', User::receptionist()->get());
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

    $malasakit = User::create([
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
        'type' => 8,
    ]);

    $lastInsertId = $malasakit->id;

    if($malasakit){
        $data = array(
            'user_id' => auth()->user()->id,
            'user_type' => 'Admin Staff',
            'activity_type' => 'Create Malasakit Account',
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
    return redirect(route('receptionists.index'));

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
        return redirect(route('receptionists.index'));
    }



    public function destroystaff(Request $request)
    {
        $id = $request->staff_id;
        $destroystaff = DB::table('users')->where('id',$id)->where('type',8)->delete();


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
        $deactivate = DB::table('users')->where('id',$id)->where('type',8)->update(array('isActivated' => 0));

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
        $activate = DB::table('users')->where('id',$id)->where('type',8)->update(array('isActivated' => 1));

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

    public function malasakit_template(){
        return view('users.receptionists.malasakit-template');
    }

    // public function malasakit_form($patient_id)
    // {
    //     $patient = User::patient()->find($patient_id);
    //     return view('users.receptionists.malasakitform')->with('patient', $patient);
    // }


    public function generateIdentification(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'pid' => 'required',
            'dep' => 'required',
            'ppid' => 'required',
            'printed' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Sanitize user input
        $uniqueNumber = str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        $identification_no = date('dh').''.$uniqueNumber;
        $pid = strip_tags($request->input('pid'));
        $dep_id = strip_tags($request->input('dep'));
        $ppid = strip_tags($request->input('ppid'));
        $printed = strip_tags($request->input('printed'));

        if ($printed == 0) {
            session()->flash('error-printing', 'Please print the malasakit form of patient.');
            return redirect()->route('get-malasakitform', ['patient_id' => $ppid]);
        } else {
            $generate = Patient_identification_card::create([
                'identification_number' => $identification_no,
                'patient_id' => $pid,
                'department_id' => $dep_id,
                'procedure_id' => $ppid,
                'isPrinted' => $printed,
            ]);

            if ($generate) {
                DB::table('test_charge_tickets')->where('procedure_id', $ppid)->update(array('ticket_status' => 1));
            }

            $lastGenId = $generate->id;

            // flash message
            // session()->flash('success-generated', 'Identification ID Generated.');
            return back()
                ->with('gen_no', $identification_no)
                ->with('lastgen', $lastGenId);
        }
    } // TO DELETE

    public function patient_identification($pid){
        
        $patient = DB::table('patients')
        ->where('id',$pid)
        ->first();

        return view('users.receptionists.print_hospital_no',['pid' => $pid])
        ->with('patient', $patient);

    }


    public function editPatient(Request $request) {
        $validator = Validator::make($request->all(), [
            'pid' => ['required'],
            'scanfile' => ['required'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'string', 'max:50'],
            'gender' => ['required'],
            'fund_type' => ['required'],
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Sanitize user input
        $pid = strip_tags($request->input('pid'));
        $fname = strip_tags($request->input('firstname'));
        $lname = strip_tags($request->input('lastname'));
        $address = strip_tags($request->input('address'));
        $birthday = strip_tags($request->input('birthday'));
        $age = strip_tags($request->input('age'));
    
        if($request->hasFile('scanfile')) {
            $request_path = public_path('upload') . '/' . $request->scanfile;
            if (file_exists($request_path)) {
                File::delete($request_path);
            }
    
            $scanid = $request->file('scanfile');
    
            $filename = $scanid->getClientOriginalName();
            $scanid->move(public_path('upload'), $filename);
        } else {
            $filename = null;
        }


        $folderPath = public_path('upload/');
        $image = explode(";base64,", $request->signed);
        $image_type = explode("upload/", $image[0] ?? '');
        $image_type_png = isset($image_type[1]) ? $image_type[1] : null;
        $image_base64 = base64_decode($image[1] ?? '');
        
        // Extract the file name from the base64-encoded image data
        preg_match('/^data:image\/(?:png|jpeg|gif);base64,(.*)$/', $request->signed, $match);
        $image_name = isset($match[1]) ? uniqid() . '.' . $image_type_png : '';
        
        $file = $folderPath . $image_name;
        file_put_contents($file, $image_base64);

    
            $patient = Patient::find($pid);
            if ($patient) {
                $patient->upload_id = $filename;
                $patient->firstname = $fname;
                $patient->lastname = $lname;
                $patient->address = $address;
                $patient->bday = $birthday;
                $patient->gender = $request->gender;
                $patient->age = $age;
                $patient->fund_type = $request->fund_type;
                $patient->patient_signature =  $image_name;
                $patient->save();

                if($patient->save()){
                  
                        $data = array(
                            'user_id' => auth()->user()->id,
                            'user_type' => 'Malasakit Staff',
                            'activity_type' => 'Edit Patient',
                            'ip_address' => $request->ip(),
                            'device_info' => $request->header('User-Agent'),
                            'details' => 'Table Record ID'.' '.$pid,
                            'status' => 'success',
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                         );
                          
                         DB::table('activitylogs')->insert($data);
    
                }
    
                return back()->with('success', 'Patient record updated successfully');
            }
       
    }
    
    
    public function print_malasakit($ticket, $pid){
        $patient = DB::table('patients')->where('id',$pid)->where('patient_ticket',$ticket)->first();
        return view('users.receptionists.print-patient-malasakitform',['ticket' => $ticket])->with('patient', $patient);

    }

    public function getApprovePatient(){
        $patients = DB::table('patients')
        ->join('test_charge_tickets', 'patients.patient_ticket', '=', 'test_charge_tickets.ticket_number')
        ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
        ->select('patients.*','test_charge_tickets.*','departments.*','patients.id as pid','patients.created_at as date_request')
        ->where('patients.request_status',3)
        ->groupBy('test_charge_tickets.ticket_number')
        ->get();
        return view('users.receptionists.malasakit_patients_approve_list')->with('patients', $patients);
    }


    public function getCompletePatient(){
        $patients = DB::table('patients')
        ->join('test_charge_tickets', 'patients.patient_ticket', '=', 'test_charge_tickets.ticket_number')
        ->join('departments', 'test_charge_tickets.dept_id', '=', 'departments.dep_id')
        ->select('patients.*','test_charge_tickets.*','departments.*','patients.id as pid','patients.created_at as date_request')
        ->where('patients.request_status',4)
        ->groupBy('test_charge_tickets.ticket_number')
        ->get();
        return view('users.receptionists.malasakit_patients_complete_list')->with('patients', $patients);
    }

    public function approve_patientrequest(Request $request){
    
        $validator = Validator::make($request->all(), [
            'pid' => ['required'],
            'ticket' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

          // Sanitize user input
          $pid = strip_tags($request->input('pid'));
          $ticket = strip_tags($request->input('ticket'));

          //Requsest Sent it will update on malasakit side
          $charge_ticket = DB::table('test_charge_tickets')->where('ticket_number',$ticket)->update(array('ticket_status' => 1 ));

          if($charge_ticket){
            DB::table('patients')->where('id',$pid)->update(array('request_status' => 3 ));
          }else{
            return back()->with('error','There is problem updating status');
          }

          session()->flash('success', 'For approval request send');
          return back();
    }

    
}