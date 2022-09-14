<?php
require_once 'asset/php/header.php'
?>
<?php if (isset($cid)) : ?>

  <div class=" mt-5 w-50 mx-auto jik">
    <p class="text-dark text-capitalize res"></p>

    <div class=" text-capitalize" id="content">




    </div>
    <div class=" text-capitalize" id="content2">

    </div>
  </div>


<?php else : ?>
  <div class="container">
    <div class="justify-content-center mt-5 wrapper">
      <?php if (isset($cid)) : ?>

      <?php else : ?>
        <p class="text-dark text-capitalize">log in to view notification ....</p>
        <a class="btn btn-outline btn-primary btn-sm text-decoration-none" href="login.php">Login Here.</a>
      <?php endif; ?>
    </div>
  </div>

<?php endif; ?>

<link rel="stylesheet" href="asset/css/noti.css">

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



    // get all messages for user
    getRecivedmsg();

    function getRecivedmsg() {
      $.ajax({
        url: 'online.php',
        method: 'get',
        data: {
          action: 'get_msg',
        },
        success: function(response) {

          if (response == '</div></div></div></div></div>') {
            $(".res").text('No notification yet.....');
          } else {
            $("#content2").html(response);
          }
        }
      });

    }

    //get all comments on user posts

    getCommentsNoti();

    function getCommentsNoti() {
      $.ajax({
        url: 'asset/php/process.php',
        method: 'get',
        data: {
          action: 'get_comNoti'
        },
        success: function(response) {
           $("#content").html(response);
        }
      })

    };

    //delete all notification records from database
    $("body").on('click', '.but', function() {
      delnId = $(this).attr('id');

      $.ajax({
        url: 'asset/php/process.php',
        method: 'post',
        data: {
          delnId: delnId
        },
        success: function(response) {}
      });

    });
  });
</script>