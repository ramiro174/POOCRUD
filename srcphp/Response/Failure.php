<?php
 namespace proyecto\Response;

class Failure extends Response {

protected $success = false;

function __construct($status,$msg) {
		$this->status = $status;
		$this->message = $msg;
	}//

};// end class alanpich\REST\HTTP\Response\Failure
