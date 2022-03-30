<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\track;
use App\Models\instructor;
use App\Models\session;
use App\Models\Event;

class FullCalenderController extends Controller
{
    public function create(Request $request)
    {
        $course = new course;
        $course->name = 'Basic language programming with C ';
        $course->id = 1;

        $course->save();

        $track = track::find([3, 4]);
        $course->courses()->attach($track);

        return 'Success';
    }
    public function show(course $course)
{
   return view('course.show', compact('course'));
}
public function creatation(Request $request)
    {
        $course2 = new course;
        $course2->name = 'Basic language programming with C ';
        $course2->id = 1;

        $course2->save();

        $instructor = instructor::find([3, 4]);
        $course2->courses()->attach($instructor);

        return 'Success';
    }
    public function show2(course $course2)
{
   return view('course.show', compact('course'));
}
public function creatations(Request $request)
    {
        $instructor = new instructor;
        $instructor->name = 'Basic language programming with C ';
        $instructor->id = 1;

        $instructor->save();

        $session = session::find([3, 4]);
        $instructor->instructors()->attach($session);

        return 'Success';
    }
    public function show3(instructor $instructor)
{
   return view('instructor.show', compact('instructor'));
}


    public function index(Request $request)
    {

    	if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                        ->whereDate('end',   '<=', $request->end)
                        ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('full-calender');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Event::find($request->id)->delete();

    			return response()->json($event);
    		}

    	}

    }



}
?>
