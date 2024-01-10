{include file="header.tpl"}

<div class="container-xxl mb-5 mt-5">
	<a href='/admin/projecten' style='margin-bottom: 2rem'><i class='bi bi-arrow-left'></i> Terug naar overzicht</a>

	<h2 class='mb-3 mt-3'>Afbeeldingen voor '{$project.title}'</h2>

	<nav class="nav nav-tabs mb-3">
	  	<a class="nav-link" href="/admin/projecten/edit/id/{$project.id}">Teksten</a>
	  	<a class="nav-link active" aria-current="page" href="/admin/projecten/assets/id/{$project.id}">Afbeeldingen</a>
	</nav>

	<div class="mb-3">
		<label for="upload" class="form-label">Upload afbeelding</label>
		<input class="form-control" type="file" id="upload" accept=".png,.jpg,.jpeg">
	</div>

	<div id="card-container" class="row mt-5">

		{foreach from=$assets key=akey item=asset}
		<div class="asset-card col-md-3 mb-2">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">{$asset.title}</h5>
				</div>

				<img class="card-img" src="/{$asset.path}" alt="{$asset.title}">

				<div class="card-footer">
					<a href="#" class="card-link" data-delete="{$asset.id}">Verwijder</a>
				</div>
			</div>
		</div>
		{/foreach}
	</div>
</div>

{literal}
<script>
	document.addEventListener('DOMContentLoaded', () => {

		const upload_field = document.querySelector('#upload');
		const card_list = document.querySelector('#card-container');
		const delete_links = document.querySelectorAll('[data-delete]');


		for(var i = 0; i < delete_links.length; i++){
			delete_links[i].addEventListener('click', deleteAsset);
		}


		upload_field.addEventListener('change', function(event){
			var url = '/admin/projecten/upload-asset' //this.closest('form').action;
			var file = this.files[0];

			const xhr = new XMLHttpRequest();
			xhr.open('POST', url, true)
			//xhr.setRequestHeader("Content-Type", "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2));

			xhr.onreadystatechange = () => {
				if(xhr.readyState == 4 && xhr.status == 200) {
					let return_data = JSON.parse(xhr.responseText);

					if(return_data.success){

						let asset_template = `<div class="asset-card col-md-3 mb-2"><div class="card">
							<div class="card-header">
								<h5 class="card-title">${return_data.asset.title}</h5>
							</div>

							<img class="card-img" src="/${return_data.asset.path}" alt="${return_data.asset.title}">

							<div class="card-footer">
								<a href="#" class="card-link" data-delete="${return_data.asset.id}">Verwijder</a>
							</div>
						</div></div>`;

						let element = stringToDOM(asset_template);
							
						element.querySelector('[data-delete]').addEventListener('click', deleteAsset);

						card_list.append(element);

						upload_field.value = '';
					}
					else{
						//show error
						console.error('Upload error', return_data);
					}
				}
			}

			const formData = new FormData();
			formData.append('uploaded_file', file);
			formData.append('project', {/literal}'{$project.id}'{literal});
			formData.append('token', {/literal}'{$token}'{literal});

			xhr.send(formData);

		});
	});

	function deleteAsset(event){
		event.preventDefault();

		var current_element = this;
		var asset_id = current_element.getAttribute('data-delete');
		
		if(asset_id < 1){
			return false;
		}

		var url = '/admin/projecten/delete-asset'

		const xhr = new XMLHttpRequest();
		xhr.open('POST', url, true)
		//xhr.setRequestHeader("Content-Type", "multipart/form-data; charset=utf-8; boundary=" + Math.random().toString().substr(2));

		xhr.onreadystatechange = () => {
			if(xhr.readyState == 4 && xhr.status == 200) {
				let return_data = JSON.parse(xhr.responseText);

				if(return_data.success){
					current_element.closest('.asset-card').remove();
				}
				else{
					//show error
					console.error('delete error', return_data);
				}
			}
		}

		const formData = new FormData();
		formData.append('asset_id', asset_id);
		formData.append('token', {/literal}'{$token}'{literal});

		xhr.send(formData);
	}

	function stringToDOM(html) {
		const template = document.createElement('template');
		template.innerHTML = html;

		var result = template.content.children;

		if (result.length === 1){
			return result[0];
		}
		else{
			return result;
		}

	}

</script>
{/literal}

{include file="footer.tpl"}
