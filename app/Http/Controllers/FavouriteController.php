<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function store(Course $course)
    {
        if (!Favourite::where('user_id', Auth::user()->id)->where('course_id', $course->id)->exists()) {
            Favourite::create([
                'user_id' => Auth::user()->id,
                'course_id' => $course->id
            ]);
        } else {
            Favourite::where('user_id', Auth::user()->id)->where('course_id', $course->id)->delete();
        }
    }
}
