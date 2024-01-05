{include file="header.tpl"}
	<div class="container-xxl mt-5">
		<a href='/' style='margin-bottom: 3rem'><i class='bi bi-arrow-left'></i> Terug naar overzicht</a>
	</div>
	<div class="container-xxl mt-3">
		<h2>{$project.title}</h2>
		<h6 class="mb-3 text-body-secondary">{$project.subtitle}</h6>

		{* afbeeldingen carrousel *}

		<div class="introtext mb-2">
			{$project.introtext}
		</div>

		<div>
			{$project.bodytext}
		</div>
	</div>


	{literal}
	<style>
		.introtext{
			font-weight: bold;
		}
	</style>
	{/literal}
	

{include file="footer.tpl"}
