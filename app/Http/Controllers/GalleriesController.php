<?php

 namespace App\Http\Controllers;

 use App\Models\Gallery;
 use App\Http\Requests\CreateGalleryRequest;
 use App\Http\Requests\UpdateGalleryRequest;
 use Illuminate\Http\Request;
 use Illuminate\Http\Response;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Auth\Access\Gate;

 class GalleryController extends Controller
 {
     public function index(Request $request)
     {
        $author = $request->input('author');

        $galleries = Gallery::with(['firstImage', 'user']);

        if ($author) {
            $galleries->whereUserId($author);
        };

        $filter = $request->input('filter');

        $galleries->where(function ($query) use ($filter) {
            return $query
                ->orWhereName($filter)
                ->orWhereDescription($filter)
                ->orWhereUserName($filter);
        });

        return response()->json($galleries->latest()->paginate(10));
     }

     public function store(CreateGalleryRequest $request)
     {

     $validated = $request->validated();

     $newGallery = new Gallery($validated);
     $newGallery->user()->associate(Auth::user());
     $newGallery->save();

     foreach ($validated['url'] as $url) {
         $newUrlArray[] = ['url' => $url];
     };
     $newGallery->images()->createMany($newUrlArray);

     return response()->json($newGallery);
 }

 public function show(Gallery $gallery)
 {
     $gallery->load(['images', 'user', 'comments.user'])->get();

     return response()->json($gallery);
 }

 public function update(UpdateGalleryRequest $request, Gallery $gallery)
 {
     Gate::authorize('update', $gallery);

     $validated = $request->validated();

     $gallery->update($validated);

     $gallery->images()->delete();

     foreach ($validated['url'] as $url) {
         $newUrlArray[] = ['url' => $url];
     };
     $gallery->images()->createMany($newUrlArray);

     return response()->json($gallery);
 }

 public function destroy(Gallery $gallery)
 {
     Gate::authorize('delete', $gallery);

     $gallery->delete();
     return response($gallery);
 }
}