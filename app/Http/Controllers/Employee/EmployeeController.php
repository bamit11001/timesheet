<?php

namespace App\Http\Controllers\Employee;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Users_Company;
use App\Models\PostJob;
use App\Models\Company;
use App\Models\JobPreference;
use App\Models\Users_Qualification;
use App\Models\JobApplied;
use Illuminate\Support\Facades\Validator;
use App\Models\Messages;
use App\Models\Skills;
use App\Models\UsersSkill;




class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.employee_dashboard');
    }
    
    public function jobList(Request $request)
    {
        $req = $request->all();
        $perPage = 10;
        $query = PostJob::query();
        $data=[];
        if (isset($req['q']) && $req['q']) {
            $data['q'] = $q = $req['q'];
            
            $query = $query->where('title','LIKE', '%'.$q.'%');
        }
     

        if (isset($req['l']) && $req['l']) {
            $city = $req['l'];
            $data['l'] = $city;
            $query->with(['cities', 'states', 'countries', 'company'])
                ->whereHas('cities', function($q) use($city) {
                $q->where('name', '=', $city);
            });
        }

       $jobs =  $query->paginate($perPage);
       $data['jobs'] = $jobs->appends($data);
       return view('employee.employee_joblist',$data);
    }
    public function jobDetail(Request $request)
    {
        $job_id = base64_decode($request->input('post'));
        $query = PostJob::query();
        $query->with(['cities', 'states', 'countries', 'company']);
        $query->where('id',$job_id);

        $job =  $query->get();
        return view('employee.employee_jobdetail',['job' => $job[0]]);
    }

    public function ViewProfile()
    {
        $id = Auth::user()->id;    
        //$skilldata = User::with('skills')->where('id',$id)->get();
        //$users_skill = UsersSkill()->id;
        $skills = UsersSkill::with('skills')->where('skill_id',$id)->get();
        //print_r($skills); die;
                
        $data = User::with('users_qualification','job_preference','users_skill')->where('id',$id)->get();
        return view('employee.view_profile', ['data'=>$data, 'skills'=>$skills ]);
    }

    public function saveResume(Request $request)
    {
        $validator =Validator::make($request->all(), [
                    
                     'resume' => 'required|file|mimes:doc,docx,pdf|max:2048',
                ]);

 

            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );

            $extension = $request->file('resume')->getClientOriginalExtension();
            $dir = 'images/resume';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('resume')->move($dir, $filename);
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->resume = $filename;
            $user->save();
            return $filename;
    }


    public function editProfile()
    {
        $did = Auth::id();
        $id = Auth::user()->id;
        $user=User::with('job_preference','users_company','users_qualification','users_skill')->where('id',$id)->get();
        return view('employee.edit_profile',['user'=>$user[0]]);
    }
    
    public function saveProfileImage(Request $request)
    {
        $validator = Validator::make($request->all(),
                [
                    'profile_img' => 'image',
                ],
                [
                    'profile_img.image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );

            $extension = $request->file('profile_img')->getClientOriginalExtension();
            $dir = 'images/employee';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('profile_img')->move($dir, $filename);
            // $photo =  $request->profile_img;
            // $filename = $photo->store('employee');
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->profile_img = $filename;
            $user->save();
            return $filename;
    }

public function postEditProfile(Request $request)
    {
            $userid = Auth::id();
            $id = Auth::user()->id;
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->lname = $request->input('lname');
            $user->email = $request->input('email');
            $user->dob = $request->input('dob');
            $user->nationality = $request->input('nationality');
            $user->gender = $request->input('gender');
            $updated = $user->save();

            if($updated)
            {  

                $employments = $request->input('employment');
                $id =  Auth::user()->id; 

                foreach($employments as $employment) {
                    
                    if(isset($employment['userscompanyid'])){
                        $user_company = Users_Company::find($employment['userscompanyid']);
                    }else{
                        $user_company = new Users_Company();
                    }

                    $user_company->user_id = $id;
                    $user_company->designation = $employment['designation'];
                    $user_company->company = $employment['company'];
                    $user_company->joined_on = $employment['joined_on'];                
                    $user_company->salary_lakh = $employment['salary_lakh'];
                    $user_company->salary_thousand = $employment['salary_thousand'];
                    $user_company->salary_period = $employment['salary_period']; 
                    $user_company->is_current = $employment['is_current']; 
                    //$user_company->currently_working = $employment['currently_working']; 
                    // $user_company->left_on = $employment['left_on']; 
                    //$user_company->notice_period = $employment['notice_period']; 
                    $user_company = $user_company->save();
                }

                $usersqualificationid = $request->input('usersqualificationid');
                // $userscompanyid = $request->input('userscompanyid');
                $id =  Auth::user()->id; 
                $users_qualification = Users_Qualification::find($usersqualificationid); 

                $users_qualification->qualification = $request->input('qualification');
                $users_qualification->from_university = $request->input('from_university');       
                $users_qualification->type =$request->input('type');
                $users_qualification->passing_year =$request->input('passing_year');
                $users_qualification = $users_qualification->save();

                $userpreferenceid = $request->input('userpreferenceid');
                $preference = JobPreference::find($userpreferenceid); 
                $preference->location = $request->input('location');
                $preference->industry = $request->input('industry');
                $preference->job_type = $request->input('job_type');

                $preference = $preference->save();
            }
            else
            {
                die(1);
            }
            return redirect()->intended(route('employee.profile')); 
            
    }


    
    public function postApplyJob(Request $request)
    {
        $id = Auth::user()->id;
        if(JobApplied::where('company_id', '=' ,$request->input('company_id'))->where('post_job_id', $request->input('job_id'))->where('user_id', $id)->exists()){
            return response()->json(['status' => 500,'errors'=>["job is already applied."]]);
        }
        
        $jobapply =  new JobApplied;
        $jobapply->company_id = $request->input('company_id');
        $jobapply->user_id = $id;
        $jobapply->post_job_id = $request->input('job_id');
        $jobapply->save();
        if($jobapply){
            return response()->json(['status' => 200,'msg'=>'Job is applied successfully']);
        }
        return response()->json(['status' => 500,'msg'=>'Something went wrong']);
        
    }

    //Message vnk
    public function messageInbox(Request $request)
    { 
        $id =  Auth::user()->id;
        $messages = Messages::with('user', 'company')->where('user_id', '=', $id)->orderBy('created_at', 'DESC')->groupBy('company_id')->get();
        return view('employee.msginbox', ['messages'=>$messages]);        
    }
   

    public function inboxMessage(Request $request)
    { 
        
        $user_id =  Auth::user()->id;
        $company_id = $request->input('company_id');
        $inbox_messages = Messages::with('user', 'company')->where('user_id', '=', $user_id)->where('company_id', '=', $company_id)->get();    
            
        if($inbox_messages){        
            return response()->json(['success'=> 1, 'status'=> 200, 'data' => $inbox_messages]);
        }else{
            return response()->json(['error'=>'Somthing went wrong']);               
        }
    }

    // public function sendMessage1(Request $request)
    // { 
    //     $company_id =  Auth::user()->company_id;
    //     $message = new Messages;

    //     $message->user_id = $request->user_id;
    //     $message->company_id = $request->company_id;
    //     $message->sent_by = $request->user_id;
    //     $message->message = $request->message;
    //     $message_sent = $message->save();

    //     if($message_sent){        
    //         return response()->json(['success'=> 1, 'status'=> 200, 'data' => $message_sent]);
    //     }else{
    //         return response()->json(['error'=>'Somthing went wrong']);   
    //     }
    // }


    //send messages
    public function sendMessage(Request $request)
    { 
        if($request->imageFile != 'undefined'){
            $check['imageFile'] = 'file|mimes:jpeg,png,jpg,gif,pdf,docx,doc|max:2048';
        }else{
            $check['message'] = 'required';
        }
        $validation = Validator::make($request->all(), $check);
        if($validation->passes())
        {
            $company_id =  Auth::user()->company_id;
            $message = new Messages;
            if($request->imageFile != 'undefined'){
                $image = $request->file('imageFile');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/chat'), $new_name);
                $message->file = $new_name;
                $message->message = $request->message;
            }
            else{         
                $message->message = $request->message;
            }
            
            $message->user_id = $request->user_id;
            $message->company_id = $request->company_id;
            $message->sent_by = $company_id;
            $message->message = $request->message;
            $message_sent = $message->save();   

        }else{
            return response()->json([
                'success' => 'failed',
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
         }

        if($message_sent){        
            return response()->json(['success'=> 1, 'status'=> 200, 'data' => $message_sent]);
        }else{
            return response()->json(['error'=>'Somthing went wrong']);   
        }
    }


    public function deleteResume(Request $request)
    {
            

            $user = User::find( $request->id );
            $user->resume = 'N/A';
            $updated = $user->save();
                     
            if($updated){
                return response()->json(['success'=>'Resume Deleted successfully.']);
            }
            else{
                return response()->json(['error'=>'Somthing went wrong']);
            }
    
    }

}
