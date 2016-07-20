<?php
  session_start();

  require_once 'helpers/security.php';
  require_once 'PHPMailer/PHPMailerAutoload.php';

  $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
  $fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Contact form</title>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <div class="contact">
      <?php if(!empty($errors)): ?>
        <div class="panel">
          <ul>
            <li ><?php echo implode('</li><li>', $errors); ?></li>
          </ul>
        </div>
      <?php endif; ?>
      
    <h1>Contact Us</h1>
    <form action="contact.php" method="post">

        <input class="name" type="text" name="name" autocomplete="off " placeholder="Your Name"<?php echo isset($fields['name']) ? ' value="' . e($fields['name']) . '"' : '' ?>>

        <input class="email" type="text" name="email" autocomplete="off" placeholder="Your Email Address"<?php echo isset($fields['email']) ? ' value="' . e($fields['email']) . '"' : '' ?>>

        <textarea class="message" name="message" rows="8" placeholder="Your Message"><?php echo isset($fields['message']) ? e($fields['message']) : '' ?></textarea>
      <input class="button" type="submit" value="Send" >
        </div>
    </form>
  </body>
</html>

<?php

  unset($_SESSION['errors']);
  unset($_SESSION['fields']);
 ?>
