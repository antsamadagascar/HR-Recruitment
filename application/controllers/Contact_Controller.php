<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_Controller extends CI_Controller {

    public function index() {
        $data['pagetitle'] = 'Section Email de Notification';
        $data['contents']= 'contact/contact';
        $data['candidatsValides'] = $this->Candidat_Model->get_all_candidat_validate_cv();
        $this->load->view('templates/template_rc',$data);
    }

    public function send() {
        $this->load->library('email');
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'antsamadagascar@gmail.com',
            'smtp_pass' => 'tjfx kcum wshh akjs',
            'smtp_crypto' => 'tls',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'wordwrap'  => TRUE,
            'newline'   => "\r\n"
        );
       
        $this->email->initialize($config);
    
        $name = $this->input->post('name');
        $from_email = $this->input->post('email');
        $message = $this->input->post('message');

        $this->email->clear();
        $this->email->from('antsamadagascar@gmail.com', 'Responsable Communication');
        $this->email->to($from_email);
        $this->email->subject('Réponse à votre candidature');
        $this->email->message($message );
        $sent_to_candidate = $this->email->send();
    
        if ($sent_to_candidate) {
            $this->session->set_flashdata('success', 'Votre message a été envoyé avec succès.');
            redirect('contact_Controller');
        } else {
            $error = $this->email->print_debugger();
            $this->session->set_flashdata('error', 'Échec de l\'envoi de l\'email. Veuillez réessayer plus tard.');
            redirect('contact_Controller');
        }
    }
}
