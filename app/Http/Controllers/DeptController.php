<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use Illuminate\Http\Request;

class DeptController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        $depts = Dept::all();
        $title = 'Data Departement';
        return view('dept.index', compact('depts', 'title'));
    }

    /** Show the form for creating a new resource. */
    public function create()
    {
        //
    }

    /** Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        Dept::create([
            'name_dept' => $request->name_dept,
        ]);

        return redirect()->route('departement.index');
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
        $dept = Dept::find($id);
        $dept->update([
            'name_dept' => $request->name_dept,
        ]);

        return redirect()->route('departement.index');
    }

    /** Remove the specified resource from storage. */
    public function destroy($id)
    {
        $dept = Dept::find($id);

        //delete dept
        $dept->delete();

        //redirect to index
        return redirect()->route('departement.index');
    }
}
