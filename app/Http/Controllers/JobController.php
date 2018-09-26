<?php

namespace App\Http\Controllers;

// use App\Http\Requests\UpdateJobRequest;
use Illuminate\Http\Request;
use App\Job;
use App\User;
use App\Task;
use Session;
use Auth;

class JobController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        return view('dashboard.jobs.index', array('user' => Auth::user()), compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jobs.create', array('user' => Auth::user()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $user = Auth::user();
        $user_id = $user->id;
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'type' => 'required|min:3|max:100',
            'start' => 'required',
            'end' => 'required',
            'description' => 'required|min:15'
        ]);

        $job = new Job();

        if ($user_id == $request->user_id) {
        $job->user_id = $request->user_id;
        $job->name = $request->name;
        $job->type = $request->type;
        $job->start = date('Y-m-d H:i:s', strtotime($request->start));
        $job->end = date('Y-m-d H:i:s', strtotime($request->end));
        $job->description = $request->description;

        $job->save();

        Session::flash('success', 'Job Created Successfully!');
        return redirect()->route('jobs.index');
      } else {
        Session::flash('danger', 'Attention! Something wrong happened, please again try later!');
        return redirect()->route('jobs.create');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::findOrFail($id);

        // $job = Job::where('id', $id)->with('tasks')->get();
        // dd($job);

        $jobId = $job->id;
        // dd($jobId);
        $tasks = Task::where('job_id', $jobId)->get();
        // dd($tasks);
        // return view('dashboard.jobs.show', compact('job', 'task'));
        return view('dashboard.jobs.show')->withJob($job)->withTasks($tasks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $loggedId = Auth::id();
        $userId = Auth::user()->id;
        // dd($userId);
        // dd($loggedId);
        $job = Job::where('user_id', $userId)->first();
        // $job = Job::where('user_id', Auth::user()->id)->find($id);
        // dd($job->user_id);
        $user_id = $job->user_id;
        // dd([$user_id, $userId]);

        if ($user_id == $userId){
          $job = Job::findOrFail($id);
          $status = Job::pluck('status', 'status');
          return view('dashboard.jobs.edit', array('user' => Auth::user()), compact('job', 'status'));
        } else {
          Session::flash('danger', 'Sorry, you can not edit this job!');
          return redirect()->route('jobs.index');
        }


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
        // $user = Auth::user();
        // $job = Job::findOrFail($id);
        // $job = Job::where('user_id', $userId)->first();
        // dd($user);
        // $userJob = $user->job->get();
        // $loggedId = Auth::id();
        // dd($userJob);

        // $this->authorize('update', $job);

      // $user = User::findOrFail($loggedId);
      // $job_id = $request->job_id;
      // $user_id = Job::where($loggedId, $job_id)->get();
      // $job = $user->job;
      // dd($job->user_id);
      $this->validate($request, [
          'name' => 'required|min:3|max:100',
          'type' => 'required|min:3|max:100',
          'start' => 'required',
          'end' => 'required',
          'description' => 'required',
          'status' => 'required'
      ]);

      // if ($user_id == $userId){

      $job = Job::findOrFail($id);

      // if ($loggedId == $request->user_id) {

      $job->name = $request->name;
      $job->type = $request->type;
      $job->start = date('Y-m-d H:i:s', strtotime($request->start));
      $job->end = date('Y-m-d H:i:s', strtotime($request->end));
      $job->description = $request->description;
      $job->status = $request->status;
      $job->save();

      Session::flash('success', 'Job Updated Successfully!');
      return redirect()->route('jobs.index');
    // } else {
    //   Session::flash('danger', 'Attention! Something wrong happened, please again try later!');
    //   return redirect()->route('jobs.edit');
    // }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $job = Job::findOrFail($id);
      $job->delete();


      Session::flash('success', 'Job Was Successfuly Deleted!');
      return redirect()->route('jobs.index');
    }
}
