<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/home/kaminstr/public_html/PHPMailer/src/Exception.php';
require '/home/kaminstr/public_html/PHPMailer/src/PHPMailer.php';
require '/home/kaminstr/public_html/PHPMailer/src/SMTP.php';

$rootPath = realpath('/home/kaminstr/public_html');
$file_key="Kam!45instrumentale";
// Initialize archive object
$zip = new ZipArchive();
$zip->open('Kaminstrumentale.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
if ($zip->setPassword($file_key)){
}else{
    echo 'no password';
}

// Create recursive directory iterator
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
        $zip->setEncryptionName($relativePath, ZipArchive::EM_AES_256);
    }
}

// Zip archive will be created only after closing object
$zip->close();
/*$mail = new PHPMailer(True);
try {
    //Server settings
    $mail->SMTPDebug = 1;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.kaminstrumentale.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'mildore@kaminstrumentale.com';             // SMTP username
    $mail->Password = 'Kam!45instrumentale!45';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
    $mail->Port = 465;                                    // TCP port to connect to
    
    //Recipients
    $mail->setFrom('kaminstrumentale@contact.com', 'KAM');          //This is the email your form sends From
    $mail->addAddress('Tarek.bern@gmail.com', 'BERNOUSSI Tarek'); // Add a recipient address
    //$mail->addAddress('contact@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    
    //Attachments
    $mail->addAttachment('/home/kaminstr/public_html/Kaminstrumentale.zip');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Save KAM';
    $mail->Body    = 'Sauvegarde du site KAM';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}*/