<x-mail::message>
# Hi {{$user->first_name}}

You have a new [{{ config('app.name') }}]({{$url}}) account created.

To get started you'll need to create your password.

<x-mail::button :url="$url">
    Create Your Password
</x-mail::button>

Regards,<br>
The {{ config('app.name') }} Team

<hr/>

<small>If you're having trouble clicking the "Create Your Password" button, copy and paste the URL below into your web browser: [{{$url}}]({{$url}})</small>



</x-mail::message>
