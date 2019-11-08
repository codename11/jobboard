@component('mail::message')
# New Post: {{$job->title}}

{!!$job->description!!}

@component('mail::button', ['url' => url("/jobs/".$job->id)])
View Post
@endcomponent
<button>trt</button>

Thanks,<br>
{{$user->name}} you have {{$jobCount}}<br>
from {{ config('app.name') }}<br>

@endcomponent