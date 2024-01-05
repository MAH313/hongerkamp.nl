<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Mark Hongerkamp</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>

	<nav class="navbar navbar-dark navbar-expand-lg">
		<div class="container-xxl">
			<a class="navbar-brand" href="/">
				{* <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> *}
				Mark Hongerkamp
			</a>

			{if $active_user}

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link{if $active_nav == 'projecten'} active{/if}" href="/admin/projecten">Projecten</a>
					</li>
					<li class="nav-item">
						<a class="nav-link{if $active_nav == 'gebruikers'} active{/if}" href="/admin/gebruikers">Gebruikers</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/logout">Uitloggen</a>
					</li>
					{* <li class="nav-item">
						<span class="navbar-text">Ingelogd als {$active_user.username}</span>
					</li> *}
				</ul>

			</div>
			{/if}

		</div>
	</nav>