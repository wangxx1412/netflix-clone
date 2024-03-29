<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

$account = new Account($con);

if (isset($_POST["submitButton"])) {
  $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
  $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
  $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
  $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
  $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
  $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
  $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

  $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

  if ($success) {
    $_SESSION["userLoggedIn"] = $username;
    header("Location:index.php");
  }
}

function getInputValue($name)
{
  if (isset($_POST[$name])) {
    echo $_POST[$name];
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Welcome to Netflix-C</title>
  <link rel="stylesheet" href="assets/style/style.css" type="text/css">
</head>

<body>
  <div class="signInContainer">

    <div class="column">
      <div class="header">
        <img src="https://fontmeme.com/permalink/191213/f72a2b91cefd2ccca690b07344af9fb3.png" title="logo" alt="site-logo" />
        <h3>
          Sign up
        </h3>
        <span>to continue to netflix</span>

      </div>
      <form method="POST">

        <?php echo $account->getError(Constants::$firstNameCharacters); ?>
        <input type="text" placeholder="First Name" name="firstName" value="<?php getInputValue("firstName"); ?>" required>

        <?php echo $account->getError(Constants::$lastNameCharacters); ?>
        <input type="text" placeholder="Last Name" name="lastName" value="<?php getInputValue("lastName"); ?>" required>

        <?php echo $account->getError(Constants::$usernameCharacters); ?>
        <?php echo $account->getError(Constants::$usernameTaken); ?>
        <input type="text" placeholder="UserName" name="username" value="<?php getInputValue("username"); ?>" required>

        <?php echo $account->getError(Constants::$emailsDontMatch); ?>
        <?php echo $account->getError(Constants::$emailsInvalid); ?>
        <?php echo $account->getError(Constants::$emailsTaken); ?>
        <input type="email" placeholder="Email" name="email" value="<?php getInputValue("email"); ?>" required>
        <input type="email" placeholder="Confirm Email" name="email2" value="<?php getInputValue("email2"); ?>" required>

        <?php echo $account->getError(Constants::$passwordDontMatch); ?>
        <?php echo $account->getError(Constants::$passwordLength); ?>
        <input type="password" placeholder="Password" name="password" required>
        <input type="password" placeholder="Confirm Password" name="password2" required>

        <input type="submit" value="Submit" name="submitButton">
      </form>
      <a href="login.php" class="signInMsg">Already have an account? Sign in here!</a>
    </div>
  </div>
</body>

</html>