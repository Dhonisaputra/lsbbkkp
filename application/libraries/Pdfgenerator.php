<?php 

/**
* 
*/

require_once COMPONENT.'php/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Pdfgenerator 
{
    protected $options; 
    function __construct($opt = array() )
    {
        $this->options['saveTo'] =  APPPATH.'certificates/';

        if( count($opt) > 0 )
        {
            foreach ($opt as $key => $value) {
                # code...
                $this->options[$key] = $value;
            }
        }

        $this->options['saveTo'] = rtrim($this->options['saveTo'], '/').'/';
    }

    public function pdf_create($html, $filename='', $options = array(), $stream=TRUE) 
    {
        $filename = $filename.".pdf";

        $dompdf = new Dompdf(array('enable_remote' => true));
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->setPaper('A4','portrait');

        if( is_array($options) && count($options) > 0 )
        {
            foreach ($options as $key => $value) {
                $dompdf->set_option($key, $value);       
            }
        }
        $dompdf->load_html($html);
        $dompdf->render();

        if ($stream) {
            $dompdf->stream( $filename, array("Attachment" => 0));
        } else {
            file_put_contents($this->options['saveTo'].$filename, $dompdf->output()); //save the pdf file on the server
        }
    }
}