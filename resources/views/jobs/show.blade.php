@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="card">
            <div class="card-header">Title: {{$jobx->title}}</div>
            <div class="card-body">Description: {!!$jobx->description!!}</div> 
            <div class="card-footer">
                Created at: {{$jobx->created_at->format('d/m/Y')}} @ {{$jobx->created_at->format('H:m:s')}}
            <br/>
                @if(!Auth::guest())
                    @if(Auth::user()->id == $jobx->user_id)
                        <a href="/jobs/{{$jobx->id}}/edit" class="btn btn-primary">Edit</a>
                        <!--Method 'spoofing' jer nema metoda 'delete'.-->
                        <form class="float-right" action="/jobs/{{$jobx->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{method_field("DELETE")}}
                            <button type="submit" class="btn btn-danger"> Delete </button>
                        </form>
                        <!--Jednostruke viticaste zagrade za close.-->
                    @endif
                @endif
            </div>
        </div>
    </div>

@endsection