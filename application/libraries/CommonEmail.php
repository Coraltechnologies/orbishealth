<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommonEmail {
    protected $CI;

    function register_email($data = null){
        $result = false;
        if(count($data) > 0){          
            $this->CI   = &get_instance();            
            $from_email = $this->CI->config->item('default_mail');
            $from_name  = $this->CI->config->item('default_mail_name');
            
            $this->CI->email->from($from_email, $from_name);
            $this->CI->email->to($data['to_email'], $data['to_name']);
            $this->CI->email->subject('Orbis Health New Registration');
            $this->CI->email->set_mailtype("html");
            $active_url = base_url().'page/confirmation/'.$data['activation_code'];
            $content	= 'Dear '.$data['to_name'].'<br><strong>Orbis Health eMail Confirmation Link </strong><br/><br/><a href="'.$active_url.'" target="_blank">Confirmation Link</a><br/><br/><br/><br/>Thanks,';
            $this->CI->email->message($content);
            if($this->CI->email->send()){
                $result = true;
            }
        }
        return $result;
    }
    
    function register_confirm_email($data = null){
        $result = false;
        if(count($data) > 0){          
            $this->CI   = &get_instance();            
            $from_email = $this->CI->config->item('default_mail');
            $from_name  = $this->CI->config->item('default_mail_name');
            
            $this->CI->email->from($from_email, $from_name);
            $this->CI->email->to($data['to_email'], $data['to_name']);
            $this->CI->email->subject('Orbis Health Login Deatils');
            $this->CI->email->set_mailtype("html");
            $content	= 'Dear '.$data['to_name'].'<br><strong>Orbis Health Credentials</strong><br/><br/>User Id : '.$data['login_id'].'<br/>Password : '.$data['password'].'<br/><br/><br/><br/>Thanks,';
            $this->CI->email->message($content);            
            if($this->CI->email->send()){
                $result = true;
            }
        }
        return $result;
    }
}
?>