<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return view('todo-list', ['todos' => $todos->toArray()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|min:3',
            'is_done' => 'required|bool'
        ]);
        $newTodo = Todo::query()->create($validated);

        return $newTodo;
    }

    public function update($id, Request $request)
    {
//        abort(404);
        $todo = Todo::find($id);
        $todo->update($request->all());
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return ['content' => $todo->content];
    }
}
