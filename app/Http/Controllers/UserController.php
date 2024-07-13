<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function courses()
    {
        $user = User::find(Auth::user()->id);
        $courses = Course::where('user_id', $user->id)->get();

        return Inertia::render('Profile/Courses', [
            'courses' => $courses,
        ]);
    }
}
