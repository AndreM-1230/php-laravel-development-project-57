<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate();
        return view('labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('labels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|unique:labels|max:255',
                'description' => 'nullable|string'
            ],
            [
                'name.unique' => 'Метка с таким именем уже существует',
                'name.required' => 'Это обязательное поле',
            ]
        );

        Label::create($validated);
        return redirect()->route('labels.index')->with('success', __('Метка успешно создана'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label)
    {
        $validated = $request->validate(
            [
                'name' => 'required|max:255|unique:labels,name,' . $label->id,
                'description' => 'nullable|string'
            ],
            [
                'name.unique' => 'Метка с таким именем уже существует',
                'name.required' => 'Это обязательное поле',
            ]
        );

        $label->update($validated);
        return redirect()->route('labels.index')->with('success', __('Метка успешно изменена'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            return back()->with('error', __('Не удалось удалить метку'));
        }

        $label->delete();
        return redirect()->route('labels.index')->with('success', __('Метка успешно удалена'));
    }
}
