@component('mail::message')
# Job: {{$job->title}}

{!!$job->description!!}

@component('mail::button', ['url' => url("/jobs/".$job->id)])
View Post
@endcomponent
<p>Your job post is published</p>

Thanks,<br>
{{$user->name}}<br>
from {{ config('app.name') }}
@endcomponent