<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-6 mx-auto p-3">
			<h3 class="text-center">Edit Posts</h3>

			<form action="" onsubmit="return submitForm()" class="form">
				<div class="text-danger my-3" id="error"></div>
				<div class="text-success my-3" id="success"></div>
				<div class="form-group">
					<label for="title">Title</label>
					<input
						type="text"
						class="form-control"
						id="title"
						name="title"
						value="<?php echo $posts[0]['title'] ?>"
						placeholder="Title"
						required
					/>
				</div>

				<div class="form-group">
					<label for="shortdesc">Short Description</label>
					<input
						class="form-control"
						id="shortdesc"
						maxlenght="50"
						value="<?php echo $posts[0]['short_desc'] ?>"
						placeholder="Short description"
						required
					/>
				</div>

				<div class="form-group">
					<label for="body">Long Description</label>
					<input
						row="8"
						class="form-control"
						id="body"
						name="body"
						placeholder="Long description"
						value="<?php echo $posts[0]['long_desc'] ?>"
						required
					/>
				</div>

				<div class="form-group text-right">
					<button type="submit" class="btn btn-success">Save</button>

					<a href="<?php echo base_url().'post/'.$posts[0]['id']; ?>"
						><button type="button" class="btn btn-light">Cancel</button></a
					>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	let error = document.getElementById("error");
	let success = document.getElementById("success");
	function submitForm() {

		error.innerText = "";
		success.innerText = "";
		let formdata = new FormData();

		let title = document.getElementById("title").value;
		let shortDesc = document.getElementById("shortdesc").value;
		let longDesc = document.getElementById("body").value;

		formdata.append("title", title);
		formdata.append("short_desc", shortDesc);
		formdata.append("long_desc", longDesc);

		fetch("<?php echo base_url(); ?>post/edit/<?php echo $posts[0]['id'] ?>", {
			method: "POST",
			body: formdata
		})
			.then(res => res.json())
			.then(res => {
				if (res.status === "SUCCESS") {
					success.innerText = res.msg;
					setTimeout(() => {
						location.reload();
					}, 1000);
				}
				if (res.status === "ERROR") {
					error.innerText = res.msg;
				}
			})
			.catch(err => {
				console.log(err);
				error.innerText = "Error Occured, Try again later.";
			});
		return false;
	}
</script>
