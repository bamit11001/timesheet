<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplied;
use App\Models\PostJob;
use App\User;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Messages;

class JobAppliedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:employer');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $company_id = Auth::user()->company_id;
        $auth_name = Auth::user()->name;
        $sortBy = 'created_at';
        $orderBy = 'desc';
        $perPage = 10;
        $q = null;

        $applied_jobs= [];
            if ($request->has('orderBy')) $orderBy = $request->query('orderBy');
            if ($request->has('sortBy')) $sortBy = $request->query('sortBy');
            if ($request->has('perPage')) $perPage = $request->query('perPage');
            if ($request->has('q')) $q['q'] = $request->query('q');
            if ($request->has('job')) $q['job'] = $request->query('job');

        $applied_jobs = JobApplied::with('post_job', 'user', 'user.users_skill', 'user.users_skill.skills')->where('company_id', '=',  $company_id)->search($q)->orderBy($sortBy, $orderBy)->paginate($perPage);

        $applied_jobs_title = PostJob::where('company_id', '=',  $company_id)->get();

        return view('employer.candidate_resume',['applied_jobs_title'=>$applied_jobs_title, 'applied_jobs'=>$applied_jobs->appends(['q' => $q['q'], 'job' => $q['job'],'orderBy' => $orderBy , 'sortBy' => $sortBy ]), 'orderBy'=>$orderBy, 'sortBy'=>$sortBy, 'q'=>$q['q'],'job' => $q['job'], 'perPage'=>$perPage, 'auth_name'=>$auth_name, 'company_id' => $company_id]);

    }



    /**
     * interviewstatus
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function interviewstatus(Request $request)
    {
      
        if($request->status == 'invited'){
            $chechvalid = [

                'date' => 'required',
                'message' => 'required',
                'interviewer_id' => 'required|email',
                'invite' => 'required',
    
            ];
            $validator = Validator::make($request->all(),$chechvalid );
            if($validator->fails()){
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            $toUpdate = ['interview_type' => $request->invite_type, 'interview_date' => $request->date, 'interview_start' => $request->start_time, 'interview_end' => $request->end_time, 'interview_venue' => $request->address, 'message' => $request->message, 'interviewer_email' => $request->interviewer_id];
        }

        $toUpdate['status'] = $request->status;
        $toUpdate['reason'] = $request->reason ?? '';

        $invitingcandidate =  JobApplied::where('id',$request->applied_id)->update($toUpdate);

        $data =   ['name'=>$request->name,'email'=>$request->email, 'status'=>$request->status];

        $mail =  Mail::to('vinay.cypress@gmail.com')->send(new SendMail($data));
       
        return response()->json(['success'=>'Job status updated successfully.']);

    }
    /**
     * deletejob the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function deletejob(Request $request)
    {

        $model = JobApplied::find( $request->id );

        if($model->delete())
        {
           return response()->json(['success'=>'Job Deleted successfully.']);        
        }else
        {
           return response()->json(['error'=>'Somthing went wrong']);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $id = decrypt($request->input('id'));

        $value = User::with('users_skill', 'users_skill.skills', 'users_company', 'job_preference', 'users_qualification')->where('id', '=',  $id)->get();
 
         return view('employer.candidate-profile',['value'=>$value]);
    }

    /**
     * Show the form for enableChat the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function enableChat(Request $request)
    {

        $company_id =  Auth::user()->company_id;
        $user_id = $request->user_id;
        $user = User::where('id', '=', $user_id)->get();

        $create_chat = Messages::with('user', 'company')->where('user_id', '=', $user_id)->where('company_id', '=', $company_id)->get();

        return response()->json(['success'=> 1, 'status'=> 200, 'data' => $create_chat, 'user' => $user]);               
        
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
}
