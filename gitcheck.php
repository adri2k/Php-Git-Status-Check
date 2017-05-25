<?php
// Example of cron
// 15 * * * * /usr/bin/php -f /var/www/vhosts/yourdomain.com/httpdocs/gitcheck.php >/dev/null 2>&1

if (!function_exists('shell_exec')) {
    die('shell_exec not aviable!');
}

$cp = __DIR__;

if ($_POST["pp"] == "yourPassword123456"){

    $shell_output = array();
    echo "<h2>Git Commit</h2>";

    $res = shell_exec("cd $cp;git -c user.name='www-data' -c user.email='no-replay@example.org' add . 2>&1 ");
    echo  nl2br($res) . "<br>";

    $res = shell_exec("cd $cp;git -c user.name='www-data' -c user.email='no-replay@example.org' commit -a -m '" . $_POST["Messaggio"] . "' 2>&1 ");
    echo  nl2br($res) . "<br>";

}

$res = shell_exec("cd $cp;git status -s");

if (trim($res) == '') {
    echo '<h2 style="color:green">No GIT difference. OK</h2>';
} else {
    echo "<h2 style='color:red'>GIT difference. NOK</h2>" . nl2br($res);
    ?>
    <br><br>
    To commit difference to repository:<br>
    <form action="/gitcheck.php" method="post">
      Message: <input type="text" name="Messaggio"/><br>
      Password: <input tyoe="text" name="pp"/>
      <br> <input type="submit" name="Commit" value="Commit"/>
    </form>

    <?php
    // Send mail - only for cli
    if (php_sapi_name() == "cli") {
       // The message
      $message = "Directory $cp \r\n \r\n \r\n";
      $message .= "$res\r\n";
      // In case any of our lines are larger than 70 characters, we should use wordwrap()
      $message = wordwrap($message, 70, "\r\n");

      $headers = 'From: info@youdomain.com' . "\r\n" .
      'Reply-To: info@youdomain.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
      mail('youremail@yourdomain.com', 'GIT Difference on YourDomain', $message, $headers);
    }
}


// Show last 10 commit
echo '<br><h3>Last 10 Commit:</h3>';
$res = shell_exec("cd $cp;git log --stat --pretty=short -10");
echo "<pre>" . nl2br($res) . "</pre>";
