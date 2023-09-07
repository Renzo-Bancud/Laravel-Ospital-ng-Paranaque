<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\Department\CreateDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments_list = Department::all();
        $departments = $departments_list->sortByDesc('id');

        return view('departments.index')->with('departments', $departments);
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'department' => ['required'],
            'description' => ['required', 'string', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        if ($request->department == 1) {
            $name = 'Laboratory';
        } elseif ($request->department == 2) {
            $name = 'Pharmacy';
        } elseif ($request->department == 3) {
            $name = 'Radiology';
        } else {
            $name = 'Dialysis';
        }
        Department::create([
            'dep_id' => $request->department,
            'name' =>  $name,
            'description' => $request->description
        ]);
        // flash message
        session()->flash('success', 'Department Added.');
        // redirect user
        return redirect(route('departments.index'));
    }

    public function editDepartment(Request $request){

        $validator = Validator::make($request->all(), [
            'department' => ['required'],
            'description' => ['required', 'string', 'max:2000'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->department == 1) {
            $name = 'Laboratory';
        } elseif ($request->department == 2) {
            $name = 'Pharmacy';
        } elseif ($request->department == 3) {
            $name = 'Radiology';
        } else {
            $name = 'Dialysis';
        }

        $data = array('dep_id' => $request->department, 'name' =>  $name,  'description' => $request->description);
        DB::table('departments')->where('id',$request->dept_id)->update($data);
        
        session()->flash('success', ' Department updated.');
        return redirect(route('departments.index'));

    }

    public function destroy(Department $department)
    {
        $department->doctors()->detach();
        $department->delete();
        // flash message
        session()->flash('success', ' Department Deleted Successfully.');
        // redirect user
        return redirect(route('departments.index'));
    }
}
