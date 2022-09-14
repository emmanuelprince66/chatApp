<?php
require_once 'session.php';

///check to see if a user has a comment
if (isset($cid) && isset($_GET['action']) && $_GET['action'] == 'get_stat') {
   $reciever_username = $cname;
   $data = $cuser->get_statNoti($reciever_username);
   if ($data) {
      foreach ($data as $row) {
         if ($row['msg_status'] == 'unread') {
            echo 'true';
         }
         else echo false;
      }
   }
}

//check to see if user has a message
if (isset($cid) && isset($_GET['action']) && $_GET['action'] == 'get_chatStat') {
   $reciever_username = $cname;

   $data = $cuser->get_userNotiStatus($cid);
   if ($data) {
      foreach ($data as $row) {
         if ($row['status'] == 'unread') {
            echo 'true';
         }
      }
   }
}

//Handle Ajax Request for updating profile
if (isset($_FILES['image'])) {
   $name = $cuser->test_input($_POST['name']);
   $gender = $cuser->test_input($_POST['gender']);
   $dob = $cuser->test_input($_POST['dob']);
   $phone = $cuser->test_input($_POST['phone']);
   $description = $cuser->test_input($_POST['description']);

   $oldImage = $_POST['oldimage'];
   if (!is_dir('uploads')) {
      mkdir('uploads');
   }

   if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
      $newImage = 'uploads/' . $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], $newImage);

      if ($oldImage != null) {
         unlink($oldImage);
      }
   } else {
      $newImage = $oldImage;
   }
   $cuser->update_profile($name, $gender, $dob, $phone, $newImage, $description, $cid);
}

//update posts displyed by user ajax request

if (isset($_FILES['img'])) {
   $title = $cuser->test_input($_POST['title']);
   $descript = $cuser->test_input($_POST['descript']);
   $id = $cuser->test_input(($_POST['id']));


   $image = $_FILES['img'];

   if (!is_dir('image')) {
      mkdir('image');
   }

   $photo = 'image/' . $cuser->randomString(8) . '/' . $image['name'];
   mkdir(dirname($photo));
   move_uploaded_file($image['tmp_name'], $photo);

   $cuser->update_post($id, $title, $descript, $photo);
}

//Handle store post Of user ajax request
if (isset($_POST['action']) && $_POST['action'] == 'store_posts') {

   $title = $cuser->test_input($_POST['title']);
   $descript = $cuser->test_input($_POST['descript']);
   $image = $cuser->test_input($_POST['img']);


   $cuser->store_posts($cid, $title, $descript, $image);
}

//input likes in post ajax request
if (isset($_POST['likes']) && isset($_POST['post_id'])) {
   $likes = $_POST['likes'];
   $post_id = $_POST['post_id'];
   $style = 'shcl';

   $cuser->inPost_likes($likes, $style, $post_id);
   return true;
}

//input dislikes in post ajax request
if (isset($_POST['dislikes']) && isset($_POST['post_id'])) {
   $dislikes = $_POST['dislikes'];
   $post_id = $_POST['post_id'];
   $distyle = 'shcl';

   $cuser->inPost_dislikes($dislikes, $distyle, $post_id);
   return true;
}

//display all  user post
if (isset($_POST['action']) && $_POST['action'] == 'display_posts') {
   $data = $cuser->getPosts();

   if (isset($cid)) {
      $style = $cuser->get_rating($cid);
   }




   $output = '';

   if ($data) {
      if (isset($cid) && $cid == isset($style[0]['user_id'])) {
         $output .= '<div class="container row epp ">';
         foreach ($data as $row) {

            $output .= '<div class="container-item pt-4 ">
          <div class="card el">
           <img class="card-img-top img-fluid img-thumbnail hii " src="asset/php/' . $row['image'] . '">
          <div class="card-body">
          <div class="d-flex justify-content-between align-items-center pb-2">
          <h5 class="card-title text-capitalize">' . $row['title'] . '</h2>
          <button data-target="#moreDetails" data-toggle="modal"  id="' . $row['id'] . '" class="btn btn-sm btn-outline-primary moreDetails">More</button>
          </div>
          <p class="card-text">' . substr($row['descript'], 0, 25) . '.....</p>
          <p class="card-text">' . date('d M Y', strtotime($row['created'])) . '</p>
          <div class="card-footer bg-secondary d-flex justify-content-between">
          
          <div class=" bg-primary d-flex  justify-content-center align-items-center count">
          <i class="far fa-thumbs-up like-btn rmcls ' . $row['style'] . ' " id = "' . $row['id'] . '"></i>&nbsp;&nbsp;
          <span class="likes text-light pt-1">' . $row['likes'] . '</span>
          </div>

          <div class=" bg-danger d-flex justify-content-center align-items-center count">
          <i class=" far fa-thumbs-down dislike-btn rmcls ' . $row['distyle'] . ' " id = "' . $row['id'] . '"></i>&nbsp;&nbsp;
          <span class="dislikes text-light pt-1 ">' . $row['dislikes'] . '</span>
          </div>
          
          <button id="' . $row['post_id'] . '" class="btn btn-outline-info showProfile"><i class="fas fa-user"></i></button>

          <form action="chat.php" method="post">
              <input type="hidden" name="postid" id="postId" value="'.$row['post_id'].'">        
              <input type="hidden" name="id" id="Id" value="'.$row['id'].'">        
                        <button type="submit" class="btn btn-outline-success notificn" id="' . $row['post_id'] . '"> <i class="fa fa-comment"></i></button>     
          </form>

          </div>
          </div>
          </div>
          </div>';
         }
         $output .= '</div>';
         echo $output;
      } else {
         $output .= '<div class="container row epp ">';
         foreach ($data as $row) {
            $output .= '<div class="container-item pt-4 ">
          <div class="card el">
           <img class="card-img-top img-fluid img-thumbnail hii " src="asset/php/' . $row['image'] . '">
          <div class="card-body">
          <div class="d-flex justify-content-between align-items-center pb-2">
          <h5 class="card-title text-capitalize">' . $row['title'] . '</h2>
          <button data-target="#moreDetails" data-toggle="modal"  id="' . $row['id'] . '" class="btn btn-sm btn-outline-primary moreDetails">More</button>
          </div>
          <p class="card-text">' . substr($row['descript'], 0, 25) . '.....</p>
          <p class="card-text">' . date('d M Y', strtotime($row['created'])) . '</p>
          <div class="card-footer bg-secondary d-flex justify-content-between">
          
          <div class=" bg-primary d-flex  justify-content-center align-items-center count">
          <i class="far fa-thumbs-up like-btn rmcls" id = "' . $row['id'] . '"></i>&nbsp;&nbsp;
          <span class="likes text-light pt-1">' . $row['likes'] . '</span>
          </div>

          <div class=" bg-danger d-flex justify-content-center align-items-center count">
          <i class=" far fa-thumbs-down dislike-btn rmcls" id = "' . $row['id'] . '"></i>&nbsp;&nbsp;
          <span class="dislikes text-light pt-1 ">' . $row['dislikes'] . '</span>
          </div>
          
          <button id="' . $row['post_id'] . '" class="btn btn-outline-info showProfile"><i class="fas fa-user"></i></button>
             <form action="chat.php" method="post">
     <input type="hidden" name="postid" id="postId" value="' . $row['post_id'] . '">        
              <input type="hidden" name="id" id="Id" value="' . $row['id'] . '">   
                        <button type="submit" class="btn btn-outline-success notificn" id="' . $row['post_id'] . '"> <i class="fa fa-comment"></i></button>     
          </form>
          
          </div>
          </div>
          </div>
          </div>';
         }
         $output .= '</div>';
         echo $output;
      }
   }
}

//input like ajax

if (isset($_POST['action']) && isset($_POST['post_id']) && isset($cid)) {
   $post_id = $_POST['post_id'];
   $action = $_POST['action'];




   $user_id = $cid;

   switch ($action) {
      case 'like':
         $cuser->input_like($post_id, $user_id, $action);
         break;
      case 'dislike':
         $cuser->input_dislike($post_id, $user_id, $action);
         break;
      case 'unlike':
         $cuser->input_unlike($user_id, $post_id);
         break;
      case 'undislike':
         $cuser->input_undislike($user_id, $post_id);
         break;
      default:
         break;
   }



   $rating = array();
   $likes = $cuser->like_query($post_id);
   $dislikes = $cuser->dislike_query($post_id);
   $rating = [
      'likes' => $likes[0],
      'dislikes' => $dislikes[0]
   ];
   echo json_encode($rating);
   exit(0);
}


//get all comments on users posts notification
if (isset($cid) && isset($_GET['action']) && $_GET['action'] == 'get_comNoti') {
   $status = 'unread';
   $data = $cuser->getUserComs($status);
   
   $output = '';
   if ($data) {
      
      $output .= '<div>';
      foreach ($data as $row) {
         if ($cid == $row['chat_id']) {
            $output .= '<div class="mb-4">
            <div class="d-flex mt-2 jik justify-content-between align-items-center">
            <div class="d-flex align-items-center">
               <p  style="font-weight:bolder;" class="text-danger text-capitalize">'.$row['sender_name']. '</p>&nbsp;&nbsp;<p>
               commented on your post.</p>
               </div>

      <form action="chat.php" method="post">
          <input type="hidden" name="postid" id="postId" value="' . $row['chat_id'] . '">        
              <input type="hidden" name="id" id="Id" value="' . $row['post_id'] . '">   
                        <button type="submit" class="btn btn-primary btn-sm but" id="' . $row['id'] . '">View post</button>     
             </form>
</div>
</div>';
 } 
}
$output .= '</div>';
echo $output;
}
}

//Handle delete posts of a user
if (isset($_POST['del_id'])) {
$id = $_POST['del_id'];

$cuser->delete_post($id);
}

//Handle Display manage posts of a User
if (isset($_POST['action']) && $_POST['action'] == 'display_mPosts') {
$output = '';

$posts = $cuser->get_mPosts($cid);

if ($posts) {
$output .= ' <table class="table table-striped table-sm text-center">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Posts</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
        foreach ($posts as $row) {
        $output .= '<tr>
            <td>' . $row['id'] . '</td>
            <td>' . $row['title'] . '</td>
            <td>' . substr($row['descript'], 0, 60) . '....</td>
            <td class="d-flex justify-content-center sp">
                <a href="#" id="' . $row['id'] . '" title="View Details" class="text-success infoBtn">
                    <i class="fas fa-info-circle fa-lg"></i>&nbsp;&nbsp;
                </a>

                <a href="#" id="' . $row['id'] . '" title="Edit Posts" class="text-primary editBtn">
                    <i class="fas fa-edit fa-lg" data-toggle="modal" data-target="#editPostModal"></i>&nbsp;
                </a>
                <a href="#" id="' . $row['id'] . '" title="Delete Posts" class="text-danger deleteBtn">
                    <i class="fas fa-trash-alt fa-lg"></i>&nbsp;
                </a>
            </td>
        </tr>';
        }
        $output .= ' </tbody>
</table>';
echo $output;
} else {
echo 'You Have Not Created Any Post Yet, Create Your First Post Now! &nbsp; <a href="home.php">here</a>';
}
}

//handle notification ajax request
if (isset($_POST['post_ids']) && isset($_POST['ids']) && isset($_POST['sid'])) {
$id = $_POST['ids'];



$notification = 'you have a notification!';
$cuser->update_noti($notification,$id);
echo 'completed';

}

//handle click post notification
if (isset($cid) && isset($_POST['p_id'])) {
$post_id = $_POST['p_id'];
if ($cid == $post_id) {
$id = $_POST['p_id'];
$pid = 0;
$notification = '';
$sid = 0;

$data = $cuser->delnRecords($id, $sid, $pid, $notification);
return true;
}
}

//delete all records notification request
if (isset($_POST['delnId'])) {

$id = $_POST['delnId'];
$status = 'read';
$cuser->update_notiStatus($id,$status);

$pid = 0;
$notification = '';
$sid = 0;

$data = $cuser->delnRecords($cid, $sid, $pid, $notification);

}

//Handle ajax request for display posts in details in manage
if (isset($_POST['info_id'])) {
$id = $_POST['info_id'];
$row = $cuser->mDetails_post($id);
echo json_encode($row);
}

//handle display more details modal ajax request
if (isset($_POST['idd'])) {
$idd = $_POST['idd'];


$row = $cuser->current($idd);
echo json_encode($row);
}


//handle show profile details modal ajax request
if (isset($_POST['iss'])) {
$iss = $_POST['iss'];



$data = $cuser->uProfile_post($iss);
$output = '';

if ($data) {
if ($data[0]['photo'] != '') {

$output .= '<div class="card w-100" style="max-height:30%;">';
    foreach ($data as $row) {
    $output .= '<div class="card-body py-4 text-dark text-center">
        <img class="img-thumbnail" src=' . ' asset/php/' . $row['photo'] . ' style="height:250px;width:250px;">
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>Name : </strong>' . $row['name'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Gender : </strong>' . $row['gender'] . '</p>
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>Date Of Birth : </strong>' . $row['dob'] . '</p>
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>About Me : </strong>' . $row['descript'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Email : </strong>' . $row['email'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Phone : </strong>' . $row['phone'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Joined At : </strong>' . date( 'd M Y' ,
            strtotime($row['created_at']) ) . '</p>
         </div>' ; } $output .='</div>' ; echo $output; } 
         else 
         { 
            $output.='<div class="card w-100" style="max-height:30%;">' ; 
            foreach ($data as $row) 
            { 
               $output .='<div class="card-body py-4 text-dark text-center">
         <img class="img-thumbnail" src="asset/images/icon.png"   style="height:250px;width:250px;">
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>Name : </strong>' . $row['name'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Gender : </strong>' . $row['gender'] . '</p>
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>Date Of Birth : </strong>' . $row['dob'] . '</p>
         <p  class="card-text text-capitalize p-2 m-1 rounded" ><strong>About Me : </strong>' . $row['descript'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Email : </strong>' . $row['email'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Phone : </strong>' . $row['phone'] . '</p>
         <p  class="card-text  text-capitalize p-2 m-1 rounded" ><strong>Joined At : </strong>' . date( 'd M Y' ,
            strtotime($row['created_at']) ) . '</p>
         </div>' ; } $output .='</div>' ; echo $output; } } }; 
         
         //Handle Edit Post of a User Ajax Request 
           if(isset($_POST['edit_id'])) {
             $id = $_POST['edit_id']; 
             $row=$cuser->mDetails_post($id);

             echo json_encode($row);
        };