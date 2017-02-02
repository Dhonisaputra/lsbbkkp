<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		
		# code...
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function test()
	{
		$this->load->library('pdfgenerator', array('saveTo' => APPPATH.'clients/1') );	
$html = <<<PDF
	<center>
		<h1>
			CERTIFICATE 
			<br>
			<small>Certificate No. JECA/001</small>
		</h1>

		<p>We Verify that</p>

		<h2>PT. KARYA BAN SEJAHTERA BERPUTAR</h2>

		<H5>Site Location: Desa blablabla, Kecamatan Bla, Kabupaten Bla 564323</H5>

		<p>has implemented an environtment  management system complying with</p>
		<p>ENVIROMENTAL MANAGEMENT ISO 14001:2004 (SNI ISO 19-14001-2005)</p>

		<br> <br>
		<table>
			<tbody>
				<tr>
					<td>Scope</td>
					<td>:</td>
					<td>#############################</td>
				</tr>
				<tr>
					<td>Nace Code</td>
					<td>:</td>
					<td>#############################</td>
				</tr>
				<tr>
					<td>Date Of Issue</td>
					<td>:</td>
					<td>#############################</td>
				</tr>
				<tr>
					<td>Valid Until</td>
					<td>:</td>
					<td>#############################</td>
				</tr>
			</tbody>
		</table>

	</center>
PDF;
		$this->pdfgenerator->pdf_create($html, 'Certificate.JECA.001', array(), FALSE);
		// echo COMPONENT;
	}

	public function test2()
	{

		/*$this->load->library('mail');
		$this->mail->from('dhoni other','dellacroug@gmail.com');
		$this->mail->subject('test image flex');
		$this->mail->to('dhoni.p.saputra@gmail.com');*/
		echo $this->load->view('templates/email/template--email-info--confirmation-fail-new-certification','',true);
		/*$this->mail->message($mail_mess);
		$this->mail->send();*/
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */