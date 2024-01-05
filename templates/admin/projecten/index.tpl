{include file="header.tpl"}

<div class="container-xxl mb-5 mt-5">
	<a href="/admin/projecten/edit" class="btn btn-primary" style='float:right;'>
        <i class="bi bi-plus"></i> Nieuw project
    </a>

	<h2>Projecten</h2>



	<table class="table">
		<thead>
			<tr>
				<th scope="col" width='10px'>Tonen</th>
				<th scope="col">Titel</th>
				<th scope="col" width='10px'>&nbsp;</th>
				<th scope="col" width='10px'>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$projects key=pkey item=project}
			<tr>
				<td>{if $project.is_visible}<i class="bi bi-check-lg"></i>{/if}</td>
				<td><a href='/admin/projecten/edit/id/{$project.id}'>{$project.title}</a></td>
				<td>
					<a href='/admin/projecten/edit/id/{$project.id}'><i class="bi bi-pencil-square"></i></a>
				</td>
				<td>
					<a href='/admin/projecten/delete/id/{$project.id}'><i class="bi bi-trash"></i></a>
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

{include file="footer.tpl"}
