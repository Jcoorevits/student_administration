<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Programme;
use Illuminate\Http\Request;

class Programme2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.prorammes2.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/programmes2');
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
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name'
        ]);

        // Create new $programme
        $programme = new Programme();
        $programme->name = $request->name;
        $programme->save();

        // Return a success message to master page
        return response()->json([
            'type' => 'success',
            'text' => "The programme <b>$programme->name</b> has been added"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Programme $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        return redirect('admin/programmes2');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Programme $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        return redirect('admin/programmes2');
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
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name,' . $programme->id
        ]);

        // Update genre
        $programme->name = $request->name;
        $programme->save();

        // Return a success message to master page
        return response()->json([
            'type' => 'success',
            'text' => "The genre <b>$programme->name</b> has been updated"
        ]);
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
        return response()->json([
            'type' => 'success',
            'text' => "The programme <b>$programme->name</b> has been deleted"
        ]);
    }

    public function qryProgrammes()
    {
        $programmes = Programme::orderby('name')->withCount('courses')->get();
        return $programmes;
    }

}
