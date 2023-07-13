<?php
namespace proyecto\Response;

class NotFound extends Failure {

function __construct() {
		$this->success = false;
		$this->status = 404;
		$this->message = "Not Found";

    	header('HTTP/1.0 404 Not Found');
	}//

};// end class alanpich\REST\HTTP\Response\Failure
