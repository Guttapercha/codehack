<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $photos = Photo::all();
        return view('admin.media.create', compact('photos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $photo = Photo::create(['file' => $name]);

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        $file = $photo->file;

        unlink(public_path() . $photo->file);
        $photo->delete();

        Session::flash('deleted_photo', 'The photo "' . $file . '" has been deleted');

        return redirect('/admin/media');
    }

    public function deleteMedia(Request $request)
    {
        if (isset($request->delete_single)) {
            $this->destroy($request->photo);
            unlink(public_path(). $request->photo->file);
            return redirect()->back();
        }
        if (isset($request->delete_all) && !empty($request->checkBoxArray)) {
            $photos = Photo::findOrFail($request->checkBoxArray);

            foreach ($photos as $photo) {
                $photo->delete();
                unlink(public_path(). $photo->file);
            }
            return redirect()->back();
        } else {
            return redirect()->back();
        }

    }

}
