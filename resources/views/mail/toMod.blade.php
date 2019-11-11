@component('mail::message')
# Job: {{$job->title}}<br/>

## Description: {!!$job->description!!}

@component('mail::button', ['url' => url("/dashboard")])
Dashboard
@endcomponent
<p>This job post is awaiting your moderation</p>

<!--<a href="/dashboard/{{$job->id}}/approve" class="btn btn-outline-primary">Approve</a><br/>
<a href="/dashboard/{{$job->id}}/spam" class="btn btn-outline-warning">Spam</a><br/>-->

Thanks,<br>
{{$mod->name}}<br>
from {{ config('app.name') }}
@endcomponent