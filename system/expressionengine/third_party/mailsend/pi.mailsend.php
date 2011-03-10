<?php if (!defined('BASEPATH')) die('No direct script access allowed');

/**
 * MailSend
 * Sen Email Directly from Templates
 *
 * @package			DevDemon_MailSend
 * @version			2.0
 * @author			DevDemon <http://www.devdemon.com> - Lead Developer @ Parscale Media
 * @copyright 		Copyright (c) 2007-2011 Parscale Media <http://www.parscale.com>
 * @license 		http://www.devdemon.com/license/
 * @link			http://www.devdemon.com
 * @see				http://expressionengine.com/user_guide/development/plugins.html
 */


/**
 * Plugin Info
 *
 * @var array
 */
$plugin_info = array(
	'pi_name' => 'MailSend',
	'pi_version' => '2.0',
	'pi_author' => 'DevDemon',
	'pi_author_url' => 'http://www.devdemon.com/',
	'pi_description' => 'Send Email directly from an template without a form submission.',
	'pi_usage' => Mailsend::usage()
);


class Mailsend
{

	/**
	 * The return data
	 *
	 * @var string
	 * @access public
	 **/
	public $return_data = '';


	/**
	 * Mailsend
	 *
	 * @access	public
	 * @return	void
	 */
	public function Mailsend()
	{
		$this->EE =& get_instance();

		$to = $this->EE->TMPL->fetch_param('to', '');
		$from_email = $this->EE->TMPL->fetch_param('from_email', $this->EE->config->item('webmaster_email'));
		$from_name = $this->EE->TMPL->fetch_param('from_name', $this->EE->config->item('webmaster_name'));
		$cc = $this->EE->TMPL->fetch_param('cc', '');
		$bcc = $this->EE->TMPL->fetch_param('bcc', '');
		$subject = $this->EE->TMPL->fetch_param('from_name', '');
		$message = $this->EE->TMPL->tagdata;

		// Check for proper email adress
		$this->EE->load->library('form_validation');

		if ($this->EE->form_validation->valid_emails($to) == FALSE)
		{
			$this->EE->TMPL->log_item('MailSend: Invalid "TO" email address.');
			return;
		}

		if ($this->EE->form_validation->valid_email($from_email) == FALSE)
		{
			$this->EE->TMPL->log_item('MailSend: Invalid "FROM" email address.');
			return;
		}

		if ($this->EE->form_validation->valid_emails($cc) == FALSE)
		{
			$this->EE->TMPL->log_item('MailSend: Invalid "CC" email address.');
			return;
		}

		if ($this->EE->form_validation->valid_emails($bcc) == FALSE)
		{
			$this->EE->TMPL->log_item('MailSend: Invalid "BCC" email address.');
			return;
		}

		$this->EE->load->library('email');
		$this->EE->email->clear();
		$this->EE->email->EE_initialize();
		$this->EE->email->wordwrap = false;
		$this->EE->email->mailtype = 'html';
		$this->EE->email->from( $from_email, $from_name);
		$this->EE->email->to($to);
		$this->EE->email->subject($subject);
		$this->EE->email->cc($cc);
		$this->EE->email->bcc($bcc);
		$this->EE->email->message($message);
		$this->EE->email->send();

		return;
	}

	// ********************************************************************************* //

	/**
	 * Usage
	 *
	 * This function describes how the plugin is used.
	 *
	 * @access	public
	 * @return	string
	 */
	public function usage()
	{
		return 'http://www.devdemon.com';
	}

}
/* End of file pi.mailsend.php */
/* Location: ./system/expressionengine/third_party/mailsend/pi.mailsend.php */