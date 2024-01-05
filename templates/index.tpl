{include file="header.tpl"}

	<div class='container-fluid mb-5 introduction'>
		<div class="container-xxl">
			<h2>Welkom!</h2>

			<div>
				Ik ben Mark, in mijn dagelijks leven webdeveloper en zo af en toe maak ik wat in mijn vrije tijd. Dat plaats ik hier.
			</div>
		</div>
	</div>


	<div class="container-xxl mb-5">
		<h2>Projecten</h2>

		<div class="row mt-5">

			{foreach from=$projecten key=pkey item=project}

			<div class="col-md-3 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">{$project.title}</h5>
						<h6 class="card-subtitle mb-2 text-body-secondary">{$project.subtitle}</h6>
						<small class="text-muted">Laatst bijgewerkt: {if $project.modified}{$project.modified|date_format:'d-m-Y'}{else}{$project.created|date_format:'d-m-Y'}{/if}</small>
						<p class="card-text">{$project.introtext}</p>

						<a href="/project/id/{$project.id}" class="card-link">Lees meer</a>
					</div>
				</div>
			</div>

			{/foreach}

			{* <div class="col-md-3 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Markbot</h5>
						<h6 class="card-subtitle mb-2 text-body-secondary">Een bot voor Discord</h6>
						<p class="card-text">De populaire communicatie app Discord bied de mogelijkheid om je eigen scripts (bots) toe te voegen aan je server. In 2019 heb ik hier mee geexperimenteerd.</p>
						<a href="#" class="card-link">Lees meer</a>
					</div>
				</div>
			</div>

			<div class="col-md-3 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Markbot</h5>
						<h6 class="card-subtitle mb-2 text-body-secondary">Een bot voor Discord</h6>
						<p class="card-text">De populaire communicatie app Discord bied de mogelijkheid om je eigen scripts (bots) toe te voegen aan je server. In 2019 heb ik hier mee geexperimenteerd.</p>
						<a href="#" class="card-link">Lees meer</a>
					</div>
				</div>
			</div>

			<div class="col-md-3 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Markbot</h5>
						<h6 class="card-subtitle mb-2 text-body-secondary">Een bot voor Discord</h6>
						<p class="card-text">De populaire communicatie app Discord bied de mogelijkheid om je eigen scripts (bots) toe te voegen aan je server. In 2019 heb ik hier mee geexperimenteerd.</p>
						<a href="#" class="card-link">Lees meer</a>
					</div>
				</div>
			</div>

			<div class="col-md-3 mb-2">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Markbot</h5>
						<h6 class="card-subtitle mb-2 text-body-secondary">Een bot voor Discord</h6>
						<p class="card-text">De populaire communicatie app Discord bied de mogelijkheid om je eigen scripts (bots) toe te voegen aan je server. In 2019 heb ik hier mee geexperimenteerd.</p>
						<a href="#" class="card-link">Lees meer</a>
					</div>
				</div>
			</div> *}

		</div>
	</div>

{include file="footer.tpl"}
