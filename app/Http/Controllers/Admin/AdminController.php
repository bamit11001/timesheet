<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = DB::select('select * from jobs');
        return view('admin.dashboard',['jobs'=>$jobs]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.job.jobs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function review(Request $request){


    }

    public function job_view(Request $request){
        return view('admin.pages.job.job_view');
        
    }

    public function job(Request $request){
        return view('admin.pages.job.jobs');
        
    }
  
    public function jobinsert (Request $request){              
        $data = [
            'jobtitle' =>  request('jobtitle'),
            'c_address'  =>  request('c_address'),
            'job_type'  =>  request('job_type'),
            'salary_min'     =>  request('salary_min'),
            'anual'  => request('anual'),
            'min_exp_year'  => request('min_exp_year'),
            'designation'  => request('designation'),
            'exp_max_yer'  => request('exp_max_yer'),
            'exp_preferred'  => request('exp_preferred'),
            'hiring'  => request('hiring'),
            'edu_minmum'  => request('edu_minmum'),
            'edu_preferred'  => request('edu_preferred'),
            'email'  => request('email'),
            'job_summary'  => request('job_summary'),
            'duties'  => request('duties'),
            'skills'  => request('skills'),
            'benifits'  => request('benifits'),
              ];  

              
    $query=DB::table('jobs')->insert($data);
     if($query){
         echo "Data Inserted Successfully ";
         return view('admin.pages.job.jobs');
     }
    else
    {
        echo "Try Again ";
        return view('admin.pages.job.jobs');
    }         
   }


    public function department(Request $request){
        return view('admin.pages.department.insertdata');
    }
    public function datainsert (Request $request){              
        $data = [
            'name' =>  request('name'),
            'slug'  =>  request('slug'),
        ]; 
        $query=DB::table('insertdata')->insert($data);
        if($query){
            echo "Data Inserted Successfully ";
            return view('admin.pages.department.insertdata');
        }
       else
       {
           echo "Try Again ";
           return view('admin.pages.department.insertdata');
       }         
    }
}


