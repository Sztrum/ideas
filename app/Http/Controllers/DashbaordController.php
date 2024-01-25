<?php

namespace App\Http\Controllers;

use App\Models\idea;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function index() 
    {
        $ideas = idea::orderBy('created_at','DESC');

        // check if there is a search
        // if there is, search the value in database
        if (request()->has('search')) {
            $ideas = $ideas->where('content','like','%'.request()->get('search','').'%');
        }

        return view('dashboard', [
            'ideas' => $ideas->paginate(5),
        ]);
    }
}
