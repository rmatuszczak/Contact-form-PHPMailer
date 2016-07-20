<?php
  session_start();


  require_once 'PHPMailer/PHPMailerAutoload.php'; //directory to the PHP mailer library

  $errors = [];

  if(isset($_POST['name'],$_POST['email'], $_POST['message'])){

    $fields = [
      'name' => $_POST['name'],
      'email' => $_POST['email'],
      'message' => $_POST['message']
    ];



    // check if the fields are not empty
    foreach($fields as $field => $data){
      if(empty($data)){
        $errors[] = 'The ' . $field . ' field is required.';
      }
    }


    // email address validation
    if (isset($_POST['email']) == true && empty($_POST['email']) == false) {
      $email = $_POST['email'];
      if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
        $errors[] = 'The email address is invalid.';
      }
    }

    //send email of no errors
    if(empty($errors)){
      $mail = new PHPMailer(true);


      $mail->isSMTP(); // comment out while not using on localhost
      $mail->SMTPDebug = 3; // display error information
      $mail->SMTPAuth = true;



      $mail->Host = 'smtp.gmail.com'; //smtp server
      $mail->Username = 'address@domain.com'; //email address
      $mail->Password = 'password'; //password
      $mail->SMTPSecure ='ssl';
      $mail->Port = 465;

      $mail->isHTML(true);

      $mail->Subject = 'Contact form submitted';
      $mail->Body = 'From : ' . $fields['name'] . ' (' . $fields['email'] . ')<p>' . $fields['message'] . '</p>';

      $mail->FromName = 'Contact'; //sender

      $mail->AddAddress('address@domain.com', 'First and last name'); //reciever

      if($mail-> send()) {
        header('Location: thanks.php'); // location of a confirmation message after the email is sent

      } else {
        $errors[] = 'Sorry, could not send email. Try again';
      }
    }

  } else {
    $errors[] = 'Something went wrong.';
  }

  $_SESSION['errors'] = $errors;
  $_SESSION['fields'] = $fields;

  header( 'Location: index.php')
 ?>
