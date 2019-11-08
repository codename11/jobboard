@extends("layouts.app")

@section("content")

    
    @if(count($jobs)>0)
        <div class="container">
            <table class="table table-hover table-bordered table-dark table-striped">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Email</th>
                    <th>Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($jobs as $job)
                    <tr data-href="/jobs/{{$job->id}}">
                        <td>{{$job->title}}</td>
                        <td>
                        <?php

                            if(strlen($job->description)>20){
                                $description = substr($job->description,0,20)."<a href='/jobs/{{$job->id}}'>...Read more</a>";
                                echo $description;
                            }
                            else{
                                echo $job->description;
                            }

                        ?>
                        </td>
                        <td>{{$job->email}}</td>
                        <td>{{$job->created_at->format('d/m/Y')}} @ {{$job->created_at->format('H:m:s')}}</td>
                    
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$jobs->links()}}<!--Ovo je za paginaciju.-->
        </div>
        @else
            Jobs: {{count($jobs)}}

    @endif

@endsection