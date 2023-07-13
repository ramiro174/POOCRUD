<?php
namespace proyecto\Response;

class NotAuthorised extends Failure {

function __construct() {
		$this->status = 401;
		$this->message = "Not Authorised";

		$this->header('WWW-Authenticate: Basic realm="'."SERVER_NAME".'"');
		$this->header('HTTP/1.0 401 Unauthorized');
	}//

};// end class alanpich\REST\HTTP\Response\Failure
