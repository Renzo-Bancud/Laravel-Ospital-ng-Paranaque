<?php

namespace App\Http\Controllers;

use App\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class LaboratoryDeliveryController extends Controller
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

        $lab_deliveries = DB::table('laboratory_deliveries')->join('laboratory_categories', 'laboratory_deliveries.category_id', '=', 'laboratory_categories.id')
        ->join('laboratories', 'laboratory_deliveries.lab_id', '=', 'laboratories.id')
        ->get(['laboratory_deliveries.*', 'laboratories.*', 'laboratory_categories.name as category_name']);

        $laboratories = DB::table('laboratories')->get();
        $categories = DB::table('laboratory_categories')->get();

        return view('laboratory_delivery.list',['token' => $token])
        ->with('lab_deliveries', $lab_deliveries)
        ->with('categories',$categories)
        ->with('laboratories', $laboratories);
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

        $existingLaboratory = DB::table('laboratory_deliveries')->where('lab_id', $request->name)->first();
       
        if ($existingLaboratory) {
            
            // Add the quantity delivered to the existing Medicine record
            $newQuantity = $existingLaboratory->qty + $request->input('quantity');
             DB::table('laboratory_deliveries')->where('lab_id', $request->name)->update(['qty' => $newQuantity, 'updated_at' => Carbon::now()]);
            // flash message
            session()->flash('item_exists', 'The medicine you are trying to add already exists and we have added the quantity to the existing record. You can edit the record if there are any changes to the item.');
        } else {

        $data = ([
            'lab_id' => $name,
            'category_id' => $request->category,
            'brand' => $brand,
            'lot_no' => $lot_number,
            'expiry' => $request->expire_date,
            'qty' => $quantity, 
            'unit_price' => $unit_price, 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $save = DB::table('laboratory_deliveries')->insertGetId($data);

        if($save){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Create Lab Delivery',
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
    public function editLabDelivery(Request $request)
    {
        
         // Validate user input
         $validator = Validator::make($request->all(), [
            'delivery_id' => 'required',
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
        $id = strip_tags($request->input('delivery_id'));
        $name = strip_tags($request->input('name'));
        $brand = strip_tags($request->input('brand'));
        $lot_number = strip_tags($request->input('lot_number'));
        $quantity = strip_tags($request->input('quantity'));
        $unit_price = strip_tags($request->input('unit_price'));
       
       
    

        $data = ([
            'lab_id' => $name,
            'category_id' => $request->category,
            'brand' => $brand,
            'lot_no' => $lot_number,
            'expiry' => $request->expire_date,
            'qty' => $quantity, 
            'unit_price' => $unit_price, 
            'updated_at' => Carbon::now(),
        ]);

        $update = DB::table('laboratory_deliveries')->where('id',$id)->update($data);


        if($update){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Update Lab Delivery',
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







    public function destroyLabDelivery(Request $request)
    {
    
        $id = $request->remove_delivery;
        $delete = DB::table('laboratory_deliveries')->where('id',$id)->delete();

        if($delete){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Remove Lab Delivery',
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
