@if(session()->has('msg'))
    <script>
        window.addEventListener('load', function () {
            toastr['{{session('type')}}']('', '{!! session('msg') !!}');
        });
    </script>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

