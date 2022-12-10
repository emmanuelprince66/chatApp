<?php
require_once 'asset/php/header.php';
include('asset/php/process.php');
?>

<header id="header" class="bg-dark">
    <div id="showNot" class="bg-dark"></div>

    <div class="container">
        <div class="row height align-items-center">
            <div class="col">
                <h1 class=" font-weight-bold text-danger text-capitalize text-italic">
                    <strong>Welcome to <span class="h1 fw-bold ani"
                            style="font-family: cursive; font-size:larger;">A</span>nimeet</strong><br><br>
                    <p class="text-muted lead w-75">we are happy to have you with us!</p>
                    <p class="text-muted lead w-75">Here You can meet anime loving friends,ask questions and share
                        creative ideas.</p><br>

                    <?php if (isset($cid)) : ?>
                    <button data-target="#addPosts" id="doPosts" data-toggle="modal" class="btn btn-lg btn-primary">Do
                        Something..</button>
                    <?php else : ?>
                    <button class="btn btn-lg btn-info"><a class="text-decoration-none text-dark" href="login.php">Login
                            To Participate...</a></button>
                    <?php endif; ?>
                </h1>
            </div>
        </div>
    </div>
</header>
<!--end of header section-->


<div id="show-posts">

</div>


<!-- start do something Modal-->
<div class="modal fade" id="addPosts">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title text-light">Add Posts..</h4>
                <button type="button" class="close text-light" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="posts-form" class="px-3">
                    <div class="form-group">
                        <input type="hidden" name="img" id="img" value="image/anime1.gif">
                    </div>
                    <div class="form-group">
                        <input type="text" name="title" id="title" class="form-control form-contol-lg"
                            placeholder="Anime Title...." required>
                    </div>

                    <div class="form-group">
                        <textarea name="descript" id="descript" rows="6" class="form-control form-control-lg"
                            placeholder="Say Something...." required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addPosts" id="addPosts" value="Add Posts"
                            class="btn btn-info btn-block btn-lg">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end  Modal--->

<!-- more details Modal-->
<div class="modal fade" id="moreDetails">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info" style="height: 10px;">
                <button type="button" class="close text-light pt-0" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card p-2">
                    <h4 class="text-bold pb-3 text-capitalize" id="head"></h4>
                    <p class="text-dark" id="text" style="font-size:large;"></p>
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

</div>
<!--bootstrap jquery-->
<script src="asset/js/jquery-3.5.1.min.js"></script>
<!--bootstrap js-->

<script src="asset/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="asset/css/styleml.css">
<script src="asset/js/all.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
$(document).ready(function() {





    displayPosts();

    function displayPosts() {





        $.ajax({
            url: 'asset/php/process.php',
            method: 'post',
            data: {
                action: 'display_posts'
            },
            success: function(response) {
                $("#show-posts").html(response);

            }
        });
    }

    //Store Posts Of User Ajax Request
    $("#posts-form").submit(function(e) {
        if ($("#posts-form")[0].checkValidity()) {


            $.ajax({
                url: 'asset/php/process.php',
                method: 'post',
                data: $("#posts-form").serialize() + "&action=store_posts",
                success: function(response) {
                    $("#addPosts").modal('hide');

                    swal.fire({
                        title: 'Posts added successfully!',
                        type: 'success'
                    });
                    displayPosts();
                }
            });
        }
    })

    //modal for more
    $("body").on('click', '.moreDetails', function(e) {
        e.preventDefault();
        idd = $(this).attr('id');
        $.ajax({
            url: 'asset/php/process.php',
            method: 'post',
            data: {
                idd: idd
            },
            success: function(response) {
                data = JSON.parse(response);
                $("#head").text(data[0].title);
                $("#text").text(data[0].descript);
            }
        });
    });


    //modal for  show user profile details ajax request
    $("body").on('click', '.showProfile', function(e) {
        e.preventDefault();
        iss = $(this).attr('id');
        $.ajax({
            url: 'asset/php/process.php',
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

    //notification
    $("body").on('click', '.notificn', function() {
        p_id = $(this).attr('id');

        $.ajax({
            url: 'asset/php/process.php',
            method: 'post',
            data: {
                p_id: p_id
            },
            success: function(response) {
            }
        });

    });



    //like post
    $("body").on('click', '.like-btn', function() {
        post_id = $(this).attr('id');
        $clicked = $(this);

        if ($clicked.hasClass('rmcls')) {
            action = 'like';
        } else if ($clicked.hasClass('shcl')) {
            action = 'unlike';
        }
        //ajax for like and unlike

        $.ajax({
            url: 'asset/php/process.php',
            method: 'post',
            data: {
                action: action,
                post_id: post_id
            },
            success: function(response) {

                res = JSON.parse(response);



                //for likes view
                if (res.likes) {
                    data = res.likes;
                    arr = Object.keys(data).map(function(key) {
                        return data[key];
                    })

                    likes = arr.toString();

                    //ajax request to post lkes in post 
                    $.ajax({
                        url: 'asset/php/process.php',
                        method: 'post',
                        data: {
                            likes: likes,
                            post_id: post_id
                        },
                        success: function(response) {
                            // console.log(response);
                        }
                    });
                }



                if (action == 'like') {
                    $clicked.removeClass('rmcls');
                    $clicked.addClass('shcl');
                } else if (action == 'unlike') {
                    $clicked.removeClass('shcl');
                    $clicked.addClass('rmcls');
                }


                $clicked.siblings('span.likes').text(likes);



            }

        });

    });


    //dislike post
    $("body").on('click', '.dislike-btn', function() {
        post_id = $(this).attr('id');
        $clicked = $(this);

        if ($clicked.hasClass('rmcls')) {
            action = 'dislike';
        } else if ($clicked.hasClass('shcl')) {
            action = 'undislike';
        }
        //ajax for dislike and undislike

        $.ajax({
            url: 'asset/php/process.php',
            method: 'post',
            data: {
                action: action,
                post_id: post_id
            },
            success: function(response) {

                res = JSON.parse(response);




                //for likes view
                if (res.dislikes) {
                    data = res.dislikes;
                    arr = Object.keys(data).map(function(key) {
                        return data[key];
                    })

                    dislikes = arr.toString();

                    //ajax request to post lkes in post 
                    $.ajax({
                        url: 'asset/php/process.php',
                        method: 'post',
                        cache: false,
                        data: {
                            dislikes: dislikes,
                            post_id: post_id
                        },
                        success: function(response) {}

                    });

                }



                if (action == 'dislike') {
                    $clicked.removeClass('rmcls');
                    $clicked.addClass('shcl');
                } else if (action == 'undislike') {
                    $clicked.removeClass('shcl');
                    $clicked.addClass('rmcls');
                }


                $clicked.siblings('span.dislikes').text(dislikes);



            }

        });

    });

});
</script>
</body>

</html>