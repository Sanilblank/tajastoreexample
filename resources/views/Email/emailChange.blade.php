Hello {{$mailData['name']}}
<br><br>
Welcome To TajaMandi,
<br><br>
We have received a request to change your email address.<br>
Please Click the following link to change your email account.
<br><br>
<a href="http://127.0.0.1:8000/useremailchange?code={{$mailData['verification_code']}}">Click Here!</a>
<br><br>
Regards,<br>
Tajamandi.
