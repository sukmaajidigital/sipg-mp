<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        $statuses = Status::all();
        $title = 'Status Data';
        return view('status.index', compact('statuses', 'title'));
    }

    /** Show the form for creating a new resource. */
    public function create()
    {
        //
    }

    /** Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        Status::create([
            'name_status' => $request->name_status,
        ]);

        return redirect()->route('status.index');
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
        $status = Status::find($id);
        $status->update([
            'name_status' => $request->name_status,
        ]);

        return redirect()->route('status.index');
    }

    /** Remove the specified resource from storage. */
    public function destroy($id)
    {
        $status = Status::find($id);

        //delete status
        $status->delete();

        //redirect to index
        return redirect()->route('status.index');
    }
}
