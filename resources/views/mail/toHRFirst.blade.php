@component('mail::message')
# Job: {{$job->title}}

{!!$job->description!!}

@component('mail::button', ['url' => url("/jobs/".$job->id)])
View Job Post
@endcomponent
<p>Your job post is under moderation</p>

<p>Your first {{$jobCount}} {{$jobCount===1 ? "job is" : "jobs are"}}{{" awaiting moderation"}}</p>

Thanks,<br>
{{$user->name}}<br>
from {{ config('app.name') }}
@endcomponent