<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DataTables;

class YajraDatatableController extends Controller
{
    public function index()
    {
        return view('employee.employee-list');
    }

    public function getStudents(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('id', 'first_name', 'last_name', 'email', 'phone', 'image')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // It's below only display image column
                ->addColumn('image', function ($row) { 
                    $url= asset('images/'.$row->image);
                    return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                // end display image column
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="employees/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                    // $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
    }
}
