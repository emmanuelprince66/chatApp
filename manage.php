<?php
require_once 'asset/php/header.php'
?>
<div class="container">
    <h2 class="text-capitalize text-center p-5 tr">Here you can manage your posts.</h2>

    <?php if (isset($cid)) : ?>
    <div class="table-responsive" id="managePosts">

    </div>
    <?php else : ?>
    <a href="login.php">Login here!</a>
    <div class="alert alert-danger mt-2"><strong class="text-center">Please log in to Manage Your Posts.</strong></div>
    <?php endif; ?>

    <!-- start Edit Note Modal--->
    <div class="modal fade" id="editPostModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-light">Edit Post</h4>
                    <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="edit-post-form" class="px-3" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="img">Change Anime Image..</label>
                            <input type="file" name="img">
                        </div>
                        <div class="form-group">
                            <input type="text" name="title" id="title" class="form-control form-contol-lg"
                                placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <textarea name="descript" id="descript" rows="6" class="form-control form-control-lg"
                                placeholder="Write Your Post Here..." required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="editPost" id="editPostBtn" value="Update Post"
                                class="btn btn-info btn-block btn-lg">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end Edit Note Modal--->

    <!--bootstrap jquery-->
    <script src="asset/js/jquery-3.5.1.min.js"></script>
    <!--bootstrap js-->
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <!--font awesome-->
    <script src="asset/js/all.js"></script>
    <script type="text/javascript" src="asset/DataTables/datatables.min.js"></script>
    <script src="asset/js/all.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        displayAllPosts();

        //Display All Posts  Of The User
        function displayAllPosts() {
            $.ajax({
                url: 'asset/php/process.php',
                method: 'post',
                data: {
                    action: 'display_mPosts'
                },
                success: function(response) {
                    // console.log(response);
                    $("#managePosts").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        //display post details ajax request
        $("body").on('click', '.infoBtn', function(e) {
            e.preventDefault();

            info_id = $(this).attr('id');
            $.ajax({
                url: 'asset/php/process.php',
                method: 'post',
                data: {
                    info_id: info_id
                },
                success: function(response) {
                    data = JSON.parse(response);
                    swal.fire({
                        title: '<Strong>Post : ID(' + data[0]['id'] + ')</strong>',
                        type: 'info',
                        html: '<b>Title : </b>' + data[0]['title'] +
                            '<br><br><b>Post : </b>' + data[0]['descript'] +
                            '<br><br><b>Written On : </b>' + data[0]['created'],
                        showCloseButton: true,
                    })
                }
            });
        })

        //Edit post of a user ajax request
        $("body").on('click', '.editBtn', function(e) {
            e.preventDefault();
            edit_id = $(this).attr('id');
            $.ajax({
                url: 'asset/php/process.php',
                method: 'post',
                data: {
                    edit_id: edit_id
                },
                success: function(response) {
                    data = JSON.parse(response);
                    $("#id").val(data[0].id);
                    $("#title").val(data[0].title);
                    $("#descript").val(data[0].descript);
                }
            });
        });

        //Update post ajax form request
        $("#edit-post-form").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'asset/php/process.php',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: new FormData(this),
                success: function(response) {
                    swal.fire({
                        title: 'Post Updated successfully!',
                        type: 'success'
                    });
                    location.reload();
                }
            });
        });

        //delete note of a user ajax request
        $("body").on('click', '.deleteBtn', function(e) {
            e.preventDefault();
            del_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'asset/php/process.php',
                        method: 'post',
                        data: {
                            del_id: del_id
                        },
                        success: function(response) {
                            Swal.fire(
                                'Deleted!',
                                'Note Deleted Sucessfully!',
                                'success'
                            )
                            location.reload();
                        }
                    });

                }
            })
        });
    });
    </script>
</div>