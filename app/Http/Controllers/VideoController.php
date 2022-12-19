<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    //
    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return view('video.index', compact('videos'));
    }

    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        return view('video.create');
    }


    /**
    * store
    *
    * @param  mixed $request
    * @return void
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'video'     => 'required|file|mimetypes:video/mp4',
            'title'     => 'required',
        ]);

        //upload image
        $video = $request->file('video');
        $video->storeAs('public/videos', $video->hashName());

        $video = Video::create([
            'video'     => $video->hashName(),
            'title'     => $request->title,
        ]);

        if($video){
            //redirect dengan pesan sukses
            return redirect()->route('video.index')->with(['success' => 'Video Berhasil Diupload!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('video.index')->with(['error' => 'video Gagal Diupload!']);
        }
    }
    /**
    * edit
    *
    * @param  mixed $video
    * @return void
    */
    public function edit(Video $video)
    {
        return view('video.edit', compact('video'));
    }


    /**
    * update
    *
    * @param  mixed $request
    * @param  mixed $video
    * @return void
    */
    public function update(Request $request, Video $video)
    {
        $this->validate($request, [
            'title'     => 'required',
        ]);

        //get data video by ID
        $video = Video::findOrFail($video->id);

        if($request->file('video') == "") {

            $video->update([
                'title'     => $request->title,
            ]);

        } else {

            //hapus old video
            Storage::disk('local')->delete('public/videos/'.$video->video);

            //upload new video
            $video = $request->file('video');
            $video->storeAs('public/videos', $video->hashName());

            $video->update([
                'video'     => $video->hashName(),
                'title'     => $request->title,
            ]);

        }

        if($video){
            //redirect dengan pesan sukses
            return redirect()->route('video.index')->with(['success' => 'video Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('video.index')->with(['error' => 'video Gagal Diupdate!']);
        }
    }
    /**
    * destroy
    *
    * @param  mixed $id
    * @return void
    */
    public function destroy($id)
    {
    $video = Video::findOrFail($id);
    Storage::disk('local')->delete('public/videos/'.$video->video);
    $video->delete();

    if($video){
        //redirect dengan pesan sukses
        return redirect()->route('video.index')->with(['success' => 'video Berhasil Dihapus!']);
    }else{
        //redirect dengan pesan error
        return redirect()->route('video.index')->with(['error' => 'video Gagal Dihapus!']);
    }
    }

}
