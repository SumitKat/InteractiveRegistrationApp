<?php
session_start();
$last_id=0;

//including all the required files
require_once("../config/ini_config.php");
require_once("../config/config.php");
require_once('../api/dbquery.php');
require_once("../controller/create_email.php");

$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}

//Generating a random token
$token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@";
$token = str_shuffle($token);
$token = substr($token, 0, 15);

$usr = new DbQuery();
$array=[];
$array['email'] = $_POST['loginEmail'];
$array['password'] = hash('sha256', $_POST['loginPassword']);
$array['phone'] = $_POST['phone'];
$array['name'] = $_POST['name'];
$array['dob'] = $_POST['dob'];
$array['gender'] = $_POST['gender'];
$array['token'] = $token;
$usr->insert('user', $array);
$last_id = $usr->exec();

$add=new DbQuery();
 
$address = [];
$address['user_id'] = $last_id;
$address['street'] = $_POST['street'];
$address['state'] = $_POST['state'];
$address['city'] = $_POST['city'];
$address['country'] = $_POST['country'];

//call to insert function of DbQuery Class
$add -> insert('address', $address);
$add -> exec();

$interestLength = count($_POST[ 'interests' ]);
$i = 0;
$interest = "";

while ($i < $interestLength-1) {
    $interest .= $_POST[ 'interests' ][$i].',' ;
    $i++;
}

$interest .= $_POST[ 'interests' ][$interestLength-1];
$email = $_POST['loginEmail'];
$int = new DbQuery();
$intrst = [];
$intrst['user_id'] = $last_id;
$intrst['interest'] = $interest;

$mail->addAddress($email);
$mail->Subject = "Please verify your email address";
$mail->isHTML(true);

$Body = " <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>
            <table class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <p>Hi there,</p>
                        <p>Sometimes you just want to send a simple HTML email with a simple design and clear call to action. This is it.</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td> <a href="http://htmlemail.io" target="_blank">Call To Action</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p>This is a really simple email template. Its sole purpose is to get the recipient to click the button with no distractions.</p>
                        <p>Good luck! Hope it works.</p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                    <br> Don't like these emails? <a href="http://i.imgur.com/CScmqnj.gif">Unsubscribe</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="http://htmlemail.io">HTMLemail</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>";

$mail->Body = "
Please Click on the link below<br></br>

<a href = 'http://172.16.8.221/interactive/controller/email_verify.php?email=$email&token=$token'>Click Here</a>


";
if (!$mail->send()) {
    echo 'Message was not sent.';
    echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent.';
}
//call to insert function of DbQuery Class
$int -> insert('interest', $intrst);
$int -> exec();


$conn->close();
