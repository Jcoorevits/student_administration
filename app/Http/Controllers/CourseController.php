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
            ->get();
        /*$courses = Course::with('programme')
            ->where('programme_id', 'like', $dropFilter)
            ->where('description', 'like', $textFilter)
            ->orwhere('programme_id', 'like', $dropFilter)
            ->where('name', 'like', $textFilter)
            ->get();*/
        if ($dropFilter == 0) {
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
        return view('courses.show', ['id' => $id]);
    }
}
