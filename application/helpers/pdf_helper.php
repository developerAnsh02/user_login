<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//Helper: application/helpers/pdf_helper.php
function tcpdf()
{
    require_once('tcpdf/examples/lang/eng.php');
    require_once('tcpdf/tcpdf.php');
}
?>