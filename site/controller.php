<?php
/**
 * @version     1.0.0
 * @package     com_test
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Alen Zukich <alen@camcloud.com> - http://www.camcloud.com
 */
 
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class TestController extends JController
{
	function __construct() {
		// params
		$jinput = JFactory::getApplication()->input;
		$this->username = $jinput->get('username', '', 'STRING');
		$this->password = $jinput->get('password', '', 'STRING');
		$this->checkRequiredParameters();
	}
	
	private function checkRequiredParameters() {
		if (($this->username == '') ||	($this->password == '')) 
		{
			header('HTTP/1.1 400 Bad Request', true, 400);
			jexit();
		}
	}
	
	function execute() {
		jimport( 'joomla.user.authentication');
		$auth = & JAuthentication::getInstance();
		$credentials = array( 'username' => $this->username, 'password' => $this->password );
		$options = array();
		$response = $auth->authenticate($credentials, $options);
	
		if ($response->status != JAUTHENTICATE_STATUS_SUCCESS)
		{
			echo "Oh Snap! Failure!";
		}
		else
		{
			echo "W00t! Success";
		}
	}
}