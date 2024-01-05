{include file="header.tpl"}

<div class="container-xxl mb-5 mt-5">

	<h2 class='mb-3 mt-3'>Inloggen</h2>


	<form method='POST' action='/{$smarty.get.uri}'>


		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="text" class="form-control" id="email" name='email'>
		</div>

		<div class="mb-3">
			<label for="password" class="form-label">Wachtwoord</label>
			<input type="password" class="form-control" id="password" name='password'>
		</div>
		
		
		<button type="submit" class="btn btn-primary">Log in</button>
	</form>
</div>

{include file="footer.tpl"}
