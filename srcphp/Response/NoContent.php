<?php
namespace proyecto\Response;

class NoContent extends Response {

function __construct(){
	$this->message = 'No Content';
	$this->status = 204;

    $this->header('HTTP/1.0 204 No Content');
}//

};// end class alanpich\REST\HTTP\Response\NoContent
