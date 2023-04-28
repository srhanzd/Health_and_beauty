{{--Change your password  <a href="http://localhost:3000/reset/{{$token}}">here</a>--}}
{{--The code to change your password is ({{$token}})--}}
<h1>We have received your request to reset your account password</h1>
    <p>Please enter the code below in your password reset page:</p>

        {{ $token }}

    <p>The allowed duration of the code is one hour from the time the message was sent.</p>
