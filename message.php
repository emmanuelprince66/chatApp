<?php
require_once 'asset/php/header.php'; ?>
<div class="container-fluid my-4">
    <?php if (isset($_POST)) : ?>
        <p id="c_id" style="display: none;"><?php echo  $_POST['id'] ?></p>
    <?php else : ?>
        <p></p>
    <?php endif; ?>
    <div class=" container">

        <div class="col-md-9 mx-auto" id="show_content">
            <p id="showE"></p>
        </div>

        <div class="col-md-9 mx-auto " id="content">

        </div>

        <div class="but bg-dark p-4">
            <div class=" d-flex justify-content-center">
                <input type="text" autocomplete="off" class="msg_content " name="msg_content" placeholder="Write your message....">
                <button class="btn btn-danger sbtn ml-2" type="submit" name="submit" id=""><i class="fa fa-paper-plane text-primary"></i></button>
            </div>
        </div>



    </div>
</div>
<link rel="stylesheet" href="asset/css/messagezz.css">


<!--bootstrap jquery-->
<script src="asset/js/jquery-3.5.1.min.js"></script>
<!--bootstrap js-->
<script src="asset/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

        displayReciever();

        function displayReciever() {

            //get post id 
            reci_id = $("#c_id").html();
            reciever = $("#c_id").html();


            setInterval(function getMessage() {
                $.ajax({
                    url: 'asset/php/status.php',
                    method: 'get',
                    data: {
                        reci_id: reci_id
                    },
                    success: function(response) {
                        $("#content").html(response);

                    }
                });
            } , 1000);


            bt = $(".sbtn").attr('id', reciever);

            $.ajax({
                url: 'asset/php/status.php',
                method: 'get',
                data: {
                    reciever: reciever
                },
                success: function(response) {
                    $("#show_content").html(response);

                }
            });
        }

        //send message

        $("body").on('click', '.sbtn', function() {
            reciever = $(this).attr('id');
            msg = document.querySelector(".msg_content").value;
            if (msg) {
                $.ajax({
                    url: 'asset/php/status.php',
                    method: 'post',
                    data: {
                        reciever: reciever,
                        msg: msg
                    },
                    success: function(response) {
                        $("#content").html(response);
                        location.reload();
                     }
                });
            } else {

            }



        });


    });
</script>