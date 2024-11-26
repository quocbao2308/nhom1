<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <style>
      /* Định dạng tổng thể cho form */
form {
    width: 100%;
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

/* Tiêu đề */
form h3 {
    text-align: center;
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #333;
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
    border-color: #5cb85c;
    outline: none;
}

/* Nút đăng ký */
form .btn {
    width: 100%;
    padding: 10px 15px;
    background: #5cb85c;
    color: #fff;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

form .btn:hover {
    background: #4cae4c;
}

/* Liên kết tới đăng nhập */
form p {
    text-align: center;
    margin-top: 10px;
    font-size: 0.9rem;
    color: #555;
}

form p a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

form p a:hover {
    text-decoration: underline;
}

   </style>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

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
      <h3>ĐĂNG KÝ </h3>
      <input type="text" name="name" required placeholder="enter username" class="box">
      <input type="email" name="email" required placeholder="enter email" class="box">
      <input type="password" name="password" required placeholder="enter password" class="box">
      <input type="password" name="cpassword" required placeholder="confirm password" class="box">
      <input type="submit" name="submit" class="btn" value="Đăng ký ngay">
      <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập Ngay</a></p>
   </form>

</div>

</body>
</html>