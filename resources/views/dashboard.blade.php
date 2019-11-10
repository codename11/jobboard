@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in, {{$role}}!<br/>

                    @if($role==="job board moderator")
                        Here is a list of yet unapproved job postings:<br/><br/>

                        <div class="flex-container">
                            @foreach ($jobs as $job)

                                <div class="card">

                                    <div class="card-header">Title: {{$job->title}}</div>
                                    <div class="card-body">Description: {{$job->description}}</div>

                                    <div class="card-footer">
                                            Created: {{$job->created_at->diffInDays()." days ago "}} @ {{$job->created_at->format('H:m:s')}}

                                        <form action="/dashboard/{{$job->id}}" method="POST" enctype="multipart/form-data" style="margin-top: 10px;">
                                            @csrf
                                            {{method_field("PUT")}}
                                            <input type="hidden" id="{{"job".$job->id}}" name="{{"job"}}" value="{{$job->id}}" required/>
                                            <div class="form-group">
                                                <select class="form-control" id="{{"sel".$job->id}}" name="{{"status"}}" required>
                                                    <option disabled selected>Approve jobs</option>
                                                    <option value="0">Spam</option>
                                                    <option value="1">Publish</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info"> Approve </button>
                                        </form>

                                    </div>

                                </div>

                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
