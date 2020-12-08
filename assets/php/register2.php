<?php
    session_start();
    require_once("config.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '../PHPMailer-master/src/Exception.php';
    require '../PHPMailer-master/src/PHPMailer.php';
    require '../PHPMailer-master/src/SMTP.php';

    if (isset($_GET["g-recaptcha-response"])) {
        $SECRETKEY = "6Lfgy-0ZAAAAACStrtLYyi4teYOtjiFn-35mH-L2";
        $RESPONSE = $_GET["g-recaptcha-response"];
        $URL = "https://www.google.com/recaptcha/api/siteverify?secret=$SECRETKEY&response=$RESPONSE";
        $FIRE = file_get_contents($URL);
        $DATA = json_decode($FIRE);

        if ($DATA->success != true) {
            $_SESSION["refresh"] = 0;
            $_SESSION["Message"] = "<code>Recaptcha error. Please try again!</code>";
            header("location:../../index.php");
            exit();
        }
    }
    
    $FirstName = $_GET["fname"];
    $LastName = $_GET["lname"];
    $Email = $_GET["Email"];

    $con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if (!$con) {
        $_SESSION["Message"] = "<code>Database can not connect.(".mysqli_error($con).")</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    $Rdatetime = date("Y-m-d H:i:s");
    $Acode = rand();

    $query = "INSERT INTO Users (Email, FirstName, LastName, Rdatetime, Acode) VALUES ('$Email', '$FirstName', '$LastName', '$Rdatetime', '$Acode');";
    $result = mysqli_query($con, $query);

    if (!$result) {
        $_SESSION["Message"] = "<code>Query failed.(".mysqli_error($con).")</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2;
        $mail->IsSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "your mailer email";
        $mail->Password = "your mailer password";
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465;
        $mail->SMTPKeepAlive = "true";
        $mail->Mailer = "smtp";
        $mail->setFrom("from email", "your firstname lastname");
        $mail->addReplyTo("reply email", "your firstname lastname");
        $mail->isHTML(true);
        $msg = "Thanks for signing up! Click "
            ."<a href='http://yourwebsite.com/assets/php/authenticate.php?Email=$Email&Acode=$Acode'>"
            ."here</a> to verify your email.";
        $mail->addAddress($Email, "$FirstName $LastName");
        $mail->Subject = "Thanks for registering";
        $mail->Body = $msg;
        $mail->send();
        
        $_SESSION["regState"] = 0;
        $_SESSION["Message"] = "<code>Thanks for signing up! A code has been sent to your email.</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();
    } catch (phpmailerException $e) { // error if failed to send    
        $_SESSION["regState"] = 1;
        $_SESSION["Message"] = "<code>Mailer error. Please try again.(".$e->errorMessage().")</code>";
        $_SESSION["refresh"] = 0;
        header("location:../../index.php");
        exit();      
    }
?>