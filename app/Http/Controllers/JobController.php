<?php

namespace App\Http\Controllers;

use App\Job;
use App\User;
use Auth ;
use Illuminate\Http\Request;
use App\Mail\JobCreated;
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
        $jobs = Job::orderBy("created_at","desc")->paginate(5);
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
        $this->validate(
            $request,
            [
                'title' => 'required|min:6|max:24',
                'description' => 'required|min:6|max:255',
                "email" => "required|email|",
            ]
        );
        
        $job = new Job;
        /*Kada se pozove ova funkcija,
        uzmi sta ima iz inputa sa imenom title.*/
        $job->title = $request->input('title');
        $job->description = $request->input('description');
        $job->email = $request->input('email');
        $job->user_id = auth()->user()->id;
        $job->save();

        $jobCount = count(Job::all());

        $user = auth()->user();

        if($jobCount===0){

            Mail::to(auth()->user()->email)->send(

                new toHRFirst($user,$job,$jobCount)
    
            );

        }
        else{

            Mail::to(auth()->user()->email)->send(

                new JobCreated($user,$job,$jobCount)
    
            );

        }
        
        /*
        Mail::to(auth()->user()->email)->send(

            new JobCreated($user,$job,$jobCount)

        );
        */

        return redirect("/jobs")->with("success", "Job Posted");
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

        $this->validate(
            $request,
            [
                'title' => 'required|min:6|max:24',
                'description' => 'required|min:6|max:255',
                "email" => "required|email|",
            ]
        );
        
        $job = Job::find($job->id);
        
        /*Kada se pozove ova funkcija,
        uzmi sta ima iz inputa sa imenom title.*/
        $job->title = $request->input('title');
        $job->description = $request->input('description');
        $job->email = $request->input('email');
        $job->save();

        return redirect("/jobs")->with("success", "Job Post Updated");
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
}
