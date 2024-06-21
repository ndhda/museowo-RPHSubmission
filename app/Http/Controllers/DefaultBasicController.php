<?php

namespace App\Http\Controllers;

use App\Models\TestData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DefaultBasicController extends Controller
{
    public function index()
    {
        $lists = TestData::get();
        return view('basic-crud.index', compact('lists'));
    }

    public function create()
    {
        return view('basic-crud.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'short_text' => 'required|max:255',
            'long_text' => 'nullable',
            'file_upload' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'image_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'required|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $store = new TestData();
            $store->short_text = $request->short_text;
            $store->long_text = $request->long_text;
            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $store->file_upload = 'uploads/' . $filename;
            }
            if ($request->hasFile('image_upload')) {
                $image = $request->file('image_upload');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imagename);
                $store->image_upload = 'uploads/' . $imagename;
            }
            $store->color = $request->color;
            $store->status = $request->status;
            $store->save();
        } catch (\Exception $e) {
            Log::error('DefaultBasicController@store: ' . $e->getMessage());
            return redirect()->route('basic-crud.create')->with('error', $e->getMessage());
        }
        Log::info('DefaultBasicController@store: '. json_encode($store));
        return redirect()->route('basic-crud.index')->with('success', 'Data has been saved successfully');
    }

    public function show($uuid)
    {
        $list = TestData::findOrFail($uuid);
        return view('basic-crud.show', compact('list'));
    }

    public function edit($uuid)
    {
        $list = TestData::findOrFail($uuid);
        return view('basic-crud.edit', compact('list'));
    }

    public function update(Request $request, $uuid)
    {
        $request->validate([
            'short_text' => 'required|max:255',
            'long_text' => 'nullable',
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'required|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $update = TestData::findOrFail($uuid);
            $update->short_text = $request->short_text;
            $update->long_text = $request->long_text;
            if ($request->hasFile('file_upload')) {
                $file = $request->file('file_upload');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
                $update->file_upload = 'uploads/' . $filename;
            }
            if ($request->hasFile('image_upload')) {
                $image = $request->file('image_upload');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads'), $imagename);
                $update->image_upload = 'uploads/' . $imagename;
            }
            $update->color = $request->color;
            $update->status = $request->status;
            $update->save();
        } catch (\Exception $e) {
            Log::error('DefaultBasicController@update: ' . $e->getMessage());
            return redirect()->route('basic-crud.edit', $uuid)->with('error', $e->getMessage());
        }

        Log::info('DefaultBasicController@update: '. json_encode($update));
        return redirect()->route('basic-crud.index')->with('success', 'Data has been updated successfully');
    }

    public function destroy($uuid)
    {
        try {
            $delete = TestData::findOrFail($uuid);
            $delete->delete();

        } catch (\Exception $e) {
            Log::error('DefaultBasicController@destroy: ' . $e->getMessage());
            return redirect()->route('basic-crud.index')->with('error', $e->getMessage());
        }
        Log::info('DefaultBasicController@destroy: '. json_encode($delete));
        return redirect()->route('basic-crud.index')->with('success', 'Data has been deleted successfully');
    }
}
