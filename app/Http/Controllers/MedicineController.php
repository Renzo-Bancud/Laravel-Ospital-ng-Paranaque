<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Pharmacy;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MedicineController extends Controller
{
    public function index()
    {   
        $token = uniqid('', true); // generate a more unique ID
        $token .= bin2hex(random_bytes(16)); // add 16 bytes of random data
        $token .= time(); // add the current timestamp
        session()->put('form_token', $token); // store the token in the session

        $medicines = Medicine::join('pharmacy_categories', 'medicines.category_id', '=', 'pharmacy_categories.id')
        ->join('pharmacies', 'medicines.pharma_id', '=', 'pharmacies.id')
        ->get(['medicines.*', 'pharmacies.medicine', 'pharmacy_categories.name as category_name']);
      
        $categories = DB::table('pharmacy_categories')->get();
        $pharmacies = DB::table('pharmacies')->get();

        return view('medicines_delivery.list',['token' => $token])
        ->with('medicines', $medicines)
        ->with('pharmacies', $pharmacies)
        ->with('categories', $categories);
     
    }

    public function store(Request $request)
    {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'brand_number' => 'required',
            'registration_number' => 'required',
            'category' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'company' => 'required',
            'expire_date' => 'required',
        ]);
    
        if ($validator->fails()) {
            // return to the previous page with validation error messages
            return back()->withErrors($validator)->withInput();
        }
    
        // Check if a Medicine record with the same pharma_id already exists
        $existingMedicine = Medicine::where('pharma_id', $request->name)->first();
    
        if ($existingMedicine) {
            // Add the quantity delivered to the existing Medicine record
            $existingMedicine->quantity += $request->input('quantity');
            $existingMedicine->save();
    
            // flash message
            session()->flash('item_exists', 'The medicine you are trying to add already exists and we have added the quantity to the existing record. You can edit the record if there are any changes to the item.');
        } else {
            // Sanitize user input
            $brand_number = strip_tags($request->input('brand_number'));
            $registration_number = strip_tags($request->input('registration_number'));
            $purchase_price = strip_tags($request->input('purchase_price'));
            $sale_price = strip_tags($request->input('sale_price'));
            $quantity = strip_tags($request->input('quantity'));
            $company = strip_tags($request->input('company'));
    
            // Create a new Medicine record
            $save = Medicine::create([
                'pharma_id' => $request->name,
                'brand_number' => $brand_number,
                'registration_number' => $registration_number,
                'category_id' => $request->category,
                'purchase_price' => $purchase_price, // Cost Price
                'sale_price' => $sale_price, // PPP Price
                'quantity' => $quantity,
                'company' => $company,
                'expire_date' => $request->expire_date,
            ]);

            if($save){
          
                $data = array(
                    'user_id' => auth()->user()->id,
                    'user_type' => 'Admin Staff',
                    'activity_type' => 'Create Medicine Delivery',
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
            session()->flash('success', 'Medicine record added.');
        }
    
        // redirect user
        return redirect(route('medicines.index'));
    }
    




    public function editMedicine(Request $request){

         // Validate user input
         $validator = Validator::make($request->all(), [
            'med_id' => 'required',
            'name' => 'required',
            'brand_number' => 'required',
            'registration_number' => 'required',
            'category' => 'required',
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'company' => 'required',
            'expire_date' => 'required',
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
        $med_id = strip_tags($request->input('med_id'));
        $name = strip_tags($request->input('name'));
        $brand_number = strip_tags($request->input('brand_number'));
        $registration_number = strip_tags($request->input('registration_number'));
        $purchase_price = strip_tags($request->input('purchase_price'));
        $sale_price = strip_tags($request->input('sale_price'));
        $quantity = strip_tags($request->input('quantity'));
        $company = strip_tags($request->input('company'));
        
    


        $data = ([
            'pharma_id' => $name,
            'brand_number' => $brand_number,
            'registration_number' => $registration_number,
            'category_id' => $request->category,
            'purchase_price' => $purchase_price, // Cost Price
            'sale_price' => $sale_price, // PPP Price
            'quantity' => $quantity,
            'company' => $company,
            'expire_date' => $request->expire_date,

        ]);

        $update = DB::table('medicines')->where('id',$request->med_id)->update($data);

        if($update){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Update Medicine Delivery',
                'ip_address' => $request->ip(),
                'device_info' => $request->header('User-Agent'),
                'details' => 'Table Record ID'.' '.$request->med_id,
                'status' => 'success',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
             );
              
             DB::table('activitylogs')->insert($data);
    
        }

        // flash message
        session()->flash('success', 'Delivery Updated.');
        // redirect user
        return redirect(route('medicines.index'));

    }

    public function destroymedicine(Request $request)
    {
    
        $id = $request->remove_med;
        $delete = DB::table('medicines')->where('id',$id)->delete();

        if($delete){
          
            $data = array(
                'user_id' => auth()->user()->id,
                'user_type' => 'Admin Staff',
                'activity_type' => 'Delete Medicine Delivery',
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
        return redirect(route('medicines.index'));

    }
}
