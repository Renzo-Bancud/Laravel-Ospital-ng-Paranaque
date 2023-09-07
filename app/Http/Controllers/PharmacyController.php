<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pharmacy;
use App\PharmacyCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = uniqid('', true); // generate a more unique ID
        $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
        $token .= time(); // add the current timestamp
        session()->put('form_token', $token); // store the token in the session

        $pharmacies = Pharmacy::join('pharmacy_categories', 'pharmacies.category_id', '=', 'pharmacy_categories.id')
        ->get(['pharmacies.*', 'pharmacy_categories.name as category_name']);
      

        return view('pharmacy.list',['token' => $token])
        ->with('pharmacies',$pharmacies)
        ->with('categories', PharmacyCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'amount' => 'required',
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


        // Sanitize user input
        $name = strip_tags($request->input('name'));
        $amount = strip_tags($request->input('amount'));

        $save = Pharmacy::create([
            'medicine' => $name,
            'category_id' => $request->category,
            'amount' => $amount,
        ]);

        if($save){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Create Pharmacy Ticket',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$save->id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }

        // flash message
        session()->flash('success', 'Pharmacy added.');
        // redirect user
        return back();
    }

    public function editPharmacy(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'pharmacy_id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'amount' => 'required',
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


        // Sanitize user input
        $name = strip_tags($request->input('name'));
        $amount = strip_tags($request->input('amount'));

        $data = ([
            'medicine' => $name,
            'category_id' => $request->category,
            'amount' => $amount,
        ]);

        $update = DB::table('pharmacies')->where('id',$request->pharmacy_id)->update($data);

        if($update){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Update Pharmacy Ticket',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$request->pharmacy_id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }

        // flash message
        session()->flash('success', 'Pharmacy updated.');
        // redirect user
        return back();
    }


   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroypharmacy(Request $request)
    {
        $id = $request->remove_hd;
        $delete = DB::table('pharmacies')->where('id',$id)->delete();

        if($delete){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Remove Pharmacy Ticket',
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
        session()->flash('success', 'Pharmacy
         remove.');
        // redirect user
        return back();
    }


    public function pharmaciescategory()
    {    
        $token = uniqid('', true); // generate a more unique ID
        $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
        $token .= time(); // add the current timestamp
        session()->put('form_token', $token); // store the token in the session
        return view('pharmacy.categories',['token' => $token])->with('categories', PharmacyCategory::all());
    }
    
    public function pharmacycategory_store(Request $request){

        // Validate user input
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
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


        // Sanitize user input
        $name = strip_tags($request->input('category_name'));

        $save = PharmacyCategory::create([
            'name' => $name,
        ]);

        if($save){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Create Pharmacy Category',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$save->id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }

        // flash message
        session()->flash('success', 'Category added.');
        // redirect user
        return back();

    }


    public function editpharmacyCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'mcid' => ['required'],
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //Sanitize input
        $category_name = strip_tags($request->input('category_name'));

        $update = DB::table('pharmacy_categories')->where('id',$request->mcid)->update(array('name' => $category_name));

        if($update){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Update Pharmacy Category',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$request->mcid,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }
        
        session()->flash('success', 'Category updated.');
        return back();
    }

    public function destroypharmacyCategory(Request $request){
        $id = $request->remove_category;
        $delete = DB::table('pharmacy_categories')->where('id',$id)->delete();

        if($delete){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Remove Pharmacy Category',
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
        session()->flash('success', 'Category remove.');
        // redirect user
        return back();
    }

}
