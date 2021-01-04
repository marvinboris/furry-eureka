<?php

namespace App\Http\Controllers;

use App\Action;
use App\Type;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['actions' => Action::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['types' => Type::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'type_id' => 'required|numeric',
            'date' => 'required|date',
            'status' => 'required|numeric',
            'comment' => 'nullable|string',
            'postponed_at' => 'nullable|date',
        ]);
        $action = Action::create($request->all());
        return response()->json(['action' => $action]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['action' => Action::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(['action' => Action::findOrFail($id), 'types' => Type::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'type_id' => 'required|numeric',
            'date' => 'required|date',
            'status' => 'required|numeric',
            'comment' => 'nullable|string',
            'postponed_at' => 'nullable|date',
        ]);
        $action = Action::findOrFail($id)->update($request->all());
        return response()->json(['action' => $action]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Action::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
