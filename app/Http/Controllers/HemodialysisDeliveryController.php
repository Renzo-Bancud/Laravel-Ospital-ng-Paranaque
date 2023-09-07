<?php

namespace App\Http\Controllers;

use App\Hemodialysis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class HemodialysisDeliveryController extends Controller
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

        $hemodialysis_deliveries = DB::table('hemodialysis_deliveries')
        ->join('hemodialysis_categories', 'hemodialysis_deliveries.category_id', '=', 'hemodialysis_categories.id')
        ->join('hemodialysis', 'hemodialysis_deliveries.dialysis_id', '=', 'hemodialysis.id')
        ->get(['hemodialysis_deliveries.*', 'hemodialysis.*', 'hemodialysis_categories.name as category_name', 'hemodialysis_deliveries.id as hid']);

        $hemodialysis = DB::table('hemodialysis')->get();
        $categories = DB::table('hemodialysis_categories')->get();

        return view('hemodialysis_delivery.list',['token' => $token])
        ->with('hemodialysis_deliveries', $hemodialysis_deliveries)
        ->with('categories',$categories)
        ->with('hemodialysis', $hemodialysis);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'category' => 'required',
                'brand' => 'required',
                'lot_number' => 'required',
                'expire_date' => 'required',
                'quantity' => 'required',
                'unit_price' => 'required', 
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
        $brand = strip_tags($request->input('brand'));
        $lot_number = strip_tags($request->input('lot_number'));
        $quantity = strip_tags($request->input('quantity'));
        $unit_price = strip_tags($request->input('unit_price'));

        $existingHemodialysis = DB::table('hemodialysis_deliveries')->where('dialysis_id', $request->name)->first();
       
        if($existingHemodialysis){

        // Add the quantity delivered to the existing Medicine record
        $newQuantity = $existingHemodialysis->qty + $request->input('quantity');
        DB::table('hemodialysis_deliveries')->where('dialysis_id', $request->name)->update(['qty' => $newQuantity, 'updated_at' => Carbon::now()]);
        // flash message
        session()->flash('item_exists', 'The medicine you are trying to add already exists and we have added the quantity to the existing record. You can edit the record if there are any changes to the item.');

        }else{

        $data = ([
            'dialysis_id' => $name,
            'category_id' => $request->category,
            'brand' => $brand,
            'lot_no' => $lot_number,
            'expiry' => $request->expire_date,
            'qty' => $quantity, 
            'unit_price' => $unit_price, 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $save = DB::table('hemodialysis_deliveries')->insertGetId($data);

        if($save){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Create Hemodialysis Delivery',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$save,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
        }

       


        }

        // flash message
        session()->flash('success', 'Delivery Added.');
        // redirect user
        return back();
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editHemodialysisDelivery(Request $request)
    {
        
         // Validate user input
         $validator = Validator::make($request->all(), [
            'delivery_id' => 'required',
            'name' => 'required',
            'category' => 'required',
            'name' => 'required',
            'brand' => 'required',
            'lot_number' => 'required',
            'expire_date' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required', 
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
        $id = strip_tags($request->input('delivery_id'));
        $name = strip_tags($request->input('name'));
        $brand = strip_tags($request->input('brand'));
        $lot_number = strip_tags($request->input('lot_number'));
        $quantity = strip_tags($request->input('quantity'));
        $unit_price = strip_tags($request->input('unit_price'));
       
    
        $data = ([
            'dialysis_id' => $name,
            'category_id' => $request->category,
            'brand' => $brand,
            'lot_no' => $lot_number,
            'expiry' => $request->expire_date,
            'qty' => $quantity, 
            'unit_price' => $unit_price, 
            'updated_at' => Carbon::now(),
        ]);

        $update = DB::table('hemodialysis_deliveries')->where('id',$id)->update($data);

        if($update){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Update Hemodialysis Delivery',
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
        session()->flash('success', 'Delivery Updated.');
        // redirect user
        return back();
    }


    public function destroyHemodialysisDelivery(Request $request)
    {
    
        $id = $request->remove_delivery;
        $delete = DB::table('hemodialysis_deliveries')->where('id',$id)->delete();

        if($delete){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Remove Hemodialysis Delivery',
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
        session()->flash('success', 'Delivery Deleted.');
        // redirect user
        return back();

    }
}
