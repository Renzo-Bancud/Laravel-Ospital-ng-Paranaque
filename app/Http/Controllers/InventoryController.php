<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InventoryController extends Controller
{
    public function pharmacyInventory(){
        
        $medicines = Medicine::join('pharmacy_categories', 'medicines.category_id', '=', 'pharmacy_categories.id')
        ->join('pharmacies', 'medicines.pharma_id', '=', 'pharmacies.id')
        ->leftJoin('test_charge_tickets', 'medicines.pharma_id', '=', 'test_charge_tickets.item_id')
        ->select('medicines.*', 'pharmacies.medicine', 'pharmacy_categories.name as category_name', DB::raw('SUM(test_charge_tickets.qty) as total_qty'))
        ->groupBy('medicines.id')
        ->get();
    
        return view('pharmacy_inventory')->with('medicines',$medicines);
        
    }


    public function laboratoryInventory(){
        


        $lab_deliveries = DB::table('laboratory_deliveries')->join('laboratory_categories', 'laboratory_deliveries.category_id', '=', 'laboratory_categories.id')
        ->join('laboratories', 'laboratory_deliveries.lab_id', '=', 'laboratories.id')
        ->leftJoin('test_charge_tickets', 'laboratory_deliveries.lab_id', '=', 'test_charge_tickets.item_id')
        ->select('laboratory_deliveries.*', 'laboratories.*', 'laboratory_categories.name as category_name', DB::raw('SUM(test_charge_tickets.qty) as total_qty'))
        ->groupBy('laboratories.id')
        ->get();

        return view('laboratory_inventory')->with('lab_deliveries',$lab_deliveries);   
    }

    public function radiologyInventory(){

        $radiology_deliveries = DB::table('radiology_deliveries')
        ->join('radiologies', 'radiology_deliveries.radiology_id', '=', 'radiologies.id')
        ->join('radiology_categories', 'radiology_deliveries.category_id', '=', 'radiology_categories.id')
        ->leftJoin('test_charge_tickets', 'radiology_deliveries.radiology_id', '=', 'test_charge_tickets.item_id')
        ->select('radiology_deliveries.*','radiologies.*','radiology_categories.name as category_name', DB::raw('SUM(test_charge_tickets.qty) as total_qty'))
        ->groupBy('radiologies.id')
        ->get();
    
        return view('radiology_inventory')->with('radiology_deliveries',$radiology_deliveries);   
    }

}
