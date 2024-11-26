<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   <style>
      form {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background: #eef2f7;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

/* Tiêu đề */
form h3 {
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #2c3e50;
}

/* Các trường nhập */
form .box {
    width: 100%;
    padding: 10px 15px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    transition: border 0.3s ease;
}

form .box:focus {
    border-color: #3498db;
    outline: none;
}

/* Nút đăng nhập */
form .btn {
    width: 100%;
    padding: 10px 15px;
    background: #3498db;
    color: #fff;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

form .btn:hover {
    background: #2980b9;
}

/* Liên kết tới đăng ký */
form p {
    text-align: center;
    margin-top: 10px;
    font-size: 0.9rem;
    color: #555;
}

form p a {
    color: #e74c3c;
    text-decoration: none;
    font-weight: bold;
}

form p a:hover {
    text-decoration: underline;
}
   </style>

 <style>
   
 </style>

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>ĐĂNG NHẬP</h3>
      <input type="email" name="email" required placeholder="enter email" class="box">
      <input type="password" name="password" required placeholder="enter password" class="box">
      <input type="submit" name="submit" class="btn" value="Đăng nhập ngay">
      <p>Bạn chưa có tài khoản? <a href="register.php">Đăng ký </a></p>
   </form>

</div>

</body>
</html>