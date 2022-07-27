<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;

class GalleriesController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return response()->json($galleries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $data = $request->validated();
        $data['images_url'] = serialize($data['images_url']);
        $gallery = Gallery::create($data);
        return response()->json($gallery);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $gallery['images_url'] = unserialize($gallery['images_url']);
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        $gallery->update($data);

        return response()->json($gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response(null, 204);
    }
}
