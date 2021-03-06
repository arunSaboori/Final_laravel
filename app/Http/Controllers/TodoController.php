<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {

        $todos = Todo::query()->get()->all();
        return view('Todo.index', compact('todos'));
    }
                      
    public function store(Request $request)
    {
        Todo::query()->insert([
            'name' => $request->name,
            'title' => $request->title
        ], $request->validate([
            'name' => 'required',
            'title' => 'required',
        ]));
        return redirect()->route('todo.index');
    }

    public function create()
    {
        return view('Todo.create');
    }

    
    
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todo.index');
    }
    
    public function update(Request $request, $todo)
    {
        
        
        $student = Todo::find($todo);
        $student->name = $request->input('name');
        $student->title = $request->input('title');
        $student->update();
        return redirect()->route('todo.index')->with('status', 'Student Updated Successfully');
    }

    
          public function edit(Todo $todo)
   {

       return view('todo.edit', compact('todo'));
}
}