{include file="header.tpl"}

<div class="container-xxl mb-5 mt-5">
	<a href='/admin/gebruikers' style='margin-bottom: 2rem'><i class='bi bi-arrow-left'></i> Terug naar overzicht</a>

	<h2 class='mb-3 mt-3'>{if $user}Bewerk '{$user.username}'{else}Nieuwe gebruiker{/if}</h2>


	<form method='POST' action='/{$smarty.get.uri}'>
		<input type='hidden' name='token' value='{$token}'>


		<div class="mb-3">
			<label for="username" class="form-label">Naam</label>
			<input type="text" class="form-control" id="username" name='username' required{if $user} value='{$user.username}'{/if}>
		</div>

		<div class="mb-3">
			<label for="email" class="form-label">Email</label>
			<input type="text" class="form-control" id="email" name='email'{if $user} value='{$user.email}'{/if}>
		</div>

		<div class="mb-3">
			<label for="password" class="form-label">Wachtwoord</label>
			<input type="password" class="form-control" id="password" name='password' aria-describedby="passwordHelp">
			<div id="passwordHelp" class="form-text">Laat leeg als je niet het wachtwoord wil aanpassen</div>
		</div>
		
		
		<button type="submit" class="btn btn-primary">Opslaan</button>
		<a href='/admin/gebruikers' class="btn btn-secondary">Annuleren</a>
	</form>
</div>

{include file="footer.tpl"}
