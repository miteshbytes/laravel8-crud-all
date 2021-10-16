<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Rules\FirstnameRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('employee.index', compact('employees'))->with('i', (request()->input('page', 1) - 1) * 10);
        // return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'first_name' => 'required|max:255|regex:/^[A-Z a-z]+$/u',
            'last_name'  => 'required|max:255|regex:/^[A-Z a-z]+$/u',
            'email'      => 'required|max:255|unique:employees,email',
            'password'   => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'phone'      => 'required|digits:10|unique:employees,phone',
            'gender'     => 'required',
            'city'       => 'required',
            'skills'     => 'required',
            'hobbies'    => 'required',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ], [
            'password.regex' => "Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.",
        ]);
        
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = "default.jpg";
        }

        $storeData             = $request->all();
        $storeData['password'] = Hash::make($request->input('password'));
        $storeData['skills']   = $request->input('skills');
        $storeData['hobbies']  = $request->input('hobbies');
        $storeData['image']    = $imageName;
        $employee = Employee::create($storeData);
        if($employee) {
            return redirect()->route('employees.index')->with('success','Employee created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.create', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $storeData = $request->validate([
            'first_name' => 'required|max:255|regex:/^[A-Z a-z]+$/u',
            'last_name'  => 'required|max:255|regex:/^[A-Z a-z]+$/u',
            'email'      => 'required|max:255|unique:employees,email,'.$id,
            'phone'      => 'required|digits:10|unique:employees,phone,'.$id,
            'gender'     => 'required',
            'city'       => 'required',
            'skills'     => 'required',
            'hobbies'    => 'required',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $employee = Employee::find($id);
        $imageName = $employee->image;
        if($request->hasFile('image')) {
            if ($employee->image != 'default.jpg') {
                unlink(public_path('images/') . $employee->image);
            }
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
        }
        
        $employee->first_name  = $request->input('first_name');
        $employee->last_name   = $request->input('last_name');
        $employee->email       = $request->input('email');
        $employee->phone       = $request->input('phone');
        $employee->gender      = $request->input('gender');
        $employee->city        = $request->input('city');
        $employee->skills      = $request->input('skills');
        $employee->hobbies     = $request->input('hobbies');
        $employee->about_us    = $request->input('about_us');
        $employee->image       = $imageName;
        
        $result = $employee->save();
        if($result) {
            return redirect()->route('employees.index')->with('success','Employee updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        // unlink profile image
        if ($employee->image != 'default.jpg') {
            unlink(public_path('images/') . $employee->image);
        }
        if($employee->delete()){
            return redirect()->route('employees.index')->with('success','Employee deleted successfully.');
        }
    }
}
