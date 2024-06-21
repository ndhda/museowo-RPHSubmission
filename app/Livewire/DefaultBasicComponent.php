<?php

namespace App\Livewire;

use App\Models\TestData;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class DefaultBasicComponent extends Component
{
    use WithFileUploads;

    public $uuid, $short_text, $long_text, $file_upload, $image_upload, $file_new, $image_new, $color, $status;

    public function render()
    {
        $lists = TestData::get();
        return view('livewire.default-basic-component', compact('lists'));
    }

    public function store()
    {
        $this->validate([
            'short_text' => 'required|max:255',
            'long_text' => 'nullable',
            'file_upload' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'image_upload' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'required|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $store = new TestData();
            $store->short_text = $this->short_text;
            $store->long_text = $this->long_text;
            if ($this->file_upload) {
                $file = $this->file_upload;
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/uploads', $filename);
                $store->file_upload = 'uploads/' . $filename;
            }
            if ($this->image_upload) {
                $image = $this->image_upload;
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/uploads', $imagename);
                $store->image_upload = 'uploads/' . $imagename;
            }
            $store->color = $this->color;
            $store->status = $this->status;
            $store->save();
        } catch (\Exception $e) {
            Log::error('DefaultBasicComponent@store: ' . $e->getMessage());
            session()->flash('error', $e->getMessage());
            return;
        }
        Log::info('DefaultBasicComponent@store: ' . json_encode($store));
        $this->closeModal('success', 'Data has been saved successfully');
        return;
    }

    public function update()
    {
        $this->validate([
            'short_text' => 'required|max:255',
            'long_text' => 'nullable',
            'file_new' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
            'image_new' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'required|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            $update = TestData::findOrFail($this->uuid);
            $update->short_text = $this->short_text;
            $update->long_text = $this->long_text;
            if ($this->file_new) {
                $file = $this->file_new;
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/uploads', $filename);
                $update->file_upload = 'uploads/' . $filename;
            }
            if ($this->image_new) {
                $image = $this->image_new;
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/uploads', $imagename);
                $update->image_upload = 'uploads/' . $imagename;
            }
            $update->color = $this->color;
            $update->status = $this->status;
            $update->save();
        } catch (\Exception $e) {
            Log::error('DefaultBasicComponent@update: ' . $e->getMessage());
            session()->flash('error', $e->getMessage());
            return;
        }
        Log::info('DefaultBasicComponent@update: ' . json_encode($update));
        $this->closeModal('success', 'Data has been saved successfully');
        return;
    }

    public function delete($id)
    {
        try {
            $delete = TestData::find($id)->delete();
        } catch (\Exception $e) {
            Log::error('DefaultBasicComponent@delete: ' . $e->getMessage());
            session()->flash('error', $e->getMessage());
            return;
        }
        Log::info('DefaultBasicComponent@delete: ' . json_encode($delete));
        $this->closeModal('success', 'Data has been saved successfully');
        return;
    }

    public function openShowModal($id)
    {
        $data = TestData::findOrFail($id);
        $this->uuid = $id;
        $this->short_text = $data->short_text;
        $this->long_text = $data->long_text;
        $this->file_upload = $data->file_upload;
        $this->image_upload = $data->image_upload;
        $this->color = $data->color;
        $this->status = $data->status;
        $this->dispatch('openShowModal');
    }

    public function openEditModal($id)
    {
        $data = TestData::findOrFail($id);
        $this->uuid = $id;
        $this->short_text = $data->short_text;
        $this->long_text = $data->long_text;
        $this->file_upload = $data->file_upload;
        $this->image_upload = $data->image_upload;
        $this->color = $data->color;
        $this->status = $data->status;
        $this->dispatch('openEditModal');
    }

    public function closeModal($type = null, $message = null)
    {
        $this->reset();
        $this->dispatch('closeModal');
        return redirect()->route('livewire-crud.index')->with($type, $message);
    }
}
