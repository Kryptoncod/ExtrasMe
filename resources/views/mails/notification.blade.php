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
      			<p style="color:white;margin: auto;text-align: center;">{{$notification}}</p>
      			      	</div>
      		</td>
      	</tr>
      	<tr >
      		<td>
      			<div style="margin-top: 50px;margin-bottom: 50px; display: flex;">
      				<a href="{{ route('home', $user->id) }}" style="margin-left: auto;margin-right: auto;color: white;padding:15px;background-color: #0E0E0E; text-decoration: none;">Accéder à mon compte</a>
      			</div>
      		</td>
      	</tr>
      </table>
      </div>
   </body>
</html>