<?php
require_once "asset/php/header.php";

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card rounded-0 mt-3 border-primary">
                <div class="card-header border-primary">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a href="#profile" class="nav-link font-weight-bold active" data-toggle="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#editPass" class="nav-link font-weight-bold" data-toggle="tab">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="#changePass" class="nav-link font-weight-bold" data-toggle="tab">Change
                                Password</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body" style="height:80vh;">
                    <div class="tab-content">
                        <!---Profile tab content start--->
                        <div class="tab-pane active container" id="profile">
                            <div class="card-deck">
                                <div class="card border-primary">
                                    <?php if (isset($cid)) : ?>
                                    <div class="card-header bg-primary text-light text-center lead">
                                        User ID : <?= $cid; ?>
                                    </div>
                                    <?php else : ?>
                                    <div class="card-header bg-primary text-light text-center lead">
                                        User ID : <?php echo 'NIL'; ?>
                                    </div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <?php if (isset($cid)) : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Name :</b> <?= $cname; ?>
                                        </p>
                                        <?php else : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Name :</b> <?php echo 'NIL'; ?>
                                        </p>
                                        <?php endif; ?>

                                        <?php if (isset($cid)) : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>E-mail :</b> <?= $cemail; ?>
                                        </p>
                                        <?php else : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>E-mail :</b> <?php echo 'NIL'; ?>
                                        </p>
                                        <?php endif; ?>

                                        <?php if (isset($cid)) : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Gender :</b> <?= $cgender; ?>
                                        </p>
                                        <?php else : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Gender :</b> <?php echo "NIL"; ?>
                                        </p>
                                        <?php endif; ?>

                                        <?php if (isset($cid)) : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Date Of Birth :</b> <?= $cdob; ?>
                                        </p>
                                        <?php else : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Date Of Birth :</b> <?php echo "NIL"; ?>
                                        </p>
                                        <?php endif; ?>

                                        <?php if (isset($cid)) : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Phone :</b> <?= $cphone; ?>
                                        </p>
                                        <?php else : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Phone :</b> <?php echo "NIL"; ?>
                                        </p>
                                        <?php endif; ?>

                                        <?php if (isset($cid)) : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Registered On :</b> <?= $reg_on; ?>
                                        </p>
                                        <?php else : ?>
                                        <p class="card-text p-2 m-1 rounded" style="border: 1px solid #0275d8;">
                                            <b>Registered On :</b> <?php echo "NIL"; ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card border-primary align-self-center">
                                    <?php if (empty($cphoto)) : ?>
                                    <img src="asset/images/icon.png" class="img-thumbnail img-fluid" width="408px">
                                    <?php else : ?>
                                    <img src="<?= 'asset/php/' . $cphoto; ?>" class="img-thumbnail img-fluid"
                                        width="408px">
                                    <?php endif; ?>


                                    <?php if (isset($cid)) : ?>
                                    <div class="p-3">
                                        <p class="p-1 text-capitalize"> <?= $cdes ?></p>
                                    </div>
                                    <?php else : ?>
                                    <div class="p-3">
                                        <p class="p-1"> <?php echo "NIL"; ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!---Profile Tab content end --->

                        <?php if (isset($cid)) : ?>

                        <!--edit profile tab content start-->
                        <div class="tab-pane container fade" id="editPass">
                            <div class="card-deck">
                                <div class="card border-danger align-self-center">
                                    <?php if (!$cphoto) : ?>
                                    <img src="asset/images/icon.png" class="img-thumbnail img-fluid" width="408px">
                                    <?php else : ?>
                                    <img src="<?= 'asset/php/' . $cphoto; ?>" class="img-thumbnail img-fluid"
                                        width="408px">
                                    <?php endif; ?>
                                </div>
                                <div class="border-danger" style="border: 1px solid red;">
                                    <form action="" method="post" class="px-3 mt-2" enctype="multipart/form-data"
                                        id="profile-update-form">
                                        <input type="hidden" name="oldimage" value="<?= $cphoto; ?>">
                                        <div class="form-group m-0">
                                            <label for="profilePhoto" class="m-1">Upload Profile Image</label>
                                            <input type="file" name="image" id="profilePhoto">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="name" class="m-1">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="<?= $cname; ?>">
                                        </div>
                                        <div class="form-group m-0">
                                            <label for="gender" class="m-1">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="" disabled <?php if ($cgender == null) {
                                                                                    echo 'selected';
                                                                                } ?>>Select</option>
                                                <option value="male" <?php if ($cgender == 'male') {
                                                                                echo 'selected';
                                                                            } ?>>Male</option>
                                                <option value="female" <?php if ($cgender == 'female') {
                                                                                echo 'selected';
                                                                            } ?>>Female
                                                </option>
                                            </select>
                                        </div>

                                        <div class="form-group" class="m-0">
                                            <label for="dob" class="m-1">Date Of Birth</label>
                                            <input type='date' id="dob" name="dob" value="<?= $cdob; ?>"
                                                class="form-control">
                                        </div>

                                        <div class="form-group" class="m-0">
                                            <label for="phone" class="m-1">Phone</label>
                                            <input type="tel" id="phone" name="phone" value="<?= $cphone; ?>"
                                                class="form-control" placeholder="Phone">
                                        </div>
                                        <div class="form-group m-0 p-2">
                                            <textarea class="w-100 p-1" style="height: 150px;" name="description"
                                                id="description" cols="30" rows="10"
                                                placeholder="About You....."><?= $cdes ?></textarea>
                                        </div>

                                        <div class="form-group mt-2">
                                            <input type="submit" name="profile_update" id="profileUpadteBtn"
                                                value="Update Profile" class="btn btn-danger btn-block">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php else : ?>

                        <!--edit profile tab content start-->
                        <div class="tab-pane container fade" id="editPass">
                            <div class="card-deck">
                                <div class="card p-3 align-self-center">
                                    <p>Login to View profile</p>
                                </div>
                            </div>
                        </div>

                        <?php endif; ?>
                        <!--edit profile tab content end--->





                        <?php if (isset($cid)) : ?>
                        <!--change password tab content start--->
                        <div class="teb-pane container fade" id="changePass">
                            <div id="changePassError"></div>
                            <div class="card-deck">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white text-center lead">
                                        Change Password
                                    </div>
                                    <form action="#" method="post" class="px-3 mt-2" id="change-pass-form">
                                        <div class="form-group">
                                            <div id="changeAlert" class=" form-group text-danger lead"></div>
                                            <label for="curpass">Enter Your Current Password</label>
                                            <input type="password" name="curpass" placeholder="Current Password"
                                                class="form-control form-control-lg" id="curpass" required
                                                minlength="5">
                                        </div>
                                        <div class="form-group">
                                            <label for="newpass">Enter New Password</label>
                                            <input type="password" name="newpass" placeholder="New Password"
                                                class="form-control form-control-lg" id="newpass" required
                                                minlength="5">
                                        </div>
                                        <div class="form-group">
                                            <label for="cnewpass">Confirm New Password</label>
                                            <input type="password" name="cnewpass" placeholder="Confirm New Password"
                                                class="form-control form-control-lg" id="cnewpass" required
                                                minlength="5">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="changepass" value="Change Password"
                                                class="btn btn-success btn-block btn-lg" id="changePassBtn">
                                        </div>
                                    </form>
                                </div>
                                <div class="card border-success align-self-center">
                                    <?php if (!$cphoto) : ?>
                                    <img src="asset/images/icon.png" class="img-thumbnail img-fluid" width="408px">
                                    <?php else : ?>
                                    <img src="<?= 'asset/php/' . $cphoto; ?>" class="img-thumbnail img-fluid"
                                        width="408px">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!--change password tab content end--->
                        <?php else : ?>
                        <!--change password tab content start--->
                        <div class="teb-pane container fade" id="changePass">
                            <div id="changePassError"></div>
                            <div class="card-deck">
                                <div class="card p-3 border-success">
                                    <p>Login to Change Password</p>
                                </div>
                            </div>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <!--bootstrap jquery-->
    <script src="asset/js/jquery-3.5.1.min.js"></script>
    <!--bootstrap js-->
    <script src="asset/js/bootstrap.bundle.min.js"></script>
    <!--font awesome-->
    <script src="asset/js/all.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        //Update profile ajax form request
        $("#profile-update-form").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'asset/php/process.php',
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                data: new FormData(this),
                success: function(response) {
                    console.log(response);
                    location.reload();
                }
            });
        });
        //change password ajax request
        $("#changePassBtn").click(function(e) {
            if ($("#change-pass-form")[0].checkValidity()) {
                e.preventDefault();
                $("#changePassBtn").val('Please Wait.....');

                if ($("#newpass").val() != $("#cnewpass").val()) {
                    $hMsg = $("#changeAlert").text('*Password do not match!');
                    setTimeout(() => $hMsg.remove(), 5000);

                    $("#changePassBtn").val('Change Password');
                } else {
                    $.ajax({
                        url: 'asset/php/process.php',
                        method: 'post',
                        data: $("#change-pass-form").serialize() + '&action=change_pass',
                        success: function(response) {
                            $("#changeAlert").text('');
                            $("#changePassError").html(response);
                            $("#changePassBtn").val('Change Password');
                            $("#change-pass-form")[0].reset();
                        }
                    });
                }
            }
        });
    });
    </script>
    </body>

    </html>