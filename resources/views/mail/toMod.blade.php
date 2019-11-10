@component('mail::message')
# Job: {{$job->title}}<br/>

## Description: {!!$job->description!!}

@component('mail::button', ['url' => url("/dashboard")])
Dashboard
@endcomponent
<p>This job post is awaiting your moderation</p>

Thanks,<br>
{{$mod->name}}<br>
from {{ config('app.name') }}
@endcomponent