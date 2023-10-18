<x-mail::message>
# Contact us message

<p>Name: {{ $data['name']}}</p>
<p>Email: {{ $data['email']}}</p>
<p>Phone: {{ $data['phone']}}</p>
<p>Message: {{ $data['message']}}</p>

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
