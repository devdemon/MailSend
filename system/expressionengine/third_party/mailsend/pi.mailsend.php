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

		$this->EE->load->library('email');
		$this->EE->load->helper('text');

		$this->EE->email->clear();

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