<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hemodialysis;
use App\HemodialysisCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HemodialysisController extends Controller
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

        $hemodialysis = Hemodialysis::join('hemodialysis_categories', 'hemodialysis.category_id', '=', 'hemodialysis_categories.id')
        ->get(['hemodialysis.*', 'hemodialysis_categories.name as category_name']);
      

        return view('hemodialysis.list',['token' => $token])
        ->with('hemodialysis',$hemodialysis)
        ->with('categories', HemodialysisCategory::all());
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

        $save = Hemodialysis::create([
            'test' => $name,
            'category_id' => $request->category,
            'amount' => $amount,
        ]);

        if($save){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Create Hemodialysis Ticket',
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
        session()->flash('success', 'Hemodialysis added.');
        // redirect user
        return back();
    }


    public function editHemodialysis(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'hd_id' => 'required',
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
            'test' => $name,
            'category_id' => $request->category,
            'amount' => $amount,
        ]);

        $update = DB::table('hemodialysis')->where('id',$request->hd_id)->update($data);

        if($update){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Update Hemodialysis Ticket',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$request->hd_id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }

        // flash message
        session()->flash('success', 'Hemodialysis updated.');
        // redirect user
        return back();
    }

 


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyhemodialysis(Request $request)
    {
        $id = $request->remove_hd;
        $delete = DB::table('hemodialysis')->where('id',$id)->delete();

        
        if($delete){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Remove Hemodialysis Ticket',
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
        session()->flash('success', 'Hemodialysis
         remove.');
        // redirect user
        return back();
    }

    public function hemodialysiscategory()
    {    
        $token = uniqid('', true); // generate a more unique ID
        $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
        $token .= time(); // add the current timestamp
        session()->put('form_token', $token); // store the token in the session
        return view('hemodialysis.categories',['token' => $token])->with('categories', HemodialysisCategory::all());
    }


    public function hemodialysiscategory_store(Request $request)
    {
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

        $save = HemodialysisCategory::create([
            'name' => $name,
        ]);

        
        if($save){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Create Hemodialysis Category',
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

    public function edithemodialysisCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'mcid' => ['required'],
            'category_name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //Sanitize input
        $category_name = strip_tags($request->input('category_name'));

        $update = DB::table('hemodialysis_categories')->where('id',$request->mcid)->update(array('name' => $category_name));

        if($update){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Update Hemodialysis Category',
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

    public function destroyradioCategory(Request $request){
        $id = $request->remove_category;
        $delete = DB::table('hemodialysis_categories')->where('id',$id)->delete();

        if($delete){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Remove Hemodialysis Category',
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
