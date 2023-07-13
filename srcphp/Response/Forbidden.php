<?php
namespace proyecto\Response;

class Forbidden extends Failure {

function __construct() {
		$this->success = false;
		$this->status = 403;
		$this->message = "Forbidden";

    	header('HTTP/1.0 403 Forbidden');
	}//

};// end class alanpich\REST\HTTP\Response\Failure
