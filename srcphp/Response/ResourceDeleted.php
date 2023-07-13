<?php
namespace proyecto\Response;

class ResourceDeleted extends Failure {

function __construct() {
		$this->status = 410;
		$this->message = "Resource Deleted";

    	header('HTTP/1.0 410 Gone');
	}//

};// end class alanpich\REST\HTTP\Response\Failure
