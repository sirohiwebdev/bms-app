<div class="container-fluid mt-4">

<div class="row">
    <div class="col-9 mx-auto">
        <h3 class="text-center">Posts</h3>
        <?php
        if(isset($posts)){
            foreach($posts as $post){
                ?>


                <div class="text-danger my-3" id="error"></div>
				<div class="text-success my-3" id="success"></div>
                <div class="mb-3 p-3 border">

                    <div class="d-flex justify-content-between align-items-center">
                    <h4><?php echo $post['title'] ?></h5>
                    <?php
                    
                    if(isset($view)){
                        ?>
                    <div>
                        <a href="<?php echo base_url().'post/edit/'.$post['id']?>"><button class="btn btn-success btn-sm">Edit</button></a>
                        <button class="btn btn-danger btn-sm" onclick="deletePost('<?php echo $posts[0]['id']; ?>')">Delete</button>
                    </div>
                        <?php
                    }else{
                        ?>
                    <div>
                        <a href="<?php echo base_url().'post/'.$post['id']?>"><button class="btn btn-primary btn-sm">View</button></a>
                    </div>
                        <?php
                    }
                    
                    ?>
                    </div>
                    <div class="text-muted">
                        Created at : <?php echo Date('d, M, Y h:i:s A', strtotime($post['created_at'])) ?>
                    </div>
                    <div class="mt-2">

                    <?php echo $post['short_desc'] ?>

                   
                    </div>

                    <?php if(isset($view)){
                        ?>
                        <div class="mt-4">

                        <h6 class="text-secondary">Description</h6>

                        <?php echo $post['long_desc'] ?>

                        </div>
                        <?php
                    } ?> 

                </div>

                <?php
            }
        }

        ?> 


    </div>
</div>

</div>

<script>

    function deletePost(id){


        let confirmDelete = confirm("Are you sure, you want to delete this post.");

        if(confirmDelete){
            fetch("<?php echo base_url(); ?>post/delete/"+id)
			.then(res => res.json())
			.then(res => {
				if (res.status === "SUCCESS") {
					success.innerText = res.msg;

                    setTimeout(() => {
                        location.href = "<?php echo base_url().'post'; ?>";
                    }, 500);
				}
				if (res.status === "ERROR") {
					error.innerText = res.msg;
				}
			})
			.catch(err => {
				console.log(err);
				error.innerText = "Error Occured, Try again later.";
			});
        }

    }
</script>