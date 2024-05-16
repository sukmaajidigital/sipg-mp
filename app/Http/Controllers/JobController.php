<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        $jobs = Job::all();
        $title = 'Data Job';
        return view('job.index', compact('jobs', 'title'));
    }

    /** Show the form for creating a new resource. */
    public function create()
    {
        //
    }

    /** Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        Job::create([
            'name_job' => $request->name_job,
        ]);

        return redirect()->route('job.index');
    }

    /**  Display the specified resource.*/
    public function show($id)
    {
        //
    }

    /** Show the form for editing the specified resource. */
    public function edit($id)
    {
        //
    }

    /** Update the specified resource in storage. */
    public function update(Request $request, $id)
    {
        $job = Job::find($id);
        $job->update([
            'name_job' => $request->name_job,
        ]);

        return redirect()->route('job.index');
    }

    /** Remove the specified resource from storage. */
    public function destroy($id)
    {
        $job = job::find($id);

        //delete job
        $job->delete();

        //redirect to index
        return redirect()->route('job.index');
    }
}
