<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Programme;
use DB;
use Illuminate\Http\Request;
use Json;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       /* $courses = DB::table('courses')->orderBy('name')->get();*/

        $programmes = Programme::orderby('name')->withCount('courses')->get();
        /*$programmes = DB::table("programmes")->orderBy('name')->withCount('courses')->get();*/
        $results = compact('programmes');
        Json::dump($results);
        return view('admin.programmes.index', $results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.programmes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate $request
        $this->validate($request, [
            'name' => 'required|min:3|unique:programmes,name'
        ]);

        // Create new programme
        $programme = new Programme();
        $programme->name = $request->name;
        $programme->save();

        // Flash a success message to the session
        session()->flash('success', "The programme <b>$programme->name</b> has been added");
        // Redirect to the master page
        return redirect('admin/programmes');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Programme $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        $courses = Course::with('programme')->where('programme_id' , $programme->id)->orderBy('name')->get();
        $results = compact('programme', 'courses');
        Json::dump($courses);
        return view('admin.programmes.show', $results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Programme $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {

        $results = compact('programme');
        return view('admin.programmes.edit', $results);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Programme $programme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programme)
    {
        // Validate $request
        $this->validate($request, [
            'name' => 'required|min:3|unique:programmes,name,' . $programme->id
        ]);

        // Update programme
        if ($request->name === $programme->name) {
            session()->flash('danger', 'Not updated');
            return redirect('admin/programmes'); // of else
        }
        $oldName = $programme->name;
        $programme->name = $request->name;
        $programme->save();

        // Flash a success message to the session
        session()->flash('success', "The programme <b>'$oldName'</b> has been updated to <span class='text-danger'>'$programme->name'</span>");
        // Redirect to the master page
        return redirect('admin/programmes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Programme $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        $programme->delete();
        session()->flash('success', "The programme '<b>$programme->name</b>' has been successfully deleted");
        return redirect('admin/programmes');
    }
}
