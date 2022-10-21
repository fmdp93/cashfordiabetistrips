<?php

namespace Cashfordiabetistrips;

use Cashfordiabetistrips\Interfaces\Form;
use Cashfordiabetistrips\Interfaces\Mailing as Mailing;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class UserMailing implements Mailing
{
    public $mail;
    public function __construct(Form $user_form)
    {
        $this->UserForm = $user_form;

        $this->mail = new PHPMailer(true);

        try {
            // Passing `true` enables exceptions
            //Server settings
            $this->mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $this->mail->isSMTP();                                      // Set mailer to use SMTP
            $this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
            $this->mail->Username = 'cashfordiabetistrips@gmail.com';                 // SMTP username
            $this->mail->Password = 'Testrips2021';                           // SMTP password
            $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = 587;                                    // TCP port to connect to
            //Recipients
            $this->mail->setFrom('cashfordiabetistrips@gmail.com', 'Cash For Diabetis Strips');
            $this->mail->addAddress($_POST['email']);     // Add a recipient            
            $this->mail->addReplyTo('cashfordiabetistrips@gmail.com', 'Cash For Diabetis Strips Team');

            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'CashForDiabetiStrips Registration';
        } catch (Exception $e) {
            echo $e;
            exit;
        }
    }

    public function send()
    {
        try {
            $this->mail->send();
        } catch (Exception $e) {
            echo $e;
            exit;
        }
    }

    public function body_building()
    {        
        extract($this->UserForm->user_data);

        $this->mail->Body = "
            <center><img src='" . get_template_directory_uri() . "/assets/img/logo.png" . "' alt=\"Cash For Diabetis Strips\"></center>
            <div>
                <h1>Welcome to Cash For Daibetis Strips</h1>
                <p>Hi $username,</p>
                <p>Thanks for creating an account on Cash For Diabetis Strips. 
                Your username is $username. You can access your account area to view orders, change your password, and more at: 
                https://cashfordiabetistrips.com/my-account/</p>
                <p>Your password has been automatically generated: $password</p>
                <p>We look forward to seeing you soon.</p>
            </div>
            ";
    }
}
