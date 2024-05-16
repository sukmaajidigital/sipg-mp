<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        $grades = Grade::all();
        $title = 'Grade Data';
        return view('grade.index', compact('grades', 'title'));
    }

    /** Show the form for creating a new resource. */
    public function create()
    {
        //
    }

    /** Store a newly created resource in storage.*/
    public function store(Request $request)
    {
        Grade::create([
            'name_grade' => $request->name_grade,
        ]);

        return redirect()->route('grade.index');
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
        $grade = Grade::find($id);
        $grade->update([
            'name_grade' => $request->name_grade,
        ]);

        return redirect()->route('grade.index');
    }

    /** Remove the specified resource from storage. */
    public function destroy($id)
    {
        $grade = Grade::find($id);

        //delete grades
        $grade->delete();

        //redirect to index
        return redirect()->route('grade.index');
    }
}
