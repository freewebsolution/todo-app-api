<?php

namespace App\Http\Controllers;

use App\Models\Todos;
use App\Http\Requests\StoreTodosRequest;
use App\Http\Requests\UpdateTodosRequest;
use App\Models\Lists;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $listId)
    {
        $todos = Todos::where('lists_id', $listId)->get();
        return response()->json($todos, 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodosRequest $request)
    {
        $text = $request->input('text');
        $done = $request->input('done');
        $listId = $request->input('listId');

        $todo = Todos::create([
            'text' => $text,
            'done' => $done,
            'lists_id' => $listId
        ]);

        return response()->json($todo, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($listId)
    {
        $todos = Todos::where('lists_id', $listId)->get();
        return response()->json($todos, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todos $todos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodosRequest $request, Todos $todo)
    {
        $todo->text = $request->has('text') ? $request->input('text') : $todo->text;
        $todo->done = $request->has('done') ? $request->input('done') : $todo->done;
        $todo->lists_id = $request->has('lists_id') ? $request->input('lists_id') : $todo->lists_id;
        $todo->save();

        $list = Lists::find($todo->lists_id);
        if ($list) {
            $list->undone_count = $list->todos()->where('done', 0)->count();
            logger($list);
            $list->save();
        }

        return response()->json($todo, 201);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todos $todo)
    {
        $listId = $todo->lists_id;

        // Elimina il "todo"
        $todo->delete();

        // Ora aggiorniamo anche l'undone_count nella lista associata
        $list = Lists::find($listId);
        if ($list) {
            $list->undone_count = $list->todos()->where('done', 0)->count();
            $list->save();
        }

        return response()->json('Todo deleted successfully', 201);
    }
}
