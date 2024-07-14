<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function courses()
    {
        $user = User::find(Auth::user()->id);
        $courses = Course::where('user_id', $user->id)->get();
        $courses->load('subject');

        foreach ($courses as $course) {
            $course->is_favourite = Favourite::where('user_id', Auth::user()->id)->where('course_id', $course->id)->exists();
        }

        return Inertia::render('Profile/Courses', [
            'courses' => $courses,
        ]);
    }

    public function favourites()
    {
        $user = User::find(Auth::user()->id);
        $favourites = Favourite::where('user_id', $user->id)->get();
        $favourites->load('course.subject');

        foreach ($favourites as $favourite) {
            $favourite->course->is_favourite = Favourite::where('user_id', Auth::user()->id)->where('course_id', $favourite->course->id)->exists();
        }

        return Inertia::render('Profile/Courses', [
            'favourites' => $favourites
        ]);
    }
}
