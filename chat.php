<?php
require_once 'asset/php/header.php'
?>

<div class="wrapper  m-4">
    <?php if (isset($_POST)) : ?>
        <p id="post_id" style="display: none;"><?php echo  $_POST['postid'] ?></p>
        <p id="c_id" style="display: none;"><?php echo  $_POST['id'] ?></p>
    <?php else : ?>
        <p></p>
    <?php endif; ?>

    <div class="container">
        <?php if (isset($cid)) : ?>
            <div id="showAlert"></div>
        <?php else : ?>
            <div id="showE"></div>
        <?php endif; ?>

        <div id="repp" class="container-item rep">
            <?php if (isset($cid)) : ?>
                <em></em>
            <?php else : ?>
                <div class="user">
                    <div class="text-center">
                        <a href="login.php" class="text-decoration-none">
                            <i class="fas fa-user"></i>
                        </a>
                        <p>Login here.</p>
                    </div>
                    <div class=" divv">
                        <div class="scomm">
                            <p id="com"></p>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
            <?php if (isset($cid)) : ?>
                <div class=" divv">
                    <div class="scomm">
                        <p id="com"></p>
                    </div>
                    <form action="#" method="post" id="chatForm">
                        <div class="form-group">
                            <p id="showErc" class="text-danger" style="font-size: 13px;"></p>
                            <textarea name="chata" id="chat" placeholder="Comment on this post...." class="form-control mx-1"></textarea>
                        </div>
                        <?php if (isset($cid)) : ?>
                            <div class="form-group" id="comment-form">
                                <input type="submit" id="<?php echo $cid; ?>" class="btn btn-block btn-primary chatS">
                            </div>
                        <?php else : ?>
                            <div class="form-group" id="comment-form">
                                <input type="submit" class="btn btn-block btn-primary chatS">
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            <?php else : ?>
                <div></div>
            <?php endif; ?>
        </div>

        <!-- reply comment modal-->
        <div class="modal fade" id="replyComment">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-info" style="height: 10px;">
                        <button type="button" class="close text-light pt-0" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="card p-2">
                            <p class="text-capitalize" id="message"></p>
                            <form action="#" method="post" id="repForm">
                                <div class="form-group">
                                    <textarea name="reply" id="reply" placeholder="Reply this comment...." class="form-control mx-1"></textarea>
                                </div>
                                <p id="showErrr" class="text-danger" style="font-size: 13px;"></p>
                                <div class="form-group" id="replyBtn">
                                    <input type="submit" class="btn repBtn btn-block btn-primary" value="Send">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end  Modal--->

        <!-- show profile details Modal-->
        <div class="modal fade" id="showProfile">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-info" style="height: 10px;">
                        <button type="button" class="close text-light pt-0" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="show">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end show profile details Modal--->

        <!-- show replies details Modal-->

        <div id="showReplies">
            <div id="showRep" class="replie">
            </div>
        </div>
    </div>
    <!-- end show replies details Modal--->
</div>
</div>
<link rel="stylesheet" href="asset/css/chataa.css">

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


        displayPosts();


        function displayPosts() {


            //get post id 
             id = $("#post_id").html();
            post_id = $("#c_id").html();
           

            let formss = document.forms['#chatForm'];
            $.ajax({
                url: 'asset/php/chat_process.php',
                method: 'post',
                data: {
                    id: id
                },
                success: function(response) {
                    if (response = []) {
                        show = $("#showE").html(
                            '<div class="alert alert-danger"><strong class="text-center">Please log in to Comment</strong></div>'
                        );
                        datas = $(".delPost").html('');
                        setTimeout(() => {
                            show = $("#showE").html('');
                        }, 3000);
                    } else {
                        data = JSON.parse(response);
                        $(".chatS").attr('id', data[0]['id']);
                    }
                }
            });
        }

        //modal for reply comment
        $("body").on('click', '.replyComment', function(e) {
            e.preventDefault();
            idx = $(this).attr('id');
            $.ajax({
                url: 'asset/php/chat_process.php',
                method: 'post',
                data: {
                    idx: idx
                },
                success: function(response) {

                    data = JSON.parse(response);
                    $("#message").text(data[0].message);
                    $(".repBtn").attr('id', data[0]['id']);
                }
            });
        });

        //get comments from database
        getComment();

        function getComment() {
            idd = id;
            $.ajax({
                url: 'asset/php/chat_process.php',
                method: 'post',
                data: {
                    idd: idd
                },
                success: function(response) {
                    if (response == []) {
                        $("#com").text('No comments available.');
                    } else {
                        $("#com").html(response);
                    }
                }
            });
        }
        //modal for  show user profile deatils ajax request
        $("body").on('click', '.showProfile', function(e) {
            e.preventDefault();
            var iss = $(this).attr('id');
            $.ajax({
                url: 'asset/php/chat_process.php',
                method: 'post',
                data: {
                    iss: iss
                },
                success: function(response) {
                    $("#show").html(response);
                    $('#showProfile').modal('show');
                }
            });
        });


        //save reply ajax request
        $("body").on('click', '.repBtn', function(e) {

            if ($("#repForm")[0].checkValidity()) {
                e.preventDefault();

                rid = $(this).attr('id');


                $(".repBtn").val('Please Wait....');
                replyVal = document.querySelector("#reply").value;

                if (replyVal == '') {
                    $("#showErrr").text('*Input field is Required!');
                    setTimeout(() => $("#showErc").html(''), 4000);
                    $(".repBtn").val('Submit');

                } else {

                    $.ajax({
                        url: 'asset/php/chat_process.php',
                        method: 'post',
                        data: {
                            rid: rid,
                            replyVal: replyVal
                        },
                        success: function(response) {
                            $(".repBtn").val('Submit');
                            location.reload();
                            getComment();
                        }
                    });
                }
            }
        });

        //show replies ajax request
        $("body").on('click', '.showReplies', function() {
            replyId = $(this).attr('id');
            $("#repp").css("opacity", "0.5");
            $.ajax({
                url: 'asset/php/chat_process.php',
                method: 'post',
                data: {
                    replyId: replyId
                },
                success: function(response) {
                    if (response == []) {
                        $("#showRep").addClass('hot');
                        $("#showRep").html(
                            '<div class="d-flex justify-content-between"><p>No Replies....</p><span  class="d-flex px-1  closee"><button class="btn btn-danger btn-sm">&times;</button></span></div>'
                        );
                    } else {
                        $("#showRep").html(response);
                        $("#showRep").addClass('hot');
                    }
                }
            });
        });

        //close show replies modal 
        $("body").on('click', '.closee', function() {
            $("#showRep").removeClass('hot');
            $("#repp").css("opacity", "1");
        });

        //store comments in database
        $("body").on('click', '.chatS', function(e) {
            if ($("#chatForm")[0].checkValidity()) {
                sid = $(this).attr('id');
                ids = id;

                post_ids = post_id;
                
                e.preventDefault();

                $(".chatS").val('Please Wait....');
                text = document.querySelector("#chat").value;

                if (text == '') {
                    $("#showErc").text('*Input field is Required!');
                    setTimeout(() => $("#showErc").html(''), 4000);
                    $(".chatS").val('Submit');
                } else {
                    $.ajax({
                        url: 'asset/php/chat_process.php',
                        method: 'post',
                        data: {
                            ids: ids,
                            text: text,
                            post_ids: post_ids
                        },
                        success: function(response) {
                            $(".chatS").val('Submit');
                            $("#chatForm")[0].reset();
                            getComment();

                            //ajax request for notification
                            $.ajax({
                                url: 'asset/php/process.php',
                                method: 'post',
                                data: {
                                    post_ids: post_ids,
                                    ids: ids,
                                    sid
                                },
                                success: function(response) {
                                    console.log(response);
                                }
                            });
                            //end ajax request for notification
                        }
                    });


                }
                
            }
        });


        //delete comment post ajax request
        $("body").on('click', '.delPost', function(e) {
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
                        url: 'asset/php/chat_process.php',
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