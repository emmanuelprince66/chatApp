<?php
require_once 'config.php';

class Auth extends Database
{


  //Register new user..
  public function register($name, $email, $password)
  {
    $sql = "INSERT INTO users(name , email , password) VALUES(:name , :email, :pass)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["name" => $name, "email" => $email, "pass" => $password]);
    return true;
  }

  //check if user is already registered..
  public function user_exist($email)
  {
    $sql = "SELECT email FROM users WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
  }

  //get all users  already registered..
  public function get_statNoti($reciever_username)
  {
    $sql = "SELECT * FROM users_chat WHERE reciever_username =:reciever_username";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['reciever_username' => $reciever_username]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  //get all users  already registered..
  public function get_users()
  {
    $sql = "SELECT * FROM users ORDER BY created_at ASC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  //current user in session
  public function currentUser($email)
  {
    $sql = " SELECT * FROM users WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["email" => $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  //insert into user_chat..
  public function insert_msl($user_name, $username, $msg_content) 
  {
    $sql = "INSERT INTO users_chat(sender_username , reciever_username , msg_content,msg_status,msg_date) 
    VALUES(:user_name , :username, :msg_content, 'unread' , NOW())";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['user_name' => $user_name, 'username' => $username, 'msg_content' => $msg_content]);
    return true;
  }


  //update message status chat_user
  public function update_cstatus($user_name, $username)
  {
    $sql = "UPDATE users_chat SET msg_status = 'read' WHERE sender_username= :username AND reciever_username= :user_name";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
      "username" => $username, "user_name" => $user_name
    ]);
    return true;
  }

  //get totla messages i user_chats
  public function total_messages($user_name, $username)
  {
    $sql = " SELECT msg_content FROM users_chat WHERE (sender_username= :user_name AND reciever_username= :username) 
    OR (reciever_username=:user_name AND sender_username=:username)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["username" => $username, "user_name" => $user_name]);
    $row = $stmt->rowCount();

    return $row;
  }
  //get * from user_chats
  public function get_mes($user_name, $username)
  {
    $sql = " SELECT * FROM users_chat WHERE (sender_username= :user_name AND reciever_username= :username) 
    OR (reciever_username=:user_name AND sender_username=:username) ORDER BY 1 ASC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["username" => $username, "user_name" => $user_name]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $row;
  }
  //get username fo clicked
  public function get_username($id)
  {
    $sql = " SELECT * FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["id" => $id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $row;
  }

  //handle show profile details of user
  public function uProfile_post($id)
  {
    $sql = " SELECT * FROM users WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(["id" => $id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $row;
  }
  //login Existing  User
  public function login($email)
  {
    $sql = "SELECT email , password FROM users WHERE email = :email";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
  }

  //get * data from profile table
  public function getProfile($user_id)
  {
    $sql = 'SELECT * FROM profiles WHERE user_id = :user_id ';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
  }
  //Update profile ajax request
  public function update_profile($name, $gender, $dob, $phone, $photo, $descript, $id)
  {
    $sql = "UPDATE users SET name = :name , gender = :gender , dob = :dob , phone =:phone , photo = :photo, descript =:descript  WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['name' => $name, 'gender' => $gender, 'dob' => $dob, 'phone' => $phone, 'photo' => $photo, 'descript' => $descript,  'id' => $id]);
    return true;
  }

  //store posts ajax request
  public function store_posts($post_id, $title, $descript, $image)
  {
    $sql = 'INSERT INTO posts (post_id,title,descript,image) VALUES(:post_id,:title,:descript,:image)';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['post_id' => $post_id, 'title' => $title, 'descript' => $descript, 'image' => $image]);
    return true;
  }


  // get all posts from posts table and user table
  public function  getPosts()
  {
    $sql = 'SELECT * FROM users INNER JOIN posts ON users.id = posts.post_id  ORDER BY created DESC';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }


  // get all posts from posts table and user table
  public function  getPostsId($id)
  {
    $sql = 'SELECT * FROM posts WHERE id =:id';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  //current posts  in session
  public function current($id)
  {
    $sql = "SELECT * FROM posts  WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  //current comment  in session
  public function current_comm($id)
  {
    $sql = "SELECT * FROM comments  WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  //Fetch All posts of a User for manage posts
  public function get_mPosts($post_id)
  {
    $sql = "SELECT * FROM posts WHERE post_id = :post_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['post_id' => $post_id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  //dispaly details of post in manage
  public function mDetails_post($id)
  {
    $sql = "SELECT * FROM posts WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  //select all users that comented on post
  public function getUserComs($status)
  {
    $sql = "SELECT * FROM comments WHERE status = :status ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['status' => $status]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }
  //select username for notification
  public function getAll_p($id)
  {
    $sql = "SELECT * FROM posts WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  //Delete posts of a user
  public function delete_post($id)
  {
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return true;
  }

  //Delete user record notification request
  public function delnRecords($id, $sid, $pid, $notification)
  {
    $sql = "UPDATE users SET sid = :sid , pid = :pid , notification = :notification WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id, 'pid' => $pid, 'sid' => $sid, 'notification' => $notification]);
    return true;
  }
  //update status from unread to read
  public function update_notiStatus($id,$status)
  {
    $sql = "UPDATE comments SET status = :status  WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id, 'status' => $status]);
    return true;
  }

  //add style to users table
  public function set_clas($id, $style)
  {
    $sql = "UPDATE users SET style = :style WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id, 'style' => $style]);
    return true;
  }
  //update status of user to show online users
  public function set_date($status, $id)
  {
    $sql = "UPDATE users SET status = :status WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['status' => $status, 'id' => $id]);
    return true;
  }

  //remove style to users table
  public function rem_clas($id, $style)
  {
    $sql = "UPDATE users SET style = :style WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id, 'style' => $style]);
    return true;
  }
  //Delete comment posts 
  public function delete_cpost($id)
  {
    $sql = "DELETE FROM comments WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return true;
  }

  //save reply ajax request
  public function save_reply($replies, $sender_id, $reply_id)
  {
    $sql = 'INSERT INTO reply (replies,sender_id,reply_id) VALUES(:replies,:sender_id,:reply_id)';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['replies' => $replies, 'sender_id' => $sender_id, 'reply_id' => $reply_id]);
    return true;
  }

  //Update post of a user
  public function update_post($id, $title, $descript, $image)
  {
    $sql = "UPDATE posts SET title = :title , descript = :descript , image = :image WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['title' => $title, 'descript' => $descript, 'image' => $image, 'id' => $id]);

    return true;
  }

  //Update post of by adding likes count()
  public function inPost_likes($likes, $style, $id)
  {
    $sql = "UPDATE posts SET likes = :likes , style = :style WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['likes' => $likes, 'style' => $style, 'id' => $id]);

    return true;
  }

  //Update post of by adding dislikes count()
  public function inPost_dislikes($dislikes, $distyle, $id)
  {
    $sql = "UPDATE posts SET dislikes = :dislikes , distyle = :distyle WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['dislikes' => $dislikes, 'distyle' => $distyle, 'id' => $id]);

    return true;
  }

  //case like

  function input_like($post_id, $user_id, $rating_action)
  {
    $sql = "INSERT INTO rating_info (post_id,user_id,rating_action) 
    VALUES(:post_id,:user_id,:rating_action) ON DUPLICATE KEY UPDATE rating_action='like'";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['post_id' => $post_id, 'user_id' => $user_id, 'rating_action' => $rating_action]);
    return true;
  }

  //case dislike
  function input_dislike($post_id, $user_id, $rating_action)
  {
    $sql = "INSERT INTO rating_info (post_id,user_id,rating_action) 
    VALUES(:post_id,:user_id,:rating_action) ON DUPLICATE KEY UPDATE rating_action='dislike'";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['post_id' => $post_id, 'user_id' => $user_id, 'rating_action' => $rating_action]);
    return true;
  }


  //get  number of likes query

  function like_query($post_id)
  {
    $sql = "SELECT COUNT(*) FROM rating_info WHERE post_id = :post_id AND rating_action='like' ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute((['post_id' => $post_id]));

    $likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $likes;
  }

  //get all rating data

  function get_rating($user_id)
  {
    $sql = "SELECT * FROM rating_info WHERE user_id=:user_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);

    $likes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $likes;
  }

  //get  number of dislikes query

  function dislike_query($post_id)
  {
    $sql = "SELECT COUNT(*) FROM rating_info WHERE post_id = :post_id AND rating_action='dislike' ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute((['post_id' => $post_id]));

    $dislike = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $dislike;
  }
  //case unlike
  function input_unlike($user_id, $post_id)
  {
    $sql = "DELETE FROM rating_info WHERE user_id=:user_id AND post_id=:post_id";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);
    return true;
  }


  //case undislike
  function input_undislike($user_id, $post_id)
  {
    $sql = "DELETE FROM rating_info WHERE user_id=:user_id AND post_id = :post_id";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['user_id' => $user_id, 'post_id' => $post_id]);
    return true;
  }

  //Update notification of a user
  public function update_noti($notification,$id)
  {
    $sql = "UPDATE users SET notification = :notification WHERE id = :id ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['notification' => $notification, 'id' => $id]);

    return true;
  }

  //get all data from reciver 

  public function get_userNotiStatus($post_id)
  {
    $sql = 'SELECT * FROM comments WHERE post_id =:post_id';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['post_id' => $post_id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  //get all data from reciver 

  public function getRecivId($chat_id)
  {
    $sql = 'SELECT * FROM comments WHERE chat_id =:chat_id  ORDER BY created_at DESC';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['chat_id' => $chat_id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  //get all replies from reply table
  public function getReplies($sender_id)
  {
    $sql = 'SELECT * FROM reply WHERE sender_id =:sender_id';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['sender_id' => $sender_id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  //get curen sender_id from coment table 
  public function cur_sender_id($id)
  {
    $sql = 'SELECT sender_id FROM comments WHERE id =:id';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  //store comments in database
  public function store_comment($post_id, $chat_id, $sender_id, $message, $status,$sender_name)
  {
    $sql = 'INSERT INTO comments (post_id,chat_id,sender_id,message,status,sender_name)
     VALUES(:post_id,:chat_id,:sender_id,:message,:status,:sender_name)';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['post_id' => $post_id, 'chat_id' =>
     $chat_id, 'sender_id' => $sender_id, 'message' => $message, 'status' => $status,'sender_name' => $sender_name]);
    return true;
  }
}