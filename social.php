<?php require_once 'asset/php/header.php'; ?>


<div class="container mt-4">
    <div class="wrapper d-flex justify-content-center text-center">

        <div>
            <h1>Meet Friends.</h1>
            <p class="text-muted lead text-capitalize">here you can message a friend.</p>
            <p id="msg"></p>
            <?php if (!isset($cid)) : ?>
            <p class="text-danger">Please Log in to chat.</p>
            <a href="login.php">Login here!</a>
            <?php else : ?>
            <p></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="d-flex">
        <div id="show" class="col-md-9 mx-auto col-sm-12 left-sidebar">
            <!--all users--->

        </div>
    </div>
</div>

<!-- show profile details Modal-->
<div class=" modal fade" id="showProfile">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info" style="height: 10px;">
                <button type="button" class="close text-light pt-0" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="shows">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end show profile details Modal--->






<link rel="stylesheet" href="asset/css/messagezz.css">
<!--bootstrap jquery-->
<script src="asset/js/jquery-3.5.1.min.js"></script>
<!--bootstrap js-->
<script src="asset/js/bootstrap.bundle.min.js"></script>
<!--font awesome-->
<script type="text/javascript" src="asset/DataTables/datatables.min.js"></script>
<script src="asset/js/all.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
$(document).ready(function() {


    getuserp();

    function getuserp() {
        status = 1;
        $.ajax({
            url: 'asset/php/status.php',
            method: 'get',
            data: {
                status: status
            },
            success: function(response) {
                $("#upShow").html(response);
            }
        });
    }

    $("#show").html('<p class="font-weight-bold mx-auto text-primary">Please wait........</>');

    setInterval(function() {
        $.ajax({
            url: 'asset/php/status.php',
            method: 'post',
            data: {
                status: status
            },
            success: function(response) {

            }

        });
    }, 2000);

    setInterval(function() {
        $.ajax({
            method: "get",
            url: "online.php",
            data: {
                action: 'get_users'
            },
            success: function(response) {

               $("#show").html(response);
                // console.log(response);
            }
        });
    }, 2000);

    //modal for  show user profile details ajax request
    $("body").on('click', '.showProfile', function(e) {
        e.preventDefault();
        iss = $(this).attr('id');
        $.ajax({
            url: 'asset/php/status.php',
            method: 'post',
            data: {
                iss: iss
            },
            success: function(response) {
                $("#shows").html(response);
                $('#showProfile').modal('show');
            }
        });
    });


});
</script>