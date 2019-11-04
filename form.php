<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// check honeypot
if(empty($_POST["website"])){

// we initiate an array that will contain any potential errors.
$errors = array();

// 1. Sanitization
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

// 2. Validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   $errors['email'] = "This address is invalid.";
}

// 3. execution
if (count($errors)> 0){
	echo "There are mistakes!";
	print_r($errors);
	exit;
} else {
  $gender = $_POST['gender'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $country = $_POST['country'];
  switch ($_POST['subject']) {
    case '1':
    $subject = "others";
    break;
    case '2':
    $subject = "order";
    break;
    default:
    $subject = "technical support";
  };
  $message = $_POST['message'];
}

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'becode.liege.jepsen2.14@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 'BeCode@Liege+Jepsen-2.14';
//Set who the message is to be sent from
$mail->setFrom('becode.liege.jepsen2.14@gmail.com', 'Hackers Poulette');
//Set an alternative reply-to address
$mail->addReplyTo($email, $email);
//Set who the message is to be sent to
$mail->addAddress($email, $email);
//Set the subject line
$mail->Subject = "[Hackers Poulette] contact form - $subject";
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->isHTML(true);
$mail->Body = "<p>$gender<br>$firstname $lastname,<br>from $country</p><p>$message</p>";
//Replace the plain text body with one created manually
$mail->AltBody = "$gender $firstname $lastname from $country wrote : $message";
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: '. $mail->ErrorInfo;
} 

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);
    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/css/style.css">
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.css" media="screen,projection" />
  <!--Fontawesome-->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!--Favicon-->
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
  <title>Contact Form</title>
</head>

<body>
  <!--Header-->
  <header role=”banner”>
    <nav role=”navigation” id="header-nav">
      <div class="nav-wrapper">
        <img class="brand-logo center" id="logo" src="assets/img/hackers-poulette-logo.png" alt="logo">
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="sass.html">Home</a></li>
          <li><a href="badges.html">About</a></li>
          <li><a href="collapsible.html">Shop</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!--Main-->
  <main role="main">
    <div class="container">
      <div class="row">
        <div class="col s12 center">
            <h5>Your message has been sent. We'll be in touch shortly!</h5>
        </div>
      </div>
    </div>
  </main>

  <!--Footer-->
  <footer role=”contentinfo” class="page-footer">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Mailing list</h5>
          <p class="grey-text text-lighten-4">We send out regular ipdates about what we're up to. If you'd like to
            receive these straight to your mailbox, please enter your email address below.</p>
          <div class="input-field col s9">
            <label for="email_news" id="label_news">Email</label>
            <input name="email_news" id="email_news" type="email" class="validate">
          </div>
          <button class="btn waves-effect waves-light right" id="button_news" type="submit" name="submit">
            Submit
          </button>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            <li><a class="grey-text text-lighten-3" href="#!">
                <div class="icon">
                  <i class="fa fa-twitter circle blue"></i>
                </div>
              </a></li>
            <li><a class="grey-text text-lighten-3" href="#!">
                <div class="icon">
                  <i class="fa fa-facebook circle blue darken-4"></i>
                </div>
              </a></li>
            <li><a class="grey-text text-lighten-3" href="#!">
                <div class="icon">
                  <i class="fa fa-youtube-play circle red accent-4"></i>
                </div>
              </a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        © 2019 Hackers Poulette
        <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
      </div>
    </div>
  </footer>

  <!--JavaScript at end of body for optimized loading-->
  <script type="text/javascript" src="js/materialize.js"></script>
</body>
</html>

<?php } else {
    echo 'No spam!';
}
?>