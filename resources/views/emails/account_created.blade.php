Hi {{$user->name}}

<p>Your account has been created by the admin. </p>
<p>Username - {{$user->username}}</p>
<p>Temp Password - {{$password}}</p>

This is temp password, you can change your password by loggin in inside dashboard.
<p>Username - {{$user->email}}</p>

<p><a href="{!! config('app.url') !!}/login">Click here</a> to continue.</p>

<p>Regards,</p>
<p>Team Mesa</p>