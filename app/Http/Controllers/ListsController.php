<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Http\Requests\StoreListsRequest;
use App\Http\Requests\UpdateListsRequest;



class ListsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = Lists::all();
        return response()->json($lists);
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
    public function store(StoreListsRequest $request)
    {
        {
            $listName = 'Nuova lista';

            $list = lists::create([
                'name' => $listName,
                'undone_count'=> 0
            ]);
            return response()->json($list, 201);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Lists $lists)
    {
        $lists->load('todos');

        return response()->json($lists);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lists $lists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListsRequest $request, Lists $list)
    {
        $list->name = $request->input('name');

        // Calcola il conteggio dei "todo" associati a questa lista
        $todoCount = $list->todos()->count();

        // Assegna il conteggio dei "todo" a undone_count
        $list->undone_count = $todoCount;

        $list->save();
        return response()->json($list, 201);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lists $list)
    {
        $list->delete();
        return response()->json('Listed deleted succefully', 201);
    }
}
