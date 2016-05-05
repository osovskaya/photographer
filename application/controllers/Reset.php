<?php
require_once APPPATH.'libraries/swiftmailer/swift_required.php';

class Reset extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		// load model
		$this->load->model('reset_model');
	}

    public function mail()
    {
        // if post body empty, return code 400
        if (!$this->input->raw_input_stream)
        {
            $this->sendResponse('400');
            exit();
        }

        // check if email exists
        $response = $this->reset_model->checkEmail();

        switch ($response)
        {
            case true:
                // generate code
                $code = $this->reset_model->makeCode($response['id']);
                //send email to user with code
                if (!$this->sendMail($code))
                {
                    throw new Exception('Error when sending email');
                }
                $this->sendResponse('201');
                break;

            case false:
                $this->sendResponse('406', $this->form_validation->error_array());
                break;
            
            case NULL:
                $this->sendResponse('404');
                break;
        }

    }

    public function sendMail($code)
    {
        //Create the Transport
        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')->setUsername('intersog.labs@gmail.com')->setPassword('BynthcjuKf,c');

        //Create the message
        $message = Swift_Message::newInstance();

        //Give the message a subject
        $message->setSubject('Reset password')
            ->setFrom('no-reply@mysite.com')
            ->setTo('intersog.labs@gmail.com')
            ->setBody('Here is the message itself')
            ->addPart("<form method=\"POST\" action=\"http://mysite.com/reset/password\">
					<p>Enter new password: <input type=\"password\" name=\"password\" /></p>
					<p><input type=\"hidden\" name=\"code\" value=$code /></p>
					<p><input type=\"submit\" value=\"submit\" /></p></form>", 'text/html');
        
        //Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        //Send the message
        if (!$mailer->send($message))
        {
            return false;
        }
         return true;
    }

    public function password()
    {
        // if put body empty
		if (!$this->input->raw_input_stream)
        {
            $this->sendResponse('400');
            exit();
        }

        // check if code valid
        $response = $this->reset_model->checkCode();

        switch ($response)
        {
            case true:
                $this->sendResponse('204', 'Password successfully changed!');
                break;

            case false:
                $this->sendResponse('406', $this->form_validation->error_array());
                break;

            case NULL:
                $this->sendResponse('404');
                break;
        }

    }
} 
