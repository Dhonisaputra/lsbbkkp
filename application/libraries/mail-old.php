<?php
class mail {
    

    private $to = array();

    private $cc = array();

    private $bCc = array();

    private $attachmentMeta = array();

    private $from = null; 

    private $subject = null;

    private $body = '';
    
    private $contentType = 'html';
    
    public $charSet = 'iso-8859-1'; 

    private $senderName = null;
    private $senderEmail = null;
    private $replyTo = null;

    public function isPlain() 
    {
        $this->contentType= 'plain';
    }
    
    public function __construct() 
    {        
        ;
    }

    public function from($name, $email) 
    {        
        if (!is_null($email)) {
            $this->senderEmail = $email;
        } 

        $this->senderName = $name;

    }

    public function replyTo($email = null) 
    {        

        $this->replyto = is_null($email)? $this->senderEmail : $email;

    }
    
    public function subject($subject)
    {
        $this->subject = trim($subject);
    }

    public function message($body)
    {
        $this->body = $body;
    }
    
    private function addAddress($email, $destType, $name = null) 
    {
        if ($name !== null) {
            $stTo = trim($name) . ' <' . trim($email) . '>';
        } else {
            $stTo = $email;
        }        
        $this->{$destType}[] = $stTo;        
    }

    public function to($email, $name = null) 
    {                
        $this->addAddress($email, 'to', $name); 
    }
    
    public function cc($email, $name = null) 
    {        
        $this->addAddress($email, 'cc', $name);
    }
    
    public function bcc($email, $name = null) 
    {        
        $this->addAddress($email, 'bCc', $name);
    }

    public function attachment($path, $filename)
    {
         // a random hash will be necessary to send mixed content
        $separator = md5(time());

        // carriage return type (we use a PHP end of line constant)
        $eol = PHP_EOL;

        $file = $path . "/" . $filename;
        $content = file_get_contents($file);
        $content = chunk_split(base64_encode($content));

        $headers = "--" . $separator . $eol;
        $headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n";
        $headers .= "Content-Transfer-Encoding: base64\r\n";
        $headers .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
        $headers .= $content."\r\n\r\n";
        $headers .= "--" . $separator . "--";

        $this->attachmentMeta[] = $headers;
    }

    public function send() 
    {        

        // a random hash will be necessary to send mixed content
        $separator = md5(time());        
         

        $stErros = '';        
        if ( is_null($this->senderEmail) || is_null($this->senderName) ) {
            $stErros .= '<li>Informasi pengirim tidak tersedia</li>';
        }
        if (count($this->to) === 0) {
            $stErros .= '<li>Informasi mengenai penerima kosong</li>';
        }
        if ($this->subject === null) {
            $stErros .= '<li>Silahkan isikan subject</li>';
        }        
        if ($this->body === null) {
            $stErros .= '<li>Tidak ada teks yang dikirim.</li>';
        }        
        if ($stErros !== '') {
            throw new Exception('Jumlah error(s): <ul>' . $stErros . '</ul>');
        }
        $headers = array();
        
        
        // main header (multipart mandatory)
        // header

        $header = "From: ".$this->senderName." <".$this->senderEmail.">\r\n";
        $header .= "Reply-To: ".$this->replyTo."\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"\r\n\r\n";


        $stTo = implode(", ", $this->to);


        if (count($this->cc) > 0) {
            foreach ($this->cc as $bCc) {
                $headers[] = 'Cc: ' . $bCc;
            }         
        }
        if (count($this->bCc) > 0) {
            foreach ($this->bCc as $bCc) {
                $headers[] = 'Bcc: ' . $bCc;
            }         
        }
                
        
        $body =  nl2br($this->body); 

        // message & attachment
        $nmessage = "--".$separator."\r\n";
        $nmessage .= "Content-type:text/html; charset=iso-8859-1\r\n";
        $nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $nmessage .= $body."\r\n\r\n";
        $nmessage .= "--".$separator."\r\n";
        
        if(count($this->attachmentMeta) > 0)
        {
            $nmessage .= implode("\r\n", $this->attachmentMeta);
        }

        $boSend = @mail($stTo, $this->subject, $nmessage, $header);
        $this->debugger = $nmessage."\n".$header;
        if (!$boSend) {
            return false;
        }        
        return true;
    }
    public function debugger()
    {
        return $this->debugger;
    }
    public function clearAllRecipients() 
    {
        $this->to = array();
        $this->cc = array();
        $this->bCc = array();
    }

}


