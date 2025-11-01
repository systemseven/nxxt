<x-mail::message>
# Hi {{$user->first_name}}

You have a new [{{ config('app.name') }}]({{$url}}) account created.

To get started you'll need to set your password and login.

<x-mail::button :url="$url">
    Set Your Password
</x-mail::button>


<hr/>

<small>If you're having trouble clicking the "Set Your Password" button, copy and paste the URL below into your web browser: [{{$url}}]({{$url}})</small>
</x-mail::message>
