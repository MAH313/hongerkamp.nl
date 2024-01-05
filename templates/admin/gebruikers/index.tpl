{include file="header.tpl"}

<div class="container-xxl mb-5 mt-5">
	<a href="/admin/gebruikers/edit" class="btn btn-primary" style='float:right;'>
        <i class="bi bi-plus"></i> Nieuwe gebruiker
    </a>

	<h2>Gebruikers</h2>

	<table class="table">
		<thead>
			<tr>
				<th scope="col">Naam</th>
				<th scope="col">Email</th>
				<th scope="col" width='10px'>&nbsp;</th>
				<th scope="col" width='10px'>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			{foreach from=$users key=ukey item=user}
			<tr>
				<td><a href='/admin/gebruikers/edit/id/{$user.id}'>{$user.username}</a></td>
				<td>{$user.email}</td>
				<td>
					<a href='/admin/gebruikers/edit/id/{$user.id}'><i class="bi bi-pencil-square"></i></a>
				</td>
				<td>
					<a href='/admin/gebruikers/delete/id/{$user.id}'><i class="bi bi-trash"></i></a>
				</td>
			</tr>
			{/foreach}
		</tbody>
	</table>
</div>

{include file="footer.tpl"}
