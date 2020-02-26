<?php
namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Job;
use App\validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.job.jobs');
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
        //$validator=\Validator::make($request->all(),[
        
        //     'jobtitle' => 'required',
        //     'c_address'  => 'required',
        //     'job_type'  => 'required',
        //     'salary_min'     => 'required',
        //     'salary_max'    => 'required',
        //     'anual'  => 'required',
        //     'min_exp_year'  => 'required',
        //     'designation'  => 'required',
        //     'exp_max_yer'  => 'required',
        //     'exp_preferred'  => 'required',
        //     'hiring'  => 'required',
        //     'edu_minmum'  => 'required',
        //     'edu_preferred'  => 'required',
        //     'email'  => 'required',
        //     'job_summary'  => 'required',
        //     'duties'  => 'required',
        //     'skills'  => 'required',
        //     'benifits'  => 'required',
        // ]);

            // if($validator->fails())
            //     {
            //         return redirect()->back()->withInput();                
            //     }

        $job = new Job;
        
        $job->jobtitle = $request->jobtitle;
        $job->c_address = $request->c_address;
        $job->job_type = $request->job_type;
        $job->salary_min = $request->salary_min;
        $job->salary_max = $request->salary_max;
        $job->anual = $request->anual;
        $job->min_exp_year = $request->min_exp_year;
        $job->designation = $request->designation;
        $job->exp_max_yer = $request->exp_max_yer;
        $job->exp_preferred = $request->exp_preferred;
        $job->hiring = $request->hiring;
        $job->edu_minmum = $request->edu_minmum;
        $job->edu_preferred = $request->edu_preferred;
        $job->email = $request->email;
        $job->job_summary = $request->job_summary;
        $job->duties = $request->duties;
        $job->skills = $request->skills;
        $job->benifits = $request->benifits;
   
        $job->save();

     
         return redirect(route('job.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = job::find($id) ; 
        //$job = job::where('id',$id)->first();
        return redirect(route('job.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $job = job::where('id',$id)->first();
        return view('admin.pages.job.edit',compact('job'));

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
        $job = job::find($id) ; 

        $job->jobtitle = $request->jobtitle;
        $job->c_address = $request->c_address;
        $job->job_type = $request->job_type;
        $job->salary_min = $request->salary_min;
        $job->salary_max = $request->salary_max;
        $job->anual = $request->anual;
        $job->min_exp_year = $request->min_exp_year;
        $job->designation = $request->designation;
        $job->exp_max_yer = $request->exp_max_yer;
        $job->exp_preferred = $request->exp_preferred;
        $job->hiring = $request->hiring;
        $job->edu_minmum = $request->edu_minmum;
        $job->edu_preferred = $request->edu_preferred;
        $job->email = $request->email;
        $job->job_summary = $request->job_summary;
        $job->duties = $request->duties;
        $job->skills = $request->skills;
        $job->benifits = $request->benifits;
   
        $job->save();
        //return view('admin.pages.job.edit',compact('jobs'));
       return redirect (route('job.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        job::where('id',$id)->delete();
        return redirect()->back();
    }


    public function getUserData($id){
        $userData = job::get();
        return json_encode(array('data'=>$userData));
    }
   

}
