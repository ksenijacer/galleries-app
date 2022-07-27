<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\User;

class GalleriesController extends Controller
{
    public function index(Request $request)
    {   
        $pageSize = $request->query('PAGE_SIZE', 10);
        $userId = $request->query('userId', '0');
        $term = $request->query('term', '');
        $galleries = Gallery::searchByTerm($term, $userId)->latest()->paginate($pageSize);

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
        $user = User::find(auth()->id());
        $gallery = $user->galleries()->create($data);
        // $gallery->images()->saveMany($request->input('images'));
        foreach ($request->input('images') as $key => $data) {
            $gallery->images()->create($data);
        }
        return $gallery;
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
        $gallery->update($request->except('images'));
        $gallery->images()->delete();
        foreach ($request->input('images') as $value) {
            unset($value['created_at']);
            unset($value['updated_at']);
            $gallery->images()->updateOrCreate($value);
        }

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
