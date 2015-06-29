<?php namespace Davzie\LaravelBootstrap\Core;

use MailValidator, View;

/**
 * mail class
 */
class Mail {

	/**
	 * send mail with mail php function
	 *
	 * @param $template string
	 * @param $data     array
	 * @param $cb       function, callback
	 *
	 * @return bool
	 */
	public static function send($template, $data, $cb)
	{
		$body = View::make($template, $data);

		$message = new Message;
		call_user_func($cb, $message);

		mail($message->email, $message->subject, $body, $message->getHeaders());
	}
}

/**
 * email message class
 */
class Message {

	/**
	 *
	 */
	public $email;

	/**
	 *
	 */
	public $subject;

	/**
	 *
	 */
	public $to;

	/**
	 * get mail headers
	 *
	 * @return string
	 */
	public function getHeaders()
	{
		$headers  = "From: kpmti.univer.lutsk.ua\r\n";
		// $headers .= "Reply-To: studvel@gmail.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=utf-8\r\n";
		$headers .= 'X-Mailer: PHP/' . phpversion();

		return $headers;
	}

	/**
	 * set mail subject
	 *
	 * @param $subject string
	 *
	 * @return message instance
	 */
	public function subject($subject)
	{
		$this->subject = $subject;

		return $this;
	}

	/**
	 * set mail and name
	 */
	public function to($email, $to = '')
	{
		$this->email = $email;
		$this->to    = $to;

		return $this;
	}
}