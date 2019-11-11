@component('mail::message')
# Job: {{$job->title}}<br/>

## Description: {!!$job->description!!}

@component('mail::button', ['url' => url("/dashboard")])
Dashboard
@endcomponent
<p>This job post is awaiting your moderation</p>

<div class="btnWrap">
    <a href="http://jobboard.test/dashboard/{{$job->id}}/approve"><button>Approve</button></a>
    <a href="http://jobboard.test/dashboard/{{$job->id}}/spam"><button>Spam</button></a>
</div>

Thanks,<br>
{{$mod->name}}<br>
from {{ config('app.name') }}
@endcomponent