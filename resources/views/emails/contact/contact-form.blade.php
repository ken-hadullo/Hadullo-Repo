@component('mail::message')
# Message from UASU TUM 

<p><b>Name</b>:{{ $data['name'] }}</p>
<p><b>Email</b>:{{ $data['email'] }}</p>
<p><b>Mobile No</b>:{{ $data['mobile'] }}</p>
<p><b>Subject</b>:{{ $data['subject'] }}</p>
<p><b>Message</b>:{{ $data['message'] }}</p>
@endcomponent

