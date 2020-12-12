<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
include_once __DIR__ . '/admins.php';
include_once '../manageItems/items.php';
include_once '../manageCategories/categories.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = 'itemshowcasephp@gmail.com';                     // SMTP username
    $mail->Password = 'Comp1230assignment';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


    //Recipients
    $mail->setFrom('itemshowcasephp@gmail.com', 'Admin');
    $mail->addAddress('paolo.reus@hotmail.com');     // Add a recipient
    $admin = new Admins();
    $result = $admin->getEmails();
    $listEmail = array();
    while($row = $result->fetch_assoc()){
     $mail->addAddress($row['email']);
    }

    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    $category = new Categories();
    $resultCateg = $category->getActive();
    $item = new Items();
    $resultActive = $item->getActive();
    $numRows = 0;
    $numRowItems = 0;
    $listTop = '';
    $resultSet = $item->getTopItems();
    $listShown = '';
    $resultShown = $category->getShownNames();

    //getting the number of active categories from the query
    while($row = $resultCateg ->fetch_array()){
        $numRows = $row[0];
    }

    //getting the number of active items from the query
    while($row = $resultActive->fetch_array()){
        $numRowItems = $row[0];
    }

    while($row = $resultSet->fetch_assoc()){
        $listTop .= $row['name'];
        $listTop .= "<br>";
    }

    while($row = $resultShown->fetch_assoc()){
        $listShown .= $row['name'];
        $listShown .= "<br>";
    }

    echo $listShown;


    $body = '<strong>Daily Report:</strong> This is the report generated for today <br>
       Number of Active Categories: ' . $numRows . '<br>
       Number of Active Items: ' . $numRowItems . '<br><br>
       List of Top Five Items: <br>'
       . $listTop .   '<br>
       List of active categories: <br>'
       . $listShown . '<br>';
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Site Report for ' . date("Y/m/d");
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}