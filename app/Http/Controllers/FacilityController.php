<?php

namespace App\Http\Controllers;

use App\Models\facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facilities = Facility::orderBy('title', 'desc')->get();
        return view('admin.facility.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.facility.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = Storage::put('/', $request->img_url);

        Facility::create([
            'title' => $request->title,
            'content' => $request->content,
            'img_url'=> $path
        ]);

        return redirect()->route('facility.index');
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
    public function edit(string $id)
    {
        $facility = Facility::find($id);

        return view('admin.facility.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $facility = Facility::find($id);

        if ($request->hasFile('img_url')) {
            Storage::delete($request->img_url);

            $path = Storage::put('/', $request->img_url);
        }else{
            $path = $facility->img_url;
        }

        $facility->update([
            'title' => $request->title,
            'content' => $request->content,
            'img_url' => $path
        ]);

        return redirect()->route('facility.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $facility = Facility::find($id);
        Storage::delete($facility->img_url);
        $facility->delete();

        return redirect()->route('facility.index');
    }
}
