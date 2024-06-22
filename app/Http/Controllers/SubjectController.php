<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = Subject::get();
        return view('admin.subject.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'description' => 'nullable',
        ]);

        try {
            $store = new Subject();
            $store->name = $request->name;
            $store->code = $request->code;
            $store->description = $request->description;

            $store->save();
        } catch (\Exception $e) {
            Log::error('SubjectController@store: ' . $e->getMessage());
            return redirect()->route('admin.subject.create')->with('error', $e->getMessage());
        }
        Log::info('SubjectController@store: '. json_encode($store));
        return redirect()->route('admin.subject.index')->with('success', 'Data has been saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $list = Subject::findOrFail($uuid);
        return view('admin.subject.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'description' => 'nullable',
        ]);

        try {
            $update = Subject::findOrFail($uuid);
            $update->name = $request->name;
            $update->code = $request->code;
            $update->description = $request->description;
            $update->save();
        } catch (\Exception $e) {
            Log::error('SubjectController@update: ' . $e->getMessage());
            return redirect()->route('admin.subject.edit', $uuid)->with('error', $e->getMessage());
        }

        Log::info('SubjectController@update: '. json_encode($update));
        return redirect()->route('admin.subject.index')->with('success', 'Data has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            $delete = Subject::findOrFail($uuid);
            $delete->delete();

        } catch (\Exception $e) {
            Log::error('SubjectController@destroy: ' . $e->getMessage());
            return redirect()->route('admin.subject.index')->with('error', $e->getMessage());
        }
        Log::info('SubjectController@destroy: '. json_encode($delete));
        return redirect()->route('admin.subject.index')->with('success', 'Data has been deleted successfully');
    }
}
