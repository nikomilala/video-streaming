@extends('base')
@section('konten')
    <main>
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">video</label>
                                <input type="file" class="form-control @error('video') is-invalid @enderror" name="video">

                                <!-- error message untuk title -->
                                @error('video')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JUDUL</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul video">

                                <!-- error message untuk title -->
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-md btn-primary">Upload</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
    </main>
@endsection

