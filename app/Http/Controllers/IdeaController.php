<?php

namespace App\Http\Controllers;

use App\Models\idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function update(idea $idea)
    {

        if(auth()->id() !== $idea->user_id){
            abort(404);
        }
        $validated = request()->validate([
            'content' => 'required|min:3|max:240',
        ]);

        $idea->update($validated);

        // return view('ideas.show',compact('idea', 'editing'));
        return redirect()->route('ideas.show', $idea->id)->with('success','Idea edited successfully!');
    }

    public function edit(idea $idea)
    {

        if(auth()->id() !== $idea->user_id){
            abort(404);
        }
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

        $validated = request()->validate([
            'content' => 'required|min:3|max:240',
        ]);

        $validated['user_id'] = auth()->id();

        idea::create($validated);
        // idea::create(request()->all());

        return redirect()->route('dashboard')->with('success','Idea created successfully!');
    }

    public function destroy(idea $idea)
    {

        if(auth()->id() !== $idea->user_id){
            abort(404);
        }

        $idea->delete();
        // idea::where('id',$id)->firstOrFail()->delete();

        return redirect()->route('dashboard')->with('success','Idea deleted successfully!');
    }
}