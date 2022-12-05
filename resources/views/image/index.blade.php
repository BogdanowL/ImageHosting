@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{route('create')}}" class="btn btn-primary btn-lg mb-5 mt-3"> <h1>Загрузить</h1> </a>
            <table class="table mt -3">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col"><a type="button" class="btn btn-primary" href="{{route('sort.name')}}">Name</a> </th>
                    <th scope="col"><a type="button" class="btn btn-primary" href="{{route('sort.time')}}">Time</a></th>
                    <th scope="col">Time ago</th>
                    <th scope="col">Preview</th>
                </tr>
                </thead>
                <tbody>
                @foreach($images as $image)
                    <tr>
                    <th scope="row">{{$image->id}}</th>
                    <td>{{$image->getClientName()}}</td>
                    <td>{{$image->created_at}}</td>
                    <td>{{$image->created_at->diffForHumans()}}</td>
                    <td>
                        <a href="{{$image->getImage()}}" data-fancybox="gallery" data-caption="Optional caption">
                            <img src="{{$image->getThumbnailImage()}}" class="img-thumbnail" alt="..." >
                        </a>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
