<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Qualification;
use App\Models\PostJob;
use App\Models\JobApplied;
use App\Models\Designation;
use App\validator;
use Session;


class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:employer');
    }

    public function index(Request $request)
    {

        $designations = Designation::where('status', '=', 1)->get();        
        $qualifications = Qualification::where('status', '=', 1)->get();
        $data = ['qualifications'=>$qualifications, 'designations'=>$designations];

        if ($request->has('id')){
            $job_id = decrypt($request->query('id'));
            $job = PostJob::where('id', '=', $job_id)->get();
            $data['job'] = $job[0];
        } 
        
        return view('employer.job_post',$data);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {

        $this->validate($request, [
            'jobtitle' => ['required', 'string', 'max:255'],
            'address' => ['required',  'string'],
            'job_type'  => ['required' ,'string'],
            'salary_min'     => ['required'],
            'salary_max'    => ['required'],
            'anual'  => ['required'],
            'min_exp_year'  => ['required'],
            'min_exp_preferred'  => ['required'],
            'exp_max_yer'  => ['required'],
            'exp_preferred'  => ['required'],
            'openings'  => ['required'],
            'edu_minmum'  => ['required'],
            'edu_preferred'  => ['required'],
            'email'  => ['required'],
            'skills'  => ['required'],   
        ]);


       $company_id = Auth::user()->company_id;

        if ($request->job_id !== null) {
            $id = $request->input('job_id');
            $postjob = postjob::find($id);
        }else{
             $postjob = new postjob;
        }
                
        $postjob->company_id = $company_id;
        $postjob->title = $request->jobtitle;
        $postjob->company_address = $request->address;
        $postjob->job_type	 = $request->job_type;
        $postjob->salary_range_from = $request->salary_min;
        $postjob->salary_range_to = $request->salary_max;
        $postjob->salary_range_per = $request->anual;
        $postjob->min_experience = $request->min_exp_year;
        $postjob->max_experience = $request->exp_max_yer;
        $postjob->min_experience_type = $request->min_exp_preferred;
        $postjob->max_experience_type = $request->exp_preferred;
        $postjob->openings = $request->openings;
        $postjob->qualification_required = $request->edu_minmum;
        $postjob->qualification_type = $request->edu_preferred;
        $postjob->receive_email = $request->email;
        $postjob->job_summary = $request->job_summary;
        $postjob->responsibility = $request->duties;
        $postjob->skills = $request->skills;
        $postjob->benefits = $request->benifits;
        $postjob->save();

        return redirect()->intended(route('employer.jobs'))->with('status', 'Job Posted Succesfully post');              
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $sortBy = 'created_at';
        $orderBy = 'desc';
        $perPage = 10;
        $q = null;
        $jobs= [];
        
        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) $q = $request->query('q');
        
        $jobs = PostJob::with('jobapplied')->where('company_id', '=',  $company_id)->search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        
        return view('employer.jobs',['jobs'=>$jobs->appends(['q' => $q,'orderBy' => $orderBy , 'sortBy' => $sortBy ]), 'orderBy'=>$orderBy, 'sortBy'=>$sortBy, 'q'=>$q, 'perPage'=>$perPage]);  
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
     * Update status the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatestatus(Request $request)
    {

        $UpdateDetails = PostJob::where('id', $request->id)->update(['status' => $request->status]);
        
        if($UpdateDetails){        
            return response()->json(['success'=>'Job status updated successfully.']);
        }else{
            return response()->json(['error'=>'Somthing went wrong']);
        }
    }

    /* delete job the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function deletejob(Request $request)
   {
        $model = PostJob::find( $request->id );        
        if($model->delete()){
            return response()->json(['success'=>'Job Deleted successfully.']);
        }
        else{
            return response()->json(['error'=>'Somthing went wrong']);
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
        //
    }

    public function filter(Request $request)
    {
        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 20;
        $q = null;

        if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
        if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
        if ($request->has('perPage')) $perPage = $request->query('perPage');
        if ($request->has('q')) {
            $q = $request->query('q');
            $qq = $request->input('q');
         } 

        $users = User::search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);
        $users->appends(['q' => $qq]);
        
        return view('users.index', compact('users', 'orderBy', 'sortBy', 'q', 'perPage'));
    }
}
