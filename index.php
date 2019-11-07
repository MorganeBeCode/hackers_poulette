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
  <link rel="shortcut icon" href="assets/img/chicken.png" type="image/x-icon">
  <title>Contact Form</title>
</head>

<body>
  <!--Header-->
  <header role='banner'>
    <nav role='navigation' id="header-nav">
      <div class="nav-wrapper">
        <img class="brand-logo center" id="logo" src="assets/img/hackers-poulette-logo.png" alt="logo">
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Shop</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <!--Form-->
  <main role='main'>
    <div class="container">
      <div class="row">
        <form name="form" class="col s12" method="post" action="form.php">
          <h3>Contact us<img id="chicken" src="assets/img/chicken.png" alt="icon chicken"></h3>
          <div class="row">
            <!--Lastname input-->
            <div class="input-field col s5">
              <label for="lastname">Last Name<abbr title="Please fill out this field">*</abbr></label>
              <input name="lastname" id="lastname" type="text" class="validate" required aria-required="true">
              <span class="helper-text" data-error="Lastname is required" data-success="OK"></span>
            </div>
            <!--Firstname input-->
            <div class="input-field col s5 offset-s1">
              <label for="firstname">First Name<abbr title="Please fill out this field">*</abbr></label>
              <input name="firstname" id="firstname" type="text" class="validate" required aria-required="true">
              <span class="helper-text" data-error="Firstname is required" data-success="OK"></span>
            </div>
            <!--Gender radio buttons-->
            <div class="input-field col s5">
              <fieldset>
                <legend>Gender<abbr title="Please fill out this field">*</abbr></legend>
                <label for="male" class="genders">
                  <input type="radio" name="gender" value="male" id="male" required aria-required="true" />
                  <span>Male</span>
                </label>
                <label for="female" class="genders">
                  <input type="radio" name="gender" value="female" id="female" />
                  <span>Female</span>
                </label>
                <label for="other" class="genders">
                  <input type="radio" name="gender" value="other" id="other" />
                  <span>Other</span>
                </label>
                <span class="helper-text" data-error="Gender is required" data-success="OK"></span>
              </fieldset>
            </div>
            <div class="col offset-s7"></div>
            <!--Email input-->
            <div class="input-field col s6">
              <label for="email">Email<abbr title="Please fill out this field">*</abbr></label>
              <input name="email" id="email" type="email" class="validate" required aria-required="true">
              <span class="helper-text" data-error="Invalid format, please check your email address" data-success="OK"></span>
            </div>
            <div class="col offset-s6"></div>
          </div>
          <!--Countries select-->
          <div class="row">
            <div class="input-field col s4">
              <?php include 'countries.php'; ?>
              <label for="country" class="active">Country<abbr title="Please fill out this field">*</abbr></label>
              <select name="country" id="country" class="browser-default validate" required aria-required="true">
                <option name="select" value="" disabled selected>Please select your country</option>
                <?php foreach ($countries as $country) {
                  echo '<option name="' . $country . '"value="' . $country . '">' . $country . '</option>';
                } ?>
              </select>
              <span class="helper-text" data-error="Country is required" data-success="OK"></span>
            </div>
            <div class="col offset-s8"></div>
          </div>
          <!--Subject select-->
          <div class="row">
            <div class="input-field col s3">
              <label for="subject" class="active">Subject</label>
              <select name="subject" id="subject" class="browser-default">
                <option name="order" value="1">Order</option>
                <option name="technical_support" value="2">Technical support</option>
                <option name="others" value="3" selected>Others</option>
              </select>
            </div>
            <div class="col offset-s9"></div>
          </div>
          <!--Message input-->
          <div class="row">
            <div class="input-field col s12">
              <label for="message">Message<abbr title="Please fill out this field">*</abbr></label>
              <textarea name="message" id="message" class="materialize-textarea validate" required aria-required="true"></textarea>
              <span class="helper-text" data-error="Message is required" data-success="OK"></span>
            </div>
          </div>
          <!--HONEYPOT-->
          <div class="input-field col s12 hide">
            <input id="website" name="website" type="text">
            <label for="website">Website</label>
          </div>
          <!--Send button-->
          <button class="btn waves-effect waves-light right" type="submit" name="action">Send message
            <i class="material-icons right">send</i>
          </button>
        </form>
      </div>
    </div>
  </main>

  <!--Footer-->
  <footer role='contentinfo' class="page-footer" id="footer">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Mailing list</h5>
          <p class="grey-text text-lighten-4">We send out regular ipdates about what we're up to. If you'd like to
            receive these straight to your mailbox, please enter your email address below.</p>
          <div class="input-field col s9">
            <label for="email_news" id="label_news">Email</label>
            <input name="email_news" id="email_news" type="email" class="validate">
            <span class="helper-text" data-error="Invalid format, please check your email address"></span>
          </div>
          <button class="btn waves-effect waves-light right" id="button_news" type="submit" name="submit">
            Submit
          </button>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            <li><a class="grey-text text-lighten-3" href="#" aria-label="Twitter">
                <div class="icon">
                  <i class="fa fa-twitter circle blue"></i>
                </div>
              </a></li>
            <li><a class="grey-text text-lighten-3" href="#" aria-label="Facebook">
                <div class="icon">
                  <i class="fa fa-facebook circle blue darken-4"></i>
                </div>
              </a></li>
            <li><a class="grey-text text-lighten-3" href="#" aria-label="Youtube">
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
        <span class="right">
          <a target="_blank" href="https://icons8.com/icons/set/chicken">Chicken</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>
        </span>
      </div>
    </div>
  </footer>

  <!--JavaScript at end of body for optimized loading-->
  <script type="text/javascript" src="materialize/materialize.js"></script>
</body>

</html>