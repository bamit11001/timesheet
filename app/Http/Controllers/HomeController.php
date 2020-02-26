<?php
namespace App\Http\Controllers;
use Session;
use App\User;
use App\validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['User_Profile_data', 'AdminProfile','MessageInbox','UserProfile','registeru','regdata','candidate','employe_sign_up','employer_signup','logout','jobs', 'index','contact_u','part3','part4','getPostData','savePost','registerUser','register','registerdata' ,'signup', 'company_review','salary_page','resume','employer','employee','user_sign_up','employee_sign_up','contact_us' ,'find_job','store','verified','employe_sign_up','buy_us','review']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        return view('home');
    }
  
    
    public function review()
    {
        return view('admin.review');
    }

    public function company_review()
    {
        return view('frontend.company_review');
       
    }

    public function salary_page()
    {
        return view('frontend.salary');
       
    }

    public function salray_abc()
    {
        return view('frontend.salrayyy');
       
    }

    public function resume()
    {
        return view('frontend.post_resume');
    }
    

    public function employer()
    {
        return view('frontend.employer');
    }

    public function employee()
    {
        return view('frontend.employee');
    }

    // public function buy_us()
    // {
    //     return view('frontend.buy_us');
    // }
    // public function jobs()
    // {

    //     return view('admin.pages.jobs');
       
    // }
    public function registeru(Request $request)
        {
            return view('frontend.register');
        }
 


    public function registerUser(Request $request)
        { 
            $result=DB::insert("insert into users(name,lname,email,password) value(?,?,?,?)" ,[$request->input('name'), $request->input('lname'), $request->input('email'), $request->input('password') ] );
            return view('frontend.register');      
        }

    public function contact_us(Request $request)
        {
          $result=DB::insert("insert into contact_us(name,email,phone,message) value(?,?,?,?)" ,[$request->input('name'),  $request->input('email'),$request->input('phone') , $request->input('email'),$request->input('message')] );
            return view('frontend.contact_us');      
        }

    public function jobs(Request $request)
        {
            $result=DB::insert("insert into find_jobs(jobtitle,company,city,state,pincode) value(?,?,?,?,?)" ,[$request->input('jobtitle'), $request->input('company'),$request->input('city') , $request->input('state'),$request->input('pincode')] );
            return view('admin.jobs');      
        }
        
    // public function review(Request $request)
    //     {
    //     $result=DB::insert("insert into find_jobs(jobtitle,company,city,state,pincode) value(?,?,?,?,?)" ,[$request->input('jobtitle'), $request->input('company'),$request->input('city') , $request->input('state'),$request->input('pincode')] );
    //     return view('admin.review');      
    //     }

    public function find_job()
        {
            return view('frontend.find_job');
        }

    public function UserProfile()
        {
            return view('frontend.user.profile');
        }

    public function buy_us(Request $request)
        {
            return view('frontend.buy_us');
        }


    public function insertbuy_us(Request $request)
        {
            $validator=\Validator::make($request->all(),[
               'name'=>['required','string'],
               'organisation'=>['required','string'],
               'city'=>['required','string'],
               'mobile'=>['required','numeric'],
               'email'=>['required','string'],
            ]);
             if($validator->fails())
             {
                // return back()->withErrors($validator); 
                return redirect()->back()->withInput();
                // return Redirect::to('buy_us')->withErrors($validator);
             }

             $amit=[
             'name'=>request('name'),
             'organisation'=>request('organisation'),
             'city'=>request('city'),
             'email'=>request('email'),
             'mobile'=>request('mobile'),
             ];
       
             $ak=DB::table('buy_us')->insert($amit);
             return view('frontend.buy_us')->with('message', 'Plan created successfully!');
        }

    public function registera(Request $request)
        {
            return view('frontend.employe_sign_up');
        }


       
    public function logout(Request $request)
    {
            Auth::logout();
            Session::flush();
            return redirect('login');
            //  return view('frontend.login');
    }

    public function user_sign_up(Request $request)
        {
            return view('frontend.user_sign_up');
        }

    public function employer_signup(Request $request)
        {
            
            $data=[
                'company_name'=>request('company_name'),
                'mobile'=>request('mobile'),
                'email'=>request('email'),
                'city'=>request('city'),
                'state'=>request('state'),
                'country'=>request('country'),
                'address'=>request('address'),
                'nature_buss'=>request('nature_buss'),
                'company_turnover'=>request('company_turnover'),
                'num_emp'=>request('num_emp'),
                'working_hours'=>request('working_hours'),
                'working_days'=>request('working_days'),
                ];
          
                $query=DB::table('employer')->insert($data);
                //print_r ($query); die();
                return view('frontend.post_resume')->with('message', 'Register created successfully!');       
        }
          
     
        public function employe_sign_up(Request $request)
        {
          return view('frontend.employe_sign_up');
        }
        public function candidate(Request $request)
        {
            $data=[
             'emp_name'=>request('emp_name'),
             'mobile'=>request('mobile'),
             'email'=>request('email'),
             'city'=>request('city'),
             'state'=>request('state'),
             'country'=>request('country'),
             'address'=>request('address'),
             'qualification'=>request('qualification'), 
             'university'=>request('university'),
             'job_experience'=>request('job_experience'),
             'previous_company_name'=>request('previous_company_name'),
             'contact_details'=>request('contact_details'),
             'company_address'=>request('company_address'),
             'skills'=>request('skills'),
             'working_hours'=>request('working_hours'),
             'preferred_job_location'=>request('preferred_job_location'),
             'job_profile'=>request('job_profile'),
             ];

             $abc = DB::table('candidate')->insert($data);
             //return redirect('home/dashboard');
             return view('frontend.post_resume')->with('message', 'Employe Register Sucessfully'); 
            }


            public function search_job(Request $request)
            {
                $job_title = $request->input('job_title');
                $location = $request->input('location');
              $users = DB::table('find_job')
                          ->select(DB::raw())
                          ->where('job_title', 'like', "%{$job_title}%")
                          ->orWhere('location', 'like', "%{$location}%")
                          ->get();
                           print_r($users); die;
                    return view('frontend.find_job', ['users' => $users]);
            }


            public function MessageInbox(Request $request)
            { 
                    return view('admin.pages.msginbox');
            } 


            public function homeuser(Request $request)
            {
                return view('frontend.homed');
            }   

            public function AdminProfile(Request $request)
            {
                return view('admin.pages.admin_profile');
            }   

                
            public function User_Profile_data (Request $request){ 

                // $validator = \Validator::make($request->all(), [
                //     'image' => ['image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
                //     'resume' => ['image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
                // ]);
                //  if ($validator->fails())
                // {
                //     return response()->json(['errors'=>$validator->errors()->all()]);
                // }
        
                // $destination = 'uploads';
                // $image = $request->file('image');
                // $filename = $image->getClientOriginalName();
                // $image->move($destination, $filename);
                // $location = $destination . "/{{asset('frontend/uploads')}}" . $filename;
    
    
                // $destination = 'uploads';
                // $image = $request->file('resume');
                // $filename = $image->getClientOriginalName();
                // $image->move($destination, $filename);
                // $resume = $destination . "/{{asset('frontend/uploads')}}" . $filename;
    
            // $data = [
            //     // 'image'                 => $location,
            //     'first_name'            =>  request('first_name'),
            //     'last_name'             =>  request('last_name'),
            //     'email'                 =>  request('email'),
            //     'dob'                   =>  request('dob'),
            //     'nationality'           => request('nationality'),
            //     'gender'                => request('gender'),
            //     'designation'           => request('designation'),
            //     'company'               => request('company'),
            //     'start_month'               => request('start_month'),
            //     'start_years'               => request('start_years'),
            //     'salary_in_lakh'               => request('salary_in_lakh'),
            //     'salary_in_thousand'               => request('salary_in_thousand'),
            //     'annual'               => request('annual'),
            //     'current_company'               => request('current_company'),
            //     'notice_period'               => request('notice_period'),
            //     'qualification'               => request('qualification'),
            //     'university'               => request('university'),
            //     'from_school'               => request('from_school'),
            //     'education_type'  => request('education_type'),
            //     'passing_year'                => request('passing_year'),
            //     'location'         => request('location'),
            //     'industry' => request('industry'),
            //     'job_type'           => request('job_type'),
            //     'skills'        => request('skills'),
            //     // 'resume'          => request('resume'),
            //       ];  
    
                //$query=DB::table('user_profile')->insert($data);

                $result=DB::insert("insert into user_profile(first_name,last_name,email,dob,nationality,gender,designation,company,start_month,start_years,salary_in_lakh,salary_in_thousand,annual,current_company,notice_period,qualification,university,from_school,education_type,passing_year,location,industry,job_type,skills) value(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)" ,
                [   
                    $request->input('first_name'), 
                    $request->input('last_name'),
                    $request->input('phone') , 
                    $request->input('email'),
                    $request->input('dob'),
                    $request->input('nationality'),
                    $request->input('gender'),
                    $request->input('designation'),
                    $request->input('company'),
                    $request->input('start_month'),
                    $request->input('start_years'),
                    $request->input('salary_in_lakh'),
                    $request->input('salary_in_thousand'),
                    $request->input('annual'),
                    $request->input('current_company'),
                    $request->input('notice_period'),
                    $request->input('qualification'),
                    $request->input('university'),
                    $request->input('from_school'),
                    $request->input('education_type'),
                    $request->input('location'),
                    $request->input('industry'),
                    $request->input('job_type'),
                    $request->input('skills'),
                ] );

                print_r($result); die;
                return view('frontend.user.profile');  

                // // print_r($query); die;
                // if($query){
                //     echo "Data Inserted Successfully ";
                //     return view('frontend.user.profile');
                // }
                // else
                // {
                //     echo "Try Again ";
                //     return view('frontend.user.profile');
                // }
    
       }

       public function emplyeehome (){ 
        echo "emplyee home";

       }

       public function emplyerhome (){ 
        echo "emplyer home";

       }
       public function defaulthome (){ 
        echo "default home";

       }


            
                
}

