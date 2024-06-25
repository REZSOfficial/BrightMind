<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $fillable = [
        'user_id',
        'title',
        'grade',
        'description',
        'cover_image'
    ];
}
