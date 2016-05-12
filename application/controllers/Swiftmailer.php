<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'libraries/swiftmailer/swift_required.php';

class Swiftmailer extends CI_Controller 
{
    public function __construct() 
{
        parent::__construct();
    }

    public function index() 
{
        $code = '123456';
    //Create the Transport
       // $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, ssl)->setUsername('intersog.labs@gmail.com')->setPassword('BynthcjuKf,c');
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')->setUsername('ayosovskaya@gmail.com')->setPassword('O$0vskaya');

        //Create the message
        $message = Swift_Message::newInstance();

    $part = "<form method=\"post\" action=\"http://mysite.com/users/1\">
					<p>Enter new password: <input type=\"password\" name=\"password\" /></p>
					<p><input type=\"text\" name=\"code\" value=$code /></p>
					<p><input type=\"submit\" value=\"submit\" /></p></form>";

        //Give the message a subject
        $message->setSubject('Reset password')
                ->setFrom('no-reply@mysite.com')
                ->setTo('ayosovskaya@gmail.com')
                ->setBody('Here is the message itself')
                ->addPart($part, 'text/html')
        ;

        //Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        //Send the message
        $result = $mailer->send($message);

        if ($result) {
            echo "Email sent successfully";
        } else {
            echo "Email failed to send";
        }
    }
}
