<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function show()
    {
        $subjects = Subject::inRandomOrder()->take(6)->get();

        return Inertia::render('Dashboard', [
            'subjects' => $subjects
        ]);
    }
}
