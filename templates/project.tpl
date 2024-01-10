{include file="header.tpl"}

{if !$project}
<div class="container-xxl mt-3">
	<h2>Dit project is niet (meer) beschikbaar</h2>
	<h6 class="mb-3 text-body-secondary">Helaas</h6>

	{* afbeeldingen carrousel *}

	<div class="introtext mb-2">
		<p>
			Bekijk mijn andere projecten op de homepage
		</p>

		<a href='/' style='margin-bottom: 3rem'><i class='bi bi-arrow-left'></i> Terug naar het overzicht</a>
	</div>
</div>
{else}

<div class="container-xxl mt-5">
	<a href='/' style='margin-bottom: 3rem'><i class='bi bi-arrow-left'></i> Terug naar het overzicht</a>
</div>

<div class="container-xxl mt-3">
	<h2>{$project.title}</h2>
	<h6 class="mb-3 text-body-secondary">{$project.subtitle}</h6>

	{if $project.assets}
	<div id="images" class="carousel slide carousel-dark" data-bs-ride="true">
		<div class="carousel-indicators">
			{foreach from=$project.assets key=pakey item=asset name=project_assets}
			<button type="button" data-bs-target="#images" data-bs-slide-to="{$pakey}"{if $smarty.foreach.project_assets.first} class="active" aria-current="true"{/if}></button>
			{/foreach}
		</div>


		<div class="carousel-inner">

			{foreach from=$project.assets key=pakey item=asset name=project_assets}
			<div class="carousel-item{if $smarty.foreach.project_assets.first} active{/if}">
				<img class="d-block w-100" src="/{$asset.path}" alt="{$asset.title}">
			</div>
			{/foreach}

		</div>
		<button class="carousel-control-prev" type="button" data-bs-target="#images" data-bs-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Previous</span>
		</button>
		<button class="carousel-control-next" type="button" data-bs-target="#images" data-bs-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="visually-hidden">Next</span>
		</button>
	</div>
	{/if}

	{* <h2>{$project.title}</h2>
	<h6 class="mb-3 text-body-secondary">{$project.subtitle}</h6> *}


	<div class="introtext mb-2 mt-3">
		{$project.introtext}
	</div>

	<div>
		{$project.bodytext}
	</div>

	{if $project.links}
	<div class='mt-3'>
		<h4>Links</h4>

		<ul class="list-group">
			{foreach from=$project.links item=url key=label}
			<li class="list-group-item"><a href='{$url}' target="_blank">{$label}</a></li>
			{/foreach}
		</ul>
	</div>
	{/if}
</div>


{literal}
<style>
	.introtext{
		font-weight: bold;
	}

	.carousel .carousel-item img {
		max-height: 768px;
		min-width: auto;
	}

</style>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		const carousel = new bootstrap.Carousel('#images')
	});

</script>
{/literal}
{/if}


{include file="footer.tpl"}
