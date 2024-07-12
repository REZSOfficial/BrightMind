<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        try {
            // Load the course JSON from storage
            $course_json = json_decode(Storage::get('/public/courses/' . $course->id . '.json'), true);
            if (!$course_json) {
                return Inertia::render('Error', ['message' => 'Course not found or could not be loaded.']);
            }

            // Load related models
            $course->load('subject', 'user');

            // Render the course view with Inertia
            return Inertia::render('Course/Show', [
                'courseJson' => $course_json,
                'course' => $course,
            ]);
        } catch (\Exception $e) {
            // Handle the case where the course does not exist or other errors
            return Inertia::render('Error', ['message' => 'Course not found or could not be loaded.']);
        }
    }

    public function answers(Course $course, Request $request)
    {
        $answers = json_decode(Storage::get('/public/courses/' . $course->id . '.json'), true);
        $answers = $answers['correctAnswers'];

        $given_answers = $request->all();

        foreach ($given_answers as &$given_answer) {
            foreach ($answers as $correct_answer) {
                if ($given_answer["id"] === $correct_answer["questionId"]) {
                    $given_answer["correctAnswer"] = $correct_answer["answer"];
                    if ($given_answer["correctAnswer"] === $given_answer["givenAnswer"]) {
                        $given_answer["correct"] = true;
                    }
                }
            }
        }

        return response()->json($given_answers);
    }

    public function create()
    {
        return Inertia::render('Course/Create', [
            'subjects' => Subject::all()
        ]);
    }

    public function store(Request $request)
    {
        $subject = Subject::find($request->subject_id);
        $course = Course::create([
            'user_id' => Auth::user()->id,
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'cover_image' => $subject->title . '.png',
            'grade' => $request->grade,
        ]);

        $file_name = '/public/courses/' . $course->id . '.json';

        Storage::put($file_name, json_encode($request->all()));
    }
}
