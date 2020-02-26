<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employer;
use App\Models\SocialLink;
Use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\CompanyTiming;
use App\Models\CompanySocialLink;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use App\Models\PostJob;
use App\Models\JobApplied;
use App\Models\Employer_Notification;
use App\Models\Messages;
use Validator;


class EmployerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employer');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_id = Auth::user()->company_id;

        $company = Company::where('id', '=', $company_id)->get();

        $jobs = PostJob::with('jobapplied')->where('company_id', '=',  $company_id)->where('status', '=',  '1')->orderBy('id', 'desc')->get();

        $appliedjob = JobApplied::with('user')->where('company_id', '=',  $company_id)->orderBy('id', 'desc')->get();

        $job_applieds = JobApplied::where('company_id', '=',  $company_id)->where('status', '=', 'invited')->get();

        return view('employer.employer_dashboard', ['jobs'=>$jobs, 'job_applieds'=>$job_applieds, 'appliedjob'=>$appliedjob, 'company'=>$company[0]]);
    }

    public function editProfile()
    {   
        $sociallink=SocialLink::all();
        $id = Auth::id();
        $countries = Countries::all();
        if(Employer::where('id','=',$id)->whereNotNull('company_id')->exists()){
            return redirect()->intended(route('employer.dashboard'));
        }
        return view('employer.employer_edit_profile',['sociallink'=>$sociallink, 'countries' =>$countries]);
    }

    public function UpdateUserProfile()
    {   
        $id = Auth::id();        
        $countries = Countries::all();
        $states = States::all();
        $city = Cities::all();
        $data= Employer::where('id','=',$id)->get();         
        return view('employer.update_user_profile',['data'=> $data,'countries' =>$countries , 'states' =>$states , 'city' =>$city ]);
    }

    //testing
    public function UserProfileData1()
    {
        $id =  Auth::user()->company_id; 
        $countries = Countries::all(); 
        $query = SocialLink::query();
       
        $sociallink =  $query->get();
        $company_social_links= CompanySocialLink::with('social_link')->where('company_id',$id)->get(); 
        $data= Company::with(['company_contact', 'company_timing'])->where('id','=',$id)->get();   

        return view('employer.update_user_profile', ['data'=>$data , 'countries'=>$countries, 'company_social_links'=>$company_social_links, 'sociallink'=>$sociallink]);
    }//testing
    

    public function UserProfileData(Request $request)
    {
        
        $userid = Auth::id();
        $id =  Auth::user()->id; 
        $employer = Employer::find($id);
        
        $employer->name = $request->input('name');
        $employer->lname = $request->input('lname');
        $employer->username = $request->input('username');
        $employer->phone = $request->input('phone');        
        $employer->address = $request->input('address');
        $employer->zip = $request->input('zip'); 
        $employer->country = $request->input('country');
        $employer->state = $request->input('state');
        $employer->city = $request->input('city');
        $updated = $employer->save();
        
        return redirect()->intended(route('employer.view_profile')); 
    }

    public function saveProfile(Request $request)
    {
      // print_r($request->all());die;
       /**
      * Get a validator for an incoming registration request.
      *
      * @param  array  $request
      * @return \Illuminate\Contracts\Validation\Validator
      */
      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required',  'email', 'max:255'],
        'business' => ['required', 'string'],
        'employees' => ['required'],
        'address' => ['required'],
        'country' => ['required'],      
        'state' => ['required'],
        'city' => ['required'],
        'zip' => ['required'],
        'hours_type' => ['required'],
        ]);

    /**
        * insert the  registration request.
        *
        * @param  array  $request
      */

        $userid = Auth::id();
        $company = new Company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->nature_of_business = $request->input('business');
        $company->about = $request->input('about');
        $company->no_of_employee = $request->input('employees');
        $company->address = $request->input('address');
        $company->country = $request->input('country');
        $company->state = $request->input('state');
        $company->city = $request->input('city');
        $company->zip = $request->input('zip');
        $company->hour_type = $request->input('hours_type');
        $company->alternate = $request->input('alternate');
        $inserted = $company->save();

        if($inserted)
        {            
           $company_id = $company->id;
           $contacts =  $request->input('contact');
           $companytimings = $request->input('timing');
           $social_links = $request->input('social_link');

            foreach($contacts as $k=>$contact) {
                $company_contact = new CompanyContact();

                $company_contact->company_id =  $company->id;
                $company_contact->contact = $contact;
                if($k==0){
                    $company_contact->is_primary = 1;
                }
                
             $contactinserted =    $company_contact->save();
            }

            foreach($companytimings as $k=>$companytiming) {

                $company_timing = new CompanyTiming();

                $company_timing->company_id =  $company->id;
                $company_timing->day = $companytiming['day'];
                $company_timing->open_at = date("h:i", strtotime( $companytiming['starttime'] ));
                $company_timing->close_at = date("h:i", strtotime( $companytiming['endtime'] ));
                $company_timing->is_working_day = isset($companytiming['status'])?1:0;
                

             $timinginserted =    $company_timing->save();
            }

            foreach($social_links as $k=>$social_link) {

                $company_social = new CompanySocialLink();

                $company_social->company_id =  $company->id;
                $company_social->social_link_id = $social_link['social'];
                $company_social->link = $social_link['social_link'];
                

             $socialinserted =    $company_social->save();
            }

         $UpdateDetails = Employer::where('id', $userid)->update(['company_id' => $company->id]);   

           return redirect()->intended(route('employer.dashboard'))->with('status', 'You are registerd');           
        }
        else
        {
            return redirect()->intended(route('employer.editprofile'));  
        }


    }

    //For fetching states
    public function getStates(Request $request)
    {
        $states = States::where('country_id',$request->input('country_id'))->get();
        return response()->json(['states' => $states, 'success' => 1]);
    }

    //For fetching cities
    public function getCities(Request $request)
    {
        $cities = Cities::where('state_id',$request->input('state_id'))->get();
        return response()->json(['cities' => $cities, 'success' => 1]);
    }

    public function profilview(Request $request)
    {
        $id = Auth::id();        
        $countries = Countries::all();
        $data= Employer::with('Company')->where('id','=',$id)->get();         
        return view('employer.view_profile',['data'=> $data, 'countries'=>$countries ]);    
    }

    public function Edit_Profile()
    {
        $id =  Auth::user()->company_id; 
        $countries = Countries::all(); 

        $query = SocialLink::query();
       
        $sociallink =  $query->get();
        $company_social_links= CompanySocialLink::with('social_link')->where('company_id',$id)->get(); 
        $data= Company::with(['company_contact', 'company_timing'])->where('id','=',$id)->get();   

        return view('employer.edit_profile', ['data'=>$data , 'countries'=>$countries, 'company_social_links'=>$company_social_links, 'sociallink'=>$sociallink]);
    }


    public function updateProfile(Request $request)
    {
      
      $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required',  'email', 'max:255'],
        'business' => ['required', 'string'],
        'employees' => ['required'],
        'address' => ['required'], 
              

        ]);

        $userid = Auth::id();
        $id =  Auth::user()->company_id; 
        $company = Company::find($id);
        
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->nature_of_business = $request->input('business');
        $company->about = $request->input('about');
        $company->no_of_employee = $request->input('employees');
        $company->address = $request->input('address');
        $company->country = $request->input('country');
        $company->state = $request->input('state');
        $company->city = $request->input('city');
        $company->zip = $request->input('zip');
        $company->hour_type = $request->input('hours_type');
        $company->alternate = $request->input('alternate');
        $updated = $company->save();
                  
        if($updated)
        {   
            $social_links = $request->input('social_link');            
            $id =  Auth::user()->company_id; 

            if($request->has('contact')){
               $contacts =  $request->input('contact');
                if(is_array($contacts) && count($contacts)> 0){
                    foreach($contacts as $contact){
                        
                        if(isset($contact['id'])){
                            $CompanyContact = CompanyContact::find($contact['id']);
                        }else{
                            $CompanyContact = new CompanyContact();
                        }
                        $CompanyContact->company_id = $id;
                        $CompanyContact->contact = $contact['value'];
                        $query = $CompanyContact->save();
                    }
                }
            }         

            foreach($social_links as $k=>$social_link) {

                if(isset($social['id'])){
                    $CompanySocial = CompanySocialLink::find($link['id']);
                }else{
                    $company_social = new CompanySocialLink();
                }
                $company_social->company_id =  $company->id;
                $company_social->social_link_id = $social_link['social'];
                $company_social->link = $social_link['social_link'];
                $query = $company_social->save();
             
            }
           
            return redirect()->intended(route('employer.view_profile')); 
        }
        else {
            return redirect()->intended(route('employer.view_profile')); 
        }    
        
    }
    public function employer_notification()
    {
        $id =  Auth::user()->company_id; 

        $notification = Employer_Notification::where('company_id', '=', $id)->where('status', '=', '0')->get();

        if($notification){        
            return response()->json(['success'=> 1, 'status'=> 200, 'data' => $notification]);
        }else{
            return response()->json(['error'=>'Somthing went wrong']);               
        }
    }

    public function update_employer_notification(Request $request)
    {
 
        $toUpdate = ['status' => $request->status];
        $update_notification_status = Employer_Notification::where('id',$request->id)->update($toUpdate);

        if($update_notification_status){        
            return response()->json(['success'=> 1, 'status'=> 200,]);
        }else{
            return response()->json(['error'=>'Somthing went wrong']);
        }
    }


    public function messageInbox(Request $request)
    { 
        $company_id =  Auth::user()->company_id;

        $messages = Messages::with('user', 'company')->where('company_id', '=', $company_id)->groupBy('user_id')->get();

        return view('employer.msginbox', ['messages'=>$messages]);
    } 

    public function inboxMessage(Request $request)
    { 
        $company_id =  Auth::user()->company_id;

        $inbox_messages = Messages::with('user', 'company')->where('user_id', '=', $request->user_id)->where('company_id', '=', $company_id)->get();

        if($inbox_messages){        
            return response()->json(['success'=> 1, 'status'=> 200, 'data' => $inbox_messages]);
        }else{
            return response()->json(['error'=>'Somthing went wrong']);               
        }
    }
    
    public function sendMessage(Request $request)
    { 
        if($request->imageFile != 'undefined'){
            $check['iagemFile'] = 'file|mimes:jpeg,png,jpg,gif,pdf,docx,doc|max:2048';
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
   
}






