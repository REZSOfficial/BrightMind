<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        // Get 6 random courses
        $courses = Course::inRandomOrder()->take(6)->get();
        $courses->load('subject');

        return Inertia::render('Dashboard', [
            'courses' => $courses
        ]);
    }
}
