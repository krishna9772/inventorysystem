<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');
require_once 'dompdf/lib/html5lib/Parser.php';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

class Pdf extends Dompdf
{

	public function __construct()
	{

		parent::__construct();
	}
}
?>