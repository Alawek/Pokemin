<?php

require_once(ROOT . "/utils/IController.php");
require_once(ROOT . "/utils/AbstractController.php");
require_once(ROOT . "/utils/functions.php");
require_once(ROOT . "/utils/session.php");

class SessionGetController extends AbstractController implements IController
{

	public function __construct($form, $controllerName)
	{
		// Appel du constructeur de la classe mère AbstractController
		parent::__construct($form, $controllerName);
	}

	function checkForm()
	{ /* */
	}

	function checkCybersec()
	{ /* */
	}

	function checkRights() {}

	function processRequest()
	{
		$state = array();
		$state['isLogged'] = isLogged();
		if (isLogged()) {
			$state['compteId'] = getCompteIdFromSession();
			$state['roleId'] = getRoleIdFromSession();
			$state['startTime'] = date("Y-m-d H:i:s", getStartTime());
			$state['timeOut'] = date("Y-m-d H:i:s", getTimeOut());
		}
		$this->response = $state;
	}
}
