@extends('base')
@section('konten')
    <main>
        @forelse ($videos as $video)
            <div class="container pt-3">
                <div class="text-center">
                    <h2>{{$video->title}}</h2>


                    <form  onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('video.destroy', $video->id) }}"
                           method="POST">
                        <a href="{{ route('video.edit', $video->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                    </form>
                </div> <br>





                <!-- 21:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-21by9">
                    <iframe class="embed-responsive-item" src="{{ Storage::url('public/videos/').$video->video }}"></iframe>
                </div>

                @empty
                    <div class="alert alert-danger">
                        Data video belum Tersedia.
                    </div>

            </div>
            <hr class="col-3 col-md-2 mb-5">

        @endforelse


    </main>
@endsection
