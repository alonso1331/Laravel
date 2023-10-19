<?php

namespace App\Http\Controllers;


use App\Models\StoreArea;
use Illuminate\Http\Request;

class StoreAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storeAreas = StoreArea::orderBy('created_at', 'desc')->get();

        return view('admin.store-area.index', compact('storeAreas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.store-area.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        StoreArea::create($request->all());

        return redirect()
        ->route('store-areas.index')
        ->with([
            'message' => '區域新增成功!!',
            'color' => 'alert-success'
        ]);
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
        $storeArea = StoreArea::find($id);

        return view('admin.store-area.edit', compact('storeArea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        StoreArea::find($id)->update($request->all());

        return redirect()
        ->route('store-areas.index')
        ->with([
            'message'=>'區域更新成功!!',
            'color'=>'alert-success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $storeArea = StoreArea::with('stores')->find($id);

        if($storeArea->stores->count()){
            return redirect()
            ->route('store-areas.index')
            ->with([
                'message' => '目前'.$storeArea->name.'類別尚有'.$storeArea->stores->count().'門市使用中，如欲刪除，請修改所屬門市的區域',
                'color' => 'alert-danger'
            ]);
        }

        $storeArea->delete();
        return redirect()
        ->route('store-areas.index')
        ->with([
            'message' => '區域刪除成功!!',
            'color' => 'alert-success'
        ]);
    }
}
