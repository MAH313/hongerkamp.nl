{include file="header.tpl"}

<div class="container-xxl mb-5 mt-5">
	<a href='/admin/projecten' style='margin-bottom: 2rem'><i class='bi bi-arrow-left'></i> Terug naar overzicht</a>

	<h2 class='mb-3 mt-3'>{if $project}Teksten voor '{$project.title}'{else}Nieuw project{/if}</h2>

	<nav class="nav nav-tabs mb-3">
	  	<a class="nav-link active" aria-current="page" href="/admin/projecten/edit/id/{$project.id}">Teksten</a>
	  	<a class="nav-link" href="/admin/projecten/assets/id/{$project.id}">Afbeeldingen</a>
	</nav>

	<form method='POST' action='/{$smarty.get.uri}'>
		<input type='hidden' name='token' value='{$token}'>

		<div class="mb-3 form-check">
			<input type="hidden" name='is_visible' value='0'>
			<input type="checkbox" class="form-check-input" id="is_visible" name='is_visible' value='1'{if $project && $project.is_visible == 1} checked{/if}>
			<label class="form-check-label" for="is_visible">Tonen</label>
		</div>

		<div class="mb-3">
			<label for="title" class="form-label">Titel</label>
			<input type="text" class="form-control" id="title" name='title' required{if $project} value='{$project.title}'{/if}>
		</div>

		<div class="mb-3">
			<label for="subtitle" class="form-label">Onder titel</label>
			<input type="text" class="form-control" id="subtitle" name='subtitle'{if $project} value='{$project.subtitle}'{/if}>
		</div>

		<div class="mb-3">
			<label for="introtext" class="form-label">Intro text</label>
			<textarea class="form-control" id="introtext" name='introtext'>{if $project}{$project.introtext}{/if}</textarea>
		</div>

		<div class="mb-3">
			<label for="bodytext" class="form-label">Vervolg text</label>
			<textarea class="form-control" id="bodytext" name='bodytext'>{if $project}{$project.bodytext}{/if}</textarea>
		</div>

		<div class="mb-3">
			<label for="links" class="form-label">Linkjes</label>
			<input type="text" class="form-control" id="links" name='links'{if $project} value='{$project.links}'{/if}>
		</div>
		
		<button type="submit" class="btn btn-primary">Opslaan</button>
		<a href='/admin/projecten' class="btn btn-secondary">Annuleren</a>
	</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
	ClassicEditor.create( document.querySelector( '#bodytext' ) )
    			 .catch( error => { console.error( error ); });
});


</script>

{include file="footer.tpl"}
