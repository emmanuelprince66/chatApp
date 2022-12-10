<?php require_once 'asset/php/mysql.php';
require_once 'asset/php/session.php';


if (isset($cid) && $_GET['action'] == 'get_msg') {

    $sql = 'SELECT * FROM users ORDER bY created_at ASC';
    $stmt = $conn->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $row) {
        $msg_status = 'unread';
        $sql = 'SELECT * FROM users_chat WHERE msg_status = :msg_status';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['msg_status' => $msg_status]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $output = '';

        foreach ($data as $sow) {
            if ($cname == $sow['reciever_username'] && $sow['sender_username'] == $row['name']) {
                $output .= '<div class="mb-4">
            <div class="d-flex mt-2 jik justify-content-between align-items-center">
            <div class="d-flex align-items-center">
               <p  style="font-weight:bolder;" class="text-danger text-capitalize">' . $sow['sender_username'] . '</p>&nbsp;&nbsp;<p>
               sent you a message.</p>
               </div>

                  <form action="message.php" method="post">
                              <input type="hidden" name="id" id="Id" value="' . $row['id'] . '"> 
                        <button type="submit" class="btn btn-sm btn-primary but">View message</button>     

                        </form>

         </div>
</div>';  
            } 
        }
        $output .= '</div>';
        echo $output;
    }
} 


if (isset($_GET['action']) && $_GET['action'] == 'get_users') {
    $sql = 'SELECT * FROM users ORDER BY created_at ASC';
    $stmt = $conn->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $row) {

?>
<div>
    <?php
            $msg_status = 'read';
            $sql = 'SELECT * FROM users_chat'
            ;
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // echo json_encode($data);
            foreach ($data as $bow) {
                
            }


            ?>
    <div class=" text-light lead d-flex justify-content-between align-items-center jerry">

        <div class="d-flex my-2 ">

            <?php if (date('i') == $row['status'] && isset($cid)) {
                        echo  '<div class="dott" ></div>&nbsp;&nbsp;';
                    } else {
                        echo '<div class=""></div>&nbsp;&nbsp;';
                    } ?>
            <?php if (isset($cid) && $cname == $bow['reciever_username'] && $bow['sender_username'] == $row['name']) {

                        echo '<div class="dot" ></div>&nbsp;&nbsp;<p class="text-danger font-weight-bolder text-capitalize"> ' . $row['name'] . '</p>';
                    } elseif (isset($cid) && $row['name'] == $bow['reciever_username'] && $bow['sender_username'] == $row['name']) {
                        echo '<div class="dot" ></div>&nbsp;&nbsp;<p class="text-danger font-weight-bolder text-capitalize"> ' . $row['name'] . '</p>';
                    } else {
                        echo '   <p class="text-danger font-weight-bolder text-capitalize"> ' . $row['name'] . '</p>';
                    }
                    ?>

        </div>

        <div class="d-flex align-items-center">

            <?php if (isset($cid) && $cid ==  $row['id']) {

                        echo   '';
                    } elseif (!isset($cid)) {
                        echo '';
                    } elseif (isset($cid) && $cname == $bow['reciever_username'] && $bow['sender_username'] == $row['name'] && $bow['msg_status'] == 'unread' ) {
                        echo   '<form action="message.php" method="post">
                              <input type="hidden" name="id" id="Id" value="' . $row['id'] . '"> 
                        <button type="submit" class="btn btn-sm d-flex btn-outline-success align-items-center butmsg"style="height:24px">View message</button>     

                        </form>';
                    } else {
                        echo   '<form action="message.php" method="post">
                              <input type="hidden" name="id" id="Id" value="' . $row['id'] . '"> 
                        <button type="submit" class="btn btn-sm d-flex btn-outline-primary align-items-center butmsg"style="height:24px">Message</button>     

                        </form>';
                    }


                    ?>



            <button id=" <?php echo $row['id'] ?>" data-target="#showProfile" data-toggle="modal"
                class="btn btn-sm d-flex btn-outline-success .smt justify-content-end m-1 showProfile"
                style="height:24px"><i class="fas fa-user"></i></button>

        </div>

    </div>

</div>
<?php
    }
}