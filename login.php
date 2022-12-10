<?php require_once 'asset/php/header.php'; ?>

<div class="container " style="height: 100%;">
    <!--login start-->
    <div class="row justify-content-center mt-5 wrapper" id="login-box">
        <div class="col-md-6 mx-auto my-auto">
            <div class="card-group">
                <div class="card rounded p-4 ">
                    <h1 class="text-center font-weight-bold text-primary">
                        Sign In
                    </h1>
                    <hr class="my-3">
                    <form action="" method="post" class="px-4" id="login-form">
                        <div id="loginAlert"></div>
                        <div class="input-group input-group-lg form-group">
                            <input type="email" name="email" id="email" class="f form-control rounded-0"
                                placeholder="E-mail" required
                                value="<?php if (isset($_COOKIE['email'])) {
                                                                                                                                          echo $_COOKIE['email'];
                                                                                                                                       } ?>">
                        </div>
                        <div class="input-group input-group-lg form-group">
                            <input type="password" name="password" id="password" class=" form-control rounded-0"
                                placeholder="Password"
                                value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                             echo $_COOKIE['password'];
                                                                                                                                          } ?>"
                                required>
                        </div>
                        <div class="form-group ">
                            <div class="custom-control custom-checkbox  float-left">
                                <input type="checkbox" name="rem" class="custom-control-input" id="customChecked"
                                    <?php if (isset($_COOKIE['email'])) { ?> checked<?php } ?>>
                                <label for="customChecked" class="custom-control-label"> Remenber me</label>
                            </div>
                            <div class="forgot float-right">
                                <a href="#" id="forgot-link"> Forgot Password?</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <div class="form-group">
                            <input type="submit" id="login-btn" value="Sign In"
                                class="btn btn-primary btn-lg btn-block myBtn">
                        </div>

                        <div class="text-center">
                            <a href="#" id="register-link">Sign up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---login ends-->

    <!--register form start -->
    <div class="row justify-content-center mt-5 wrapper" id="register-box" style="display: none;">
        <div class="col-lg-6 my-auto">
            <div class="card-group myShadow">
                <div class=" card rounded-right p-4">
                    <h1 class="text-center font-weight-bold text-primary">
                        Create Account
                    </h1>
                    <hr class="my-3">
                    <form action="#" method="post" class="px-3" id="register-form">
                        <div id="regAlert"></div>
                        <!--username field-->
                        <div class="input-group  input-group-lg form-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="far fa-user fa-lg"></i>
                                </span>
                            </div>
                            <input type="text" name="name" id="name" class="form-control rounded-0"
                                placeholder="Full Name" required>
                        </div>
                        <!--end username field-->

                        <!--e-mail field-->
                        <div class="input-group  input-group-lg form-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="far fa-envelope fa-lg"></i>
                                </span>
                            </div>
                            <input type="email" name="email" id="r-email" class="form-control rounded-0"
                                placeholder="E-Mail" required>
                        </div>
                        <!--end of e-mail field-->

                        <!--password field-->
                        <div class="input-group  input-group-lg form-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-key fa-lg"></i>
                                </span>
                            </div>
                            <input type="password" name="password" id="rpassword" class="form-control rounded-0"
                                placeholder="Password" required minlength="5">
                        </div>
                        <!--end of password field-->

                        <!--password field-->
                        <div class="input-group  input-group-lg form-group ">
                            <div class="input-group-prepend">
                                <span class="input-group-text rounded-0">
                                    <i class="fas fa-key fa-lg"></i>
                                </span>
                            </div>
                            <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0"
                                placeholder="Confirm Password" required minlength="5">
                        </div>
                        <!--end of password field-->

                        <div class="form-group">
                            <div id="parseErorr" class=" text-danger font-weight-bold"></div>
                        </div>


                        <div class="form-group">
                            <input type="submit" id="register-btn" value="Sign Up"
                                class="btn btn-primary btn-lg btn-block myBtn">
                        </div>

                        <div class="text-center">
                            <a href="#" id="login-link">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--register form ends-->


    <!--forgot password form starts-->
    <div class="row justify-content-center mt-5 wrapper" id="forgot-box" style="display: none;">
        <div class="col-md-8 my-auto">
            <div class=" card rounded-right p-4" style="flex-grow: 1.4;">
                <h1 class="text-center font-weight-bold text-primary">
                    Forgot Your Password
                </h1>
                <hr class="my-3">
                <p class="lead text-center text-secondary"> To Reset Your Password, enter the registered e-mail address
                    and
                    we will send you the reset instructions on your e-mail!</p>
                <form action="#" method="post" class="px-3" id="forgot-form">
                    <div id="forgotAlert"></div>
                    <!--e-mail field-->
                    <div class="input-group  input-group-lg form-group ">
                        <div class="input-group-prepend">
                            <span class="input-group-text rounded-0">
                                <i class="far fa-envelope fa-lg"></i>
                            </span>
                        </div>
                        <input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-Mail"
                            required>
                    </div>
                    <!--end of e-mail field-->

                    <div class="form-group">
                        <input type="submit" id="forgot-btn" value="Reset Password"
                            class="btn btn-primary btn-lg btn-block myBtn">
                    </div>

                    <button class="btn btn-outline-danger btn-md align-self-center font-weight-bold
                          mt-4 myLinkBtn" id="back-link">Back</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--forgot password form ends-->

</div>
<!--bootstrap jquery-->
<script src="asset/js/jquery-3.5.1.min.js"></script>
<!--bootstrap js-->
<script src="asset/js/bootstrap.bundle.min.js"></script>
<!--font awesome-->
<script src="asset/js/all.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#register-link").click(function() {
        $("#login-box").hide();
        $("#register-box").show();
    });

    $("#login-link").click(function() {
        $("#login-box").show();
        $("#register-box").hide();
    });

    $("#forgot-link").click(function() {
        $("#login-box").hide();
        $("#forgot-box").show();
    });

    $("#back-link").click(function() {
        $("#login-box").show();
        $("#forgot-box").hide();
    });

    //Register Ajax Request......

    $("#register-btn").click(function(e) {
        if ($("#register-form")[0].checkValidity()) {
            e.preventDefault();
            $("#register-btn").val('please wait...');
            if ($("#rpassword").val() != $("#cpassword").val()) {
                $hMsg = $("#parseErorr").text("*Password do not match!");
                setTimeout(() => $hMsg.remove(), 5000);

                $("#register-btn").val('Sign Up');
            } else {
                $("#parseErorr").text("");
                $.ajax({
                    url: 'asset/php/action.php',
                    method: 'post',
                    data: $("#register-form").serialize() + '&action=register',
                    success: function(response) {
                        $("#register-btn").val('Sign Up');
                        if (response = 'register') {
                            window.open('index.php');
                        } else {
                            $('#regAlert').html(response);
                        }
                    }
                });
            }
        }
    });
    //Login Ajax Request
    $('#login-btn').click(function(e) {
        if ($('#login-form')[0].checkValidity()) {
            e.preventDefault();

            $('#login-btn').val('Please Wait...');
            $.ajax({
                url: 'asset/php/action.php',
                method: 'post',
                data: $("#login-form").serialize() + '&action=login',
                success: function(response) {
                    $("#login-btn").val('Sign In');
                    if (response == 'login') {
                        window.location = 'index.php';

                        swal.fire({
                            title: 'You are logged in!',
                            type: 'success'
                        });
                    } else {
                        $('#loginAlert').html(response);
                    }
                }
            });
        }
    })
})
</script>
</body>

</html>