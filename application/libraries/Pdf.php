<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
 
class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }

    //Page header
    public function Header() {
        // set bacground image
        $img_file = K_PATH_IMAGES.'invoice-watermark.png';
        $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
    }
}
 
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
