<?php


namespace App\Http\Controllers;
use Session;
use App\Department;
use App\validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class DepartmentController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['insertdata','showdata','shown','inserted']]);
    }
    
    public function insertdata(Request $request)
    {
        return view('admin.pages.insertdata');
    }

    public function inserted(Request $request)
    {
    $data=[
        'name'=>request('name'), 
        'email'=>request('email'),
        'slug'=>request('slug'),
    ];
        $query=DB::table('register')->insert($data); 
        return view('admin.pages.insertdata')->with('message','Register Suceesfully');
    }
    
    public function showdata(Request $request){
        $register = DB::select('select * from register');
        return view('/admin.pages.showdata',['register'=>$register]);
    }

    public function showdataem(Request $request){
        $employer=DB::select('select * from employer');
        return view('/admin.pages.showdataem',['data'=>$data]);

    }
}
