<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use App\Role;
use Auth ;
use Illuminate\Http\Request;
use App\Mail\ToHR;
use App\Mail\ToHRFirst;
use App\Mail\ToMod;
use Mail;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ["except" => ["index", "show"]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Job::class);
        $jobs = Job::where("status", "=", "1")->orderBy("created_at","desc")->paginate(5);
        return view("jobs.index")->with(compact("jobs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        
        $this->authorize('create', Job::class);
        
        return view("jobs.create");
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'title' => 'required|min:6|max:24',
            'description' => 'required|min:6|max:255',
            "email" => "required|email|", 
        ]);
        
        if ($validator->passes() && $request->has('title') && $request->has('description') && $request->has('email')){

            $job = new Job;

            $job->title = $request->input('title');
            $job->description = $request->input('description');
            $job->email = $request->input('email');
            $job->user_id = auth()->user()->id;
            $job->status = 0;
            $job->save();

            $user = auth()->user();
            $jobCount = count($user->job)-1;//Excluding last job.
            $toHR = $user->email;

            $CurrentUsersApprovedJobs = count($user->job->where("status", "=", "1"));
            $CurrentUsersUnApprovedJobs = count($user->job->where("status", "=", "0"));

            $messageToHRFirst = new ToHRFirst($user,$job,$CurrentUsersUnApprovedJobs);
            $messageToHR = new ToHR($user,$job,$CurrentUsersApprovedJobs);

            $mods = User::whereHas(
                'role', function($q){
                    $q->where('name', 'job board moderator');
                }
            )->get();

            if($user->role->name==="hr manager" && $CurrentUsersUnApprovedJobs>=0){

                Mail::to($toHR)->send($messageToHRFirst);

                for($i=0;$i<count($mods);$i++){

                    Mail::to($mods[$i]->email)->send(new ToMod($mods[$i],$job,$jobCount));

                }

            }
            else if($user->role->name==="hr manager" && $CurrentUsersApprovedJobs>0){

                Mail::to($toHR)->send($messageToHR);

            }

            return redirect("/jobs")->with("success", "Job Posted. ".$validator->passes());

        }
        else{

            return redirect("/jobs")->with("success", "Job aborted. ".$validator->fails());

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        $jobx = Job::find($job->id);
        
        return view("jobs.show")->with(compact("jobx"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        $this->authorize('update', Job::class);
        $job = Job::find($job->id);
        
        return view("jobs.edit")->with(compact("job"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        $this->authorize('update', Job::class);

        $validator = \Validator::make($request->all(), [
            'title' => 'required|min:6|max:24',
            'description' => 'required|min:6|max:255',
            "email" => "required|email|", 
        ]);

        if ($validator->passes() && $request->has('title') && $request->has('description') && $request->has('email')){
        
            $job = Job::find($job->id);
            
            $job->title = $request->input('title');
            $job->description = $request->input('description');
            $job->email = $request->input('email');
            $job->save();

            return redirect("/jobs")->with("success", "Job Post Updated. ".$validator->passes());

        }
        else{

            return redirect("/jobs")->with("error", "Job Post Update unseccessful. ".$validator->fails());

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        $this->authorize('delete', Job::class);
        $job = Job::find($job->id);
        $job->delete();
        return redirect("/jobs")->with("success", "Job post removed");
    }

    public function status(Request $request, $id){

        $this->authorize('status', Job::class);
        
        $validator = \Validator::make($request->all(), [
            'job' => 'required|',
            'status' => 'required|exists:jobs',
        ]);
        
        if($validator->passes() && $request->has('status') && $request->has('job')){
            
            $jobId = $request->input('job');
            $status = $request->input('status');
            $job = Job::find($jobId);
            
            $job->status = $status;

            $user = $job->user;
            $to = $user->email;
            $jobCount = count($user->job);
            $messageToHR = new ToHR($user,$job,$jobCount);

            if($request->input('status')==="1"){

                Mail::to($to)->send($messageToHR);

            }
            
            $job->save();

            return redirect("/jobs")->with("success", "Job Post Updated. ".$validator->passes());
        }
        else{
            return redirect("/jobs")->with("success", "Job Post couldn't be updated. ".$validator->fails());
        }
        
    }
}
