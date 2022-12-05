@foreach(['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'] as $alert)
@if(Session::has($alert))
    <div class="col-md-12 text-center">
        <div class="alert alert-{{$alert}}" role="alert">
            {{session()->get($alert)}}
        </div>
    </div>
@endif
@endforeach
