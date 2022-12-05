@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Загрузка файла</h3>

            <form class="mt-5 form-file" method="POST" action="{{route('store')}}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <div class="mb-3">
                        <label for="coverImage" class="form-label">Multiple files input example</label>
                        <input class="form-control @error('images') is-invalid @enderror" name="images[]" type="file" id="coverImage" multiple>
                    </div>
                    @error('images')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>



        </div>
    </div>
</div>
@endsection
