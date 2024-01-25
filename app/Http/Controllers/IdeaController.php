<?php

namespace App\Http\Controllers;

use App\Models\idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function update(idea $idea)
    {
        request()->validate([
            'content' => 'required|min:3|max:240',
        ]);

        $idea->content = request()->get('content', "");
        $idea->save();

        // return view('ideas.show',compact('idea', 'editing'));
        return redirect()->route('ideas.show', $idea->id)->with('success','Idea edited successfully!');
    }

    public function edit(idea $idea)
    {
        $editing = true;

        return view('ideas.show',compact('idea', 'editing'));
    }

    public function show(idea $idea)
    {
        return view('ideas.show',compact('idea'));
        // return view('ideas.show',[
        //     'idea'=>$idea,
        // ]);
    }

    public function store()
    {

        request()->validate([
            'content' => 'required|min:3|max:240',
        ]);

        idea::create(
            [
                'content' => request()->get('content',''),
                // 'likes' => 0,
            ]
        );

        return redirect()->route('dashboard')->with('success','Idea created successfully!');
    }

    public function destroy(idea $idea)
    {

        $idea->delete();
        // idea::where('id',$id)->firstOrFail()->delete();

        return redirect()->route('dashboard')->with('success','Idea deleted successfully!');
    }
}