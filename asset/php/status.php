<?php
require_once 'session.php';


//get reciever 
if (isset($cid) && isset($_GET['reciever'])) {
    $id = $_GET['reciever'];

    $data = $cuser->get_username($id);

    $username = $data[0]['name'];
    $reciever_img = $data[0]['photo'];
    $user_name = $cname;

    $total = $cuser->total_messages($user_name, $username);
    $output = '';
    if ($data) {
        if($data[0]['photo'] != ''){
        $output .= '<div class="w-100" style:background-color:red;>';
            foreach ($data as $row) {

                $output .= '<div class="d-flex align-items-center bg-dark text-light p-2">
            <img class=" img-rounded img-fluid mr-4 pb-1" src=' . 'asset/php/' . $row['photo'] . ' style="height:50px;width:50px;border-radius:50px;">
           
           <div class="pt-2">
           <p class="font-weight-bold text-capitalize mb-1">' . $row['name'] . '</p>
           <p class=><span class="total">' . $total . '&nbsp;</span>messages</p>
           </div> 
          </div>';
            }
        $output .= '</div>';
        echo $output;
        } else{
            $output .= '<div class="w-100" style:background-color:red;>';
            foreach ($data as $row) {

                $output .= '<div class="d-flex align-items-center bg-dark text-light p-2">
            <img class=" img-rounded img-fluid mr-4 pb-1" src="asset/images/icon.png" style="height:50px;width:50px;border-radius:50px;">
           
           <div class="pt-2">
           <p class="font-weight-bold text-capitalize mb-1">' . $row['name'] . '</p>
           <p class=><span class="total">' . $total . '&nbsp;</span>messages</p>
           </div> 
          </div>';
            }
            $output .= '</div>';
            echo $output;
        }
    }
}


//set status
if (isset($_GET['status']) && isset($cid)) {
    $data = $cuser->uProfile_post($cid);
    $output = '';
    if ($data) {
        if ($data[0]['photo'] != '') {
        $output .= '<div class="bg-dark text-white p-3">';
            foreach ($data as $row) {
                $output .= '<div class="d-flex align-items-center"> 
         <img class=" img-rounded img-fluid mr-4 pb-1" src=' . 'asset/php/' . $row['photo'] . ' style="height:50px;width:50px;border-radius:50px;">
        <div class="pt-2">
        <p class="font-weight-bold text-capitalize mb-1">' . $row['name'] . '</p>
        <p class=><span class="total">0&nbsp;</span>messages</p>
        <div>
    
        </div>';
            }
       
        $output .= '</div>';
        echo $output;
        } 
        else {
            $output .= '<div class="bg-dark text-white p-3">';
            foreach ($data as $row) {
                $output .= '<div class="d-flex align-items-center"> 
         <img class=" img-rounded img-fluid mr-4 pb-1"  src="asset/images/icon.png" style="height:50px;width:50px;border-radius:50px;">
        <div class="pt-2">
        <p class="font-weight-bold text-capitalize mb-1">' . $row['name'] . '</p>
        <p class=><span class="total">0&nbsp;</span>messages</p>
        <div>
    
        </div>';
            }
            $output .= '</div>';
            echo $output;
        }
    }
}

//send message
if (isset($_POST['reciever']) && isset($_POST['msg']) && isset($cid)) {
    $msg_content = $_POST['msg'];
    $id = $_POST['reciever'];

    $data = $cuser->get_username($id);

    $username = $data[0]['name'];
    $user_name = $cname;


    $content = '';

    $cuser->insert_msl($user_name, $username, $msg_content);

    $sel_msg = $cuser->get_mes($user_name, $username);

    if ($sel_msg) {
        foreach ($sel_msg as $row) {
            if ($user_name == $row['sender_username'] && $username == $row['reciever_username']) {
                $content .= '<div class="right-side-chat">
            <span class="text-danger font-weight-bold">' . $user_name . '&nbsp;<small>' . $row['msg_date'] . '</small><span>
            <p class="msg_right">' . $row['msg_content'] . '</p>
            </div>';
            } elseif ($user_name == $row['reciever_username'] && $username == $row['sender_username']) {
                $content .= '<div class="left-side-chat">
            <span class="text-primary pr-1 font-weight-bold">' . $username . '&nbsp;<small>' . $row['msg_date'] . '</small><span>
            <p class="msg_left">' . $row['msg_content'] . '</p>
            </div>';
            }
        }
    }
    echo $content;
}

//get all message 
if (isset($_GET['reci_id']) && isset($cid)) {
    $id = $_GET['reci_id'];
    $data  = $cuser->get_username($id);

    $username = $data[0]['name'];
    $user_name = $cname;

    $sel_msg = $cuser->get_mes($user_name, $username);

    $content = '';

    if ($sel_msg) {
        $update_msg = $cuser->update_cstatus($user_name, $username);

        foreach ($sel_msg as $row) {
            if ($user_name == $row['sender_username'] && $username == $row['reciever_username']) {
                $content .= '<div class="right-side-chat">
            <span class="text-danger font-weight-bold">' . $user_name . '&nbsp;<small>' . $row['msg_date'] . '</small><span>
            <p class="msg_right">' . $row['msg_content'] . '</p>
            </div>';
            } elseif ($user_name == $row['reciever_username'] && $username == $row['sender_username']) {
                $content .= '<div class="left-side-chat">
            <span class="text-primary pr-1 font-weight-bold">' . $username . '&nbsp;<small>' . $row['msg_date'] . '</small><span>
            <p class="msg_left">' . $row['msg_content'] . '</p>
            </div>';
            }
            $content .= '</div>';
        }
    }
    echo $content;
}



if (isset($_POST['status'])) {
    $status = date('i');
    $cuser->set_date($status, $cid);
}

//handle show profile  details modal ajax request
if (isset($_POST['iss'])) {
    $iss = $_POST['iss'];



    $data = $cuser->uProfile_post($iss);
    $output = '';

    if ($data) {
        if ($data[0]['photo'] != '') {

            $output .= '<div class="card w-100" style="max-height:30%;">';
            foreach ($data as $row) {
                $output .= '<div class="card-body py-4 text-dark text-center">
         <img class="img-thumbnail" src=' . 'asset/php/' . $row['photo'] . ' style="height:250px;width:250px;">
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>Name : </strong>' . $row['name'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Gender : </strong>' . $row['gender'] . '</p>
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>Date Of Birth : </strong>' . $row['dob'] . '</p>
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>About Me : </strong>' . $row['descript'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Email : </strong>' . $row['email'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Phone : </strong>' . $row['phone'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Joined At : </strong>' . date('d M Y', strtotime($row['created_at'])) . '</p>
         </div>';
            }
            $output .= '</div>';
            echo $output;
        } else {
            $output .= '<div class="card w-100" style="max-height:30%;">';
            foreach ($data as $row) {
                $output .= '<div class="card-body py-4 text-dark text-center">
         <img class="img-thumbnail" src="asset/images/icon.png"   style="height:250px;width:250px;">
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>Name : </strong>' . $row['name'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Gender : </strong>' . $row['gender'] . '</p>
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>Date Of Birth : </strong>' . $row['dob'] . '</p>
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>About Me : </strong>' . $row['descript'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Email : </strong>' . $row['email'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Phone : </strong>' . $row['phone'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Joined At : </strong>' . date('d M Y', strtotime($row['created_at'])) . '</p>
         </div>';
            }
            $output .= '</div>';
            echo $output;
        }
    }
}