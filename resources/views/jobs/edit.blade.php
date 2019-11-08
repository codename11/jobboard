@extends("layouts.app")

@section("content")
    <h1>Update Job Post</h1> 
    <?php /*Pregleda zasebno za title i description 
    da li ima gresaka. Ukoliko ih ima, dodeljuje im klasu(crveni border).*/
        $errTitle = $errors->has('title') ? 'border-danger' : '';
        $errDescription = $errors->has('description') ? 'border-danger' : '';
    ?>
    <form method="POST" action="/jobs/{{$job->id}}" enctype="multipart/form-data">
        @csrf
        {{method_field("PUT")}}
        <!-- https://laravel.com/docs/5.7/validation#available-validation-rules -->
        <div class="form-group">
            <label for="title">Title:</label> <!--Ovo u 'value' atributu da prilikom neuspesne validacije zapamti staru vrednost iz polja.-->
            <input class="form-control {{$errTitle}}" type="text" name="title" placeholder="Post title" required value="{{ old('title',$job->title) }}">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="ckeditor" class="form-control {{$errDescription}}" name="description" placeholder="Description" required value="{{ old('description',$job->description) }}">{{ old('description',$job->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" id="email" required value="{{ old('email',$job->email) }}">
        </div>

        <div>
            <button type="submit" class="btn btn-primary">Update Job</button>
        </div>
    </form>
    
@endsection