<?php
class Page extends AppController {
    public function __construct() {
        parent::__construct();
        $this->setLayout('layout/app');
        $this->init();
    }
    public function index($slug) {
        $information = Page_model::factory()->findOne(['slug' => $slug]);
        if(!$information) {
            redirect(url('/page-not-found'));
        }
        //$this->dd($information);
        //$this->data['information'] = array();
        if($information) {
            $this->data['information'] = $information;
        }
        render('page/about', $this->data);
    }
    public function contact() {
        if($this->isAjaxRequest() && $this->isPost()) {
            list($name, $email, $phone, $subject, $message, $code) = array_values($this->input->post(NULL, TRUE));
            $phrase = '';
            if(!empty(getSession('phrase'))) {
                $phrase = getSession('phrase');

            }
            if($phrase == $code) {
                // Sent mail to user
                try {
                    $mail 							= new Mail($this->config->item('config_mail_engine'));
                    $mail->parameter 				= $this->config->item('config_mail_parameter');
                    $mail->smtp_hostname 			= $this->config->item('config_mail_smtp_hostname');
                    $mail->smtp_username 			= $this->config->item('config_mail_smtp_username');
                    $mail->smtp_password 			= html_entity_decode($this->config->item('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
                    $mail->smtp_port 				= $this->config->item('config_mail_smtp_port');
                    $mail->smtp_timeout 			= $this->config->item('config_mail_smtp_timeout');

                    $mail->setTo($this->config->item('config_email'));
                    $mail->setFrom($email);
                    $mail->setSender($this->config->item('config_sender_name'));
                    $mail->setSubject('Contact Page Submission');
                    $mail->setHtml($this->template->content->view('emails/contact', compact('name','email','phone','subject','message')));
                    $mail->send();

                    // Reply Mail to Customer
//                    $reply 							= new Mail($this->config->item('config_mail_engine'));
//                    $reply->parameter 				= $this->config->item('config_mail_parameter');
//                    $reply->smtp_hostname 			= $this->config->item('config_mail_smtp_hostname');
//                    $reply->smtp_username 			= $this->config->item('config_mail_smtp_username');
//                    $reply->smtp_password 			= html_entity_decode($this->config->item('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
//                    $reply->smtp_port 				= $this->config->item('config_mail_smtp_port');
//                    $reply->smtp_timeout 			= $this->config->item('config_mail_smtp_timeout');
//
//                    $reply->setTo($email);
//                    $reply->setFrom($this->config->item('config_email'));
//                    $reply->setSender($this->config->item('config_sender_name'));
//                    $reply->setSubject('Thanks for contacting us');
//                    $reply->setHtml($this->template->content->view('emails/reply'));
//                    $reply->send();

                    $this->json['success']          = true;
                    $this->json['message']          = 'Your message has been successfully sent!';
                    $this->json['redirect'] 		= url('/');
//                    if($mail->send() && $reply->send()) {
//
//                    }


                } catch (Exception $e) {
                    dd($e->getMessage());
                }
            } else {
                // user phrase is wrong
                $this->json['error'] = true;
                $this->json['message'] = 'Captcha Invalid';
            }
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode($this->json));
        }
        // Set the meta
        $this->template->title->set('Contact');
        $this->template->meta->add('title', 'Contact');
        $this->template->meta->add('keywords', 'Contact us for Educational DVD&#039;s for Kids, worksheets for kids, worksheets for Kindergarten, Kindergarten and Preschool activities, Worksheets for Kids.');
        $this->template->meta->add('description', 'Contact us for Educational DVD&#039;s for Kids, worksheets for kids, worksheets for Kindergarten, Kindergarten and Preschool activities, Worksheets for Kids.');

        $this->data['builder'] = $this->builder;

        setSession('phrase',$this->builder->getPhrase());
        //dd(getSession('phrase'));
        render('page/contact', $this->data);
    }
}