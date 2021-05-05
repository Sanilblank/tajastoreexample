Hello {{$mailData['name']}}
<br><br>
Welcome To TajaMandi,
<br><br>
Please Click the following link to activate your gmail account.
<br><br>
<a href="http://127.0.0.1:8000/verify?code={{$mailData['verification_code']}}">Click Here!</a>
<br><br>
Regards,<br>
Tajamandi.

