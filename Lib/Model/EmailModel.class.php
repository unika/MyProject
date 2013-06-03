<?php
/**
 * 文件名：邮件模型 用于控制邮件信息及其他
 * 日期：2013-03-13
 * 作者：邱银乐
 */

class EmailModel extends Model {
	private $Host;
	//smtp主机名
	private $Username;
	//smtp用户名
	private $Password;
	//smtp密码
	private $Port;
	//smtp端口;
	public function __construct() {
		$this -> Host = C("smtpHost");
		$this -> Port = C("smtpPort");
		$this -> Username = C("smtpUser");
		$this -> Password = C("smtpPwd");
	}

	//获取邮件模板
	public function setContent($subject, $Body) {
		$this -> subject = $subject;
		$this -> AltBody = $subject;
		$this -> Body = $Body;
	}

	/*
	 * 邮件发送函数,可以修改为群发
	 * $subject为标题,
	 * $AltBody为提示标题
	 * $Body为内容
	 * $to为要发送的邮箱地址
	 *
	 */
	public function send($to) {
		import("ORG.Net.phpmailer");
		import("ORG.Net.smtp");
		$mail = new PHPMailer();
		// telling the class to use SMTP
		$mail -> IsSMTP();
		// sets the SMTP server
		//$mail -> SMTPDebug = 2;
		$mail -> Host = $this -> Host;
		$mail -> SMTPAuth = true;
		// enable SMTP authentication
		$mail -> SMTPKeepAlive = true;
		// SMTP connection will not close after each email sent
		$mail -> Port = $this -> port;
		// set the SMTP port for the GMAIL server
		$mail -> Username = $this -> Username;
		// SMTP account username
		$mail -> Password = $this -> Password;
		// SMTP account password
		$mail -> SetFrom($this -> Username);
		$mail -> AddReplyTo($this -> Username);
		$mail -> Subject = $this -> subject;
		$mail -> AltBody = $this -> AltBody;
		// optional, comment out and test
		$mail -> MsgHTML($this -> Body);
		$mail -> AddAddress($to, $toname);
		if ($mail -> Send()) {
			return true;
		} else {
			return false;
		}

	}

}
?>