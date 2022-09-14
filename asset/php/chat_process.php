<?php
require_once 'session.php';
//display all  user post
if (isset($_POST['id']) && isset($cid)) {
    $id = $_POST['id'];
    $data =  $cuser->getPostsId($id);
    $res = json_encode($data);
    echo $res;
} else {
    echo '';
}

//Handle get comment ajax request
if (isset($_POST['idd'])) {
    $idd = $_POST['idd'];
    $data = $cuser->getRecivId($idd);




    if ($data) {
        if (isset($cid) && $cid == $data[0]['chat_id']) {

            $output = '';

            if ($data) {
                $output .= '<div>';
                foreach ($data as $row) {

                    $output .= '<div class="d-flex flex-column bod mt-2 mb-2 p-1">
         <p  class="rounded m-1" >' . $row['message'] . '</p>
          <p class="p-1">' . date('d M Y', strtotime($row['created_at'])) . '</p>
          <div class="d-flex justify-content-between ">
           <button id="' . $row['id'] . '" class="btn btn-sm border border-info d-flex  .smt justify-content-start m-1 showReplies">View Replies&nbsp;<i class="fas fa-angle-down align-items-center"style="margin-top:0.3em;height:10px;"></i></button>
          <div class="d-flex">
          <button id="' . $row['id'] . '" class="btn btn-sm d-flex justify-content-between .smt btn-outline-danger m-1 delPost">delete</button>
           <button id="' . $row['sender_id'] . '" data-target="#showProfile" data-toggle="modal" class="btn btn-sm d-flex btn-outline-success .smt justify-content-end m-1 showProfile">Profile</button>
           </div>
          </div>
          </div>';
                }
                $output .= '</div>';
                echo $output;
            }
        } else {
            if (isset($cid)) {
                $output = '';


                if ($data) {
                    $output .= '<div>';
                    foreach ($data as $row) {

                        $output .= '<div class="d-flex flex-column bod mt-2 mb-2 p-1">
           <p  class="rounded m-1" >' . $row['message'] . '</p>
           <p  class="rounded m-1" id="textsss" ></p>
           <p class="p-1">' . date('d M Y', strtotime($row['created_at'])) . '</p>
           <div class="d-flex justify-content-between">
           <button id="' . $row['id'] . '" class="btn btn-sm border border-info d-flex  .smt justify-content-start m-1 showReplies">View Replies&nbsp;<i class="fas fa-angle-down align-items-center"style="margin-top:0.3em;height:10px;"></i></button>
           <input class="get" type="hidden" id="' . $row['sender_id'] . '" name="gets">
           <div class="d-flex">
           <button data-target="#replyComment" data-toggle="modal"  id="' . $row['id'] . '" class="btn btn-sm d-flex btn-outline-light text-dark .smt justify-content-end m-1 replyComment">Reply</button>
           <button id="' . $row['sender_id'] . '" data-target="#showProfile" data-toggle="modal" class="btn btn-sm d-flex btn-outline-success .smt justify-content-end m-1 showProfile">Profile</button>
           </div>
           </div>
           </div>';
                    }
                    $output .= '</div>';
                    echo $output;
                }
            } else {
                $output = '';


                if ($data) {
                    $output .= '<div>';
                    foreach ($data as $row) {

                        $output .= '<div class="d-flex flex-column bod mt-2 mb-2 p-1">
           <p  class="rounded m-1" >' . $row['message'] . '</p>
           <p  class="rounded m-1" id="textsss" ></p>
           <p class="p-1">' . date('d M Y', strtotime($row['created_at'])) . '</p>
           <div class="d-flex justify-content-between">
           <button id="' . $row['id'] . '" class="btn btn-sm border border-info d-flex  .smt justify-content-start m-1 showReplies">View Replies&nbsp;<i class="fas fa-angle-down align-items-center"style="margin-top:0.3em;height:10px;"></i></button>
           <input class="get" type="hidden" id="' . $row['sender_id'] . '" name="gets">
           <div class="d-flex">
           <button id="' . $row['sender_id'] . '" data-target="#showProfile" data-toggle="modal" class="btn btn-sm d-flex btn-outline-success .smt justify-content-end m-1 showProfile">Profile</button>
           </div>
           </div>
           </div>';
                    }
                    $output .= '</div>';
                    echo $output;
                }
            }
        }
    }
}

//handle reply comment  modal ajax request
if (isset($_POST['idx'])) {
    $id = $_POST['idx'];
    $row = $cuser->current_comm($id);
    $data = json_encode($row);
    echo $data;
}
//handle get sender_id from comment table ajax request
if (isset($_POST['rid'])) {
    $id = $_POST['rid'];
    $row = $cuser->cur_sender_id($id);
    echo $row[0]['sender_id'];
}
//handle show all replies on a  comment table ajax request
if (isset($_POST['replyId'])) {
    $sender_id = $_POST['replyId'];

    $data = $cuser->getReplies($sender_id);
    $output = '';

    if ($data) {
        $output .= '<div><span  class="d-flex px-1 justify-content-end closee"><button class="btn btn-danger btn-sm">&times;</button></span>';
        foreach ($data as $row) {
            $output .= '<div class="d-flex justify-content-between border border-dark my-2 align-items-center repll w-100">
          <p class="p-1 m-1 w-100">' . $row['replies'] . '</p>
          <div class="d-flex">
          <button data-target="#replyComment" data-toggle="modal"  id="' . $row['id'] . '" class="btn btn-sm d-flex btn-outline-light text-dark .smt justify-content-end m-1 replyPComment">Reply</button>
          <span id="' . $row['reply_id'] . '" data-target="#showProfile" data-toggle="modal"class="btn btn-sm d-flex btn-outline-success .smt justify-content-end m-1 showProfile"><i class="fas fa-user-cog"></i></span>
          </div>
          </div>';
        }
        $output .= '</div>';
        echo $output;
    }
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

//handle store comment ajax request

if (isset($_POST['ids']) && isset($_POST['text']) && isset($_POST['post_ids'])) {
    $post_id = $_POST['post_ids'];
    $chat_id = $_POST['ids'];
  
    $message = $_POST['text'];
    $sender_id = $cid;
    $status = 'unread';
    $sender_name = $cname;

    $cuser->store_comment($post_id, $chat_id, $sender_id, $message, $status,$sender_name);
    return true;
}

//handle save reply ajax request

if (isset($_POST['rid']) && isset($_POST['replyVal'])) {
    $replies = $_POST['replyVal'];
    $reply_id = $_POST['rid'];

    $cuser->save_reply($replies, $reply_id, $cid);
    return true;
}

//Hnadle delete comment post of user ajax request
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];

    $cuser->delete_cpost($id);
}