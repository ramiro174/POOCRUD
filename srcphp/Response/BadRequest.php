<?php
namespace proyecto\Response;

class BadRequest extends Failure {

function __construct() {
		$this->success = false;
		$this->status = 400;
		$this->message = "Bad Request";

    	header('HTTP/1.0 400 Bad Request');
	}//

};// end class alanpich\REST\HTTP\Response\Failure
