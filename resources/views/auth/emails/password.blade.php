<html class="no-js" lang="en">
   <body>
      <div style="width: 90%;background-color: #060b2b;margin: auto;display: flex; font-family: Calibri,sans-serif;">
      <table style="margin:auto;">
      	<tr>
      		<td>
      			<h1 style=" margin-top: 50px;color: white;margin-left: auto;margin-right: auto; text-align:center;">Vous avez reçu une nouvelle notification!</h1>
      		</td>
      	</tr>
      	<tr>
      		<td>
      			<div style="width: 80%;padding-top: 50px;padding-bottom: 50px;margin-top: 50px;background-color: #222;margin-left: auto;margin-right: auto;display: flex;">
      			<p style="color:white;margin: auto;text-align: center;">Click here to reset your password: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a></p>
      			</div>
      		</td>
      	</tr>
      </table>
      </div>
   </body>
</html>
