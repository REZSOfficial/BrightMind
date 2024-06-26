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
}
