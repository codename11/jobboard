@component('mail::message')
# New Post: {{$job->title}}

{!!$job->description!!}

@component('mail::button', ['url' => url("/jobs/".$job->id)])
View Post
@endcomponent
<p>asdasd</p>

Thanks,<br>
{{$user->name}}<br>
from {{ config('app.name') }}
@endcomponent