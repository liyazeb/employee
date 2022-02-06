<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => '', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => '', 
	//'smtp_host' => 'ssl://smtp.gmail.com',
    'smtp_port' => 465,
    'smtp_user' => '',
    'smtp_pass' => '',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '60', //in seconds
    'charset' => 'utf-8',
    'wordwrap' => TRUE
);

//$config['smtp_host'] = "ssl://smtp.gmail.com";
?>