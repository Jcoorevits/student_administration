<?php

namespace App\Http\Controllers;

use App\Course;
use App\Programme;
use DB;
use Illuminate\Http\Request;
use Json;

class CourseController extends Controller
{
    public function index(Request $request)
    {


        $textFilter = '%' . $request->filter . '%';
        $dropFilter = $request->filterSelect == '' ? '%%' : $request->filterSelect;

        $defaults = DB::table('programmes')->distinct('name')->get();


        $courses = Course::with('programme')
            ->where([['programme_id', 'like', $dropFilter],
                ['description', 'like', $textFilter]])
            ->orwhere([['programme_id', 'like', $dropFilter],
                ['name', 'like', $textFilter]])
            ->orderBy('name')
            ->get();

        if ($dropFilter == "%%") {
            $programme = "all programmes";
        } else {
            $programme = " the programme <b>'" . DB::table('programmes')->where('id', $dropFilter)->value('name') . "'</b>";
        }

        if ($textFilter == '%%') {
            $filter = '';
        } else {
            $filter = "with <b>'" . substr($textFilter, 1, -1) . "'</b>";
        }

        $results = compact('courses', 'defaults', 'filter', 'programme');
        Json::dump($results);
        return view('courses.index', $results);
    }

    public function show($id)
    {
        $courses = Course::with('programme')->with('studentcourses')->with('studentcourses.student')->where('id', '=', $id )->orderBy('name')->get();
        $results = compact('courses');
        Json::dump($results);
        return view('courses.show', $results);
    }
}
