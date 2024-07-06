<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    public function show(Subject $subject)
    {
        $subject->load('user');
        $course = json_decode(Storage::get('/public/courses/1.json'), true);
        return Inertia::render('Course/Show', [
            'subject' => $subject,
            'course' => $course
        ]);
    }

    public function answers(Subject $subject, Request $request)
    {
        $answers = json_decode(Storage::get('/public/courses/1.json'), true);
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
}
