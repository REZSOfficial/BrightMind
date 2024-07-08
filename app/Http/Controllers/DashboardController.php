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
        $courses = Course::inRandomOrder()->take(6)->get();

        return Inertia::render('Dashboard', [
            'courses' => $courses
        ]);
    }
}
