<?php

/**
* 
*/
class Company_model extends CI_Model
{
	public $COMPANY_DIRECTORY;
	function __construct()
	{
		# code...
		$this->unique_email = $this->config->item('unique_company_email');
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('dataakses');
		$this->load->database();
		$this->COMPANY_DIRECTORY = APPPATH.'clients/Companies/';
	}

	/*
	|---------------------
	| Get data company
	|---------------------
	*/
	public function data_company($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('company');
		$this->db->join('countries', 'countries.id_country = company.country_code');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}
	/*
	|---------------------
	| Get data company_contact
	|---------------------
	*/
	public function data_company_contact($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('company_contact');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data countries
	|---------------------
	*/
	public function data_country($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('countries');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	|---------------------
	| Get data brand
	|---------------------
	*/
	public function data_brand($select = '*', $where = array(), $row_array=-1)
	{
		$this->db->select($select);
		$this->db->from('brand');
		if(count($where) > 0)
		{
			$this->db->where($where);
		}
		$data = $this->db->get();
		return ($row_array < 0)? $data->result_array() : $data->row_array($row_array);
	}

	/*
	*/
	public function get_company($company = 0)
	{
		if($company == 0)
		{
			return $this->dataakses->SQL('select * from company');
		}else
		{
			$this->dataakses->SQL('select * from company where id_company = ?', 'i', $company);
			return $this->dataakses->row_array();
		}
	}

	/*
	* function data divisi
	*
	* function status : used
	*/
	public function data_divisi()
	{
		return $this->dataakses->SQL('SELECT * FROM divisi');
	}

	/*
	* function get all brand
	*/
	public function get_brand()
	{	
		return $this->dataakses->SQL('select *  from brand join company using(id_company) left join commodity using(id_commodity)');
	}

	/*
	* GET SPESIFIC COMPANY USING ID_COMPANY
	*/
	public function get_spesific_company($id_company)
	{
		$this->dataakses->SQL('select * from company where id_company = '.$id_company);
		return $this->dataakses->row_array();
	}

	/*
	GET SPECIFIC FUCKING COMPANY;
	*/
	public function CI_get_company($where = array())
	{
		if( count($where) > 0 )
		{
			$data = $this->db->get_where('company', $where);
			return $data->row_array();
		}else
		{
			$data = $this->db->get('company');
			return $data->result_array();
		}
	}

	public function get_spesific_brand_company($id_a0_cat)
	{
		$data = $this->db->query('SELECT brand.*, certification_request.*, a0.id_a0, company.id_company  FROM a0_cat JOIN a0 USING(id_a0) JOIN company USING(id_company) JOIN certification_request USING(id_a0_cat) JOIN brand USING(id_brand) WHERE certification_request.revoke_request = 0 and a0_cat.id_a0_cat = '.$id_a0_cat);
		return $data->result_array();
	}
	public function get_spesific_commodity_company($id_company)
	{
		return $this->dataakses->SQL('SELECT * FROM commodity where EXISTS (SELECT * FROM brand where id_company = '.$id_company.' and commodity.id_commodity = brand.id_commodity) ');
	}
	public function get_spesific_divisi_company($id_company)
	{
		return $this->dataakses->SQL('SELECT * FROM divisi where id_company = '.$id_company);
	}

	/*
	* get data assessment 
	* dengan ketentuan
	* Tampilkan assessment dimana 
	*/
	public function data_assessment($id_company = 0)
	{
		if($id_company <= 0)
		{
			return $this->dataakses->SQL('select id_a0, id_a0_cat, a0.token, id_certificate, company.id_company, company.company_name, company_address, company_post, email, telephone, assessment_date, certification_category.*, a0.a0_added_on, a0_cat.status  
												from company  
												join a0 using(id_company) 
												join a0_cat using(id_a0) 
												join certification_request using(id_a0_cat) 
												join certification_category using(audit_reference) where a0_cat.status = "process" and ( a0.assessment_date IS NULL or a0.assessment_date >= DATE(NOW()) ) order by id_a0, id_a0_cat');
		}else
		{
			$assessment = $this->dataakses->SQL('select id_a0, id_a0_cat, a0.token, id_certificate, company.id_company, company.company_name, company_address, company_post, email, telephone, assessment_date, certification_category.*, a0.a0_added_on, a0_cat.status  
												from company  
												join a0 using(id_company) 
												join a0_cat using(id_a0) 
												join certification_request using(id_a0_cat) 
												join certification_category using(audit_reference)
												where id_company = '.$id_company.' and a0_cat.status = "process" and ( a0.assessment_date IS NULL or a0.assessment_date >= DATE(NOW()) ) order by id_a0, id_a0_cat');
			foreach ($assessment as $key => $value) {
				
				$assessment[$key]['is_confirmed'] = is_null($value['assessment_date'])? false : true;
				
			}
			return $assessment;
		}
	}


	/*
	* function to check company
	*/
	public function check_availability_company($name)
	{
		$isCompany = $this->dataakses->SQL('SELECT * FROM company where company_name = "'.$name.'"');
		if( count($isCompany) > 0 )
		{
			header("HTTP/1.0 500 error company is exist. you cannot create company with this name.");
			exit('error');
		}else
		{
			header("HTTP/1.0 200 success company is available.");
		}
	}

	/*
	* function to check company email that input on add new company
	*/
	public function check_availability_company_email($email)
	{
		$isCompany = $this->dataakses->SQL('SELECT * FROM company where email = "'.$email.'"');
		if( count($isCompany) > 0 && $this->unique_email == TRUE )
		{
			header("HTTP/1.0 500 email ini sudah terdaftar. silahkan masukkan email lain atau contact YOQA untuk lebih lanjut.");
			exit('error');
		}else
		{
			header("HTTP/1.0 200 Email Tersedia.");
		}
	}


	/*
	* create company
	*/
	public function create_company($data)
	{

		// print_r($data);

		if( is_array($data) == false || count($data) <= 0 )
		{
			header("HTTP/1.0 500 data undefined in create company");
			exit('data undefined in create company');
		}


		// $this->check_availability_company($data['company_name']);

		// $result = array('success' => false);

		//save into table company
		$accepted = 'company_name, country_code, company_address, company_post, telephone, email, company_fax, company_province, company_region, company_employee, company_password, keychain, nama_pemilik, nama_pimpinan, nama_wakil_management, akta_pendirian, luas_tanah, luas_bangunan, company_karyawan_tetap, company_karyawan_tidak_tetap, company_shift, status_perusahaan';
		$accExpl = explode(', ', $accepted);
		foreach ($accExpl as $key => $value) {
			$askSign[] = '?';
		}
		$askSign = implode(',', $askSign);

		foreach ($accExpl as $key => $value) {

			$accData[$value] = $data[$value];
		}

		$this->db->insert('company', $accData);		
		$company_id = $this->db->insert_id();


		if(!empty($company_id) )
		{

			
			$result['success'] = true;
			$result['id_company'] = $company_id;
			$result['company_name'] = $data['company_name'];

			// create folder company
			$this->folder_company($company_id);

			$this->send_email_after_create_company(array(
					'email' => $data['email'],
					'company_name' => $data['company_name'],
					'company_password' => $data['password_raw'],
				));
			return $result;
	
		}else
		{
			header("HTTP/1.0 500 error on save company");
		}

		
	}
	/*
	* folder company
	* function to create folder for clients / companys
	* requirements
		- id company
	* return 
		- dir = full path dir
		- is_dir = boolean
	*/
	public function folder_company($company, $create = TRUE)
	{
		$folderneed = array('certificates', 'properties', 'files');

		$rootclients = $this->COMPANY_DIRECTORY;
		$dirclient = $rootclients.$company;
		$is_dir_roots = is_dir( $rootclients );
		$is_dir_client = is_dir($dirclient);
		$result = array( 'is_dir' => $is_dir_client );

		if($is_dir_roots)
		{
			if(!$is_dir_client && $create === TRUE)
			{
				mkdir($dirclient, 0777);
			}

			$result['dir'] = $dirclient.'/';

			foreach ($folderneed as $key => $value) {
				if( is_dir($dirclient.'/'.$value) === FALSE )
				{
					mkdir($dirclient.'/'.$value, 0777);
				}
				$result['certificate'] = $dirclient.'/certificates/';
			}
		}
		return $result;
	}

	/*
	* function add contact
	* parameters
	*	- name
	* 	- number
	* 	- ext
	* 	- id company
	*/
	public function add_contact($id_company, $name, $number, $ext)
	{
		$this->dataakses->SQL('INSERT INTO company_contact(id_company, contact_name, contact_number, ext, contact_added_time) values(?,?,?,?,?)', 'issss', $id_company, $name, $number, $ext, date('Y-m-d H:i:s'));
	}

	/*
	* function add brand
	* parameters
	* 	- id_company
	* 	- id_commodity (bisa NULL)
	* 	- brand
	*/
	public function add_brand($company, $brand, $commodity = NULL)
	{
		$result = array('success' => false);

		

			// save into table company
			$this->dataakses->commitOff();
			$this->dataakses->SQL('insert into brand(id_company, brand_name, id_commodity, brand_added_on) values (?,?,?,?)', 'isis' , $company, $brand, $commodity, date('Y-m-d H:i:s'));
			$brand_id = $this->dataakses->insert_id();
			$this->dataakses->commitOn();
			return $brand_id;

	}

	/*
	* function add brand
	* parameters
	* 	- id_company
	* 	- id_commodity (bisa NULL)
	* 	- brand
	*/
	public function add_divisi($company, $divisi)
	{
		$result = array('success' => false);


		// save into table company
		$this->dataakses->commitOff();
		$this->dataakses->SQL('insert into divisi(id_company, divisi_name, divisi_added_time) values (?,?,?)', 'iss' , $company, $divisi, date('Y-m-d H:i:s'));
		$data = $this->dataakses->insert_id();

		#tambah notifikasi 
		$this->load->model('notification_model');
		$notifi = $this->notification_model->save_notification('a_divisi');

		// echo $data;
		return $data;
	}

	/*
	* NOTE :::::::
	*
	* $token harus di encode terlebih dahulu.
	* $token sebelum dikirim ke email, semua tanda / (slash) harus di ganti menjadi ||
	* lalu disini, setelah url di decode, akan di "netralisir" lagi tanda || menjadi /
	*/
	public function authentication__assessment_token($id_a0, $token)
	{
		$this->load->library('hash');

		$pattern = '$2y$11$'.str_replace('||', '/', urldecode($token) );
		$result = array('is_auth' => false);
		$this->dataakses->SQL('SELECT * FROM a0 JOIN a0_cat using(id_a0) where id_a0='.$id_a0.' and token = "'.$pattern.'"');

		$result['is_found'] = (count($this->dataakses->result_array()) > 0)? true : false ;
		if($result['is_found'] == true)
		{
			$data = $this->dataakses->row_array();

			$hashKey = base64_encode($data['id_company'].'.'.$data['id_a0']);
			$auth = $this->hash->decrypt($hashKey, $pattern);

			if($auth == true)
			{
				// $this->dataakses->SQL('SELECT * FROM company join brand using(id_company) where id_brand='.$brand);
				$result['is_auth'] = $auth;			
				$result['data'] = $data;			
				// $result['company'] = $this->dataakses->row_array();			
			}
		}
		return $result;
	}

	/*
	* check availability of brand name
	*/
	public function check_availability_brandName($data)
	{
		$result = array();
		$response = $this->dataakses->SQL('SELECT * FROM brand where brand_name="'.$data['brand_name'].'" and id_company = '.$data['id_company']);
		$result['is_available'] = (count($response) > 0)? true : false;
		$result['data'] = $response;

		return $result;
	}

	public function check_availability_divisi($data)
	{
		$result = array();
		$response = $this->dataakses->SQL('SELECT * FROM divisi where divisi_name="'.$data['divisi_name'].'" and id_company = '.$data['id_company']);
		$result['is_available'] = (count($response) > 0)? true : false;
		$result['data'] = $response;

		return $result;
	}

	public function check_availability_assessment_for_spesific_brand($data)
	{

	}

	/*
	* REQUEST CERTIFICATION
	* 
	*/
	public function request_certification($data)
	{
		$this->load->model('certification_model');

		if(isset($data['assessment']['JPA-009']))
		{

			foreach ($data['assessment']['JPA-009'] as $key => $value) {
				# code...
				$item = $this->check_availability_brandName(array('brand_name' => $value['dibrakom'], 'id_company' => $data['id_company'] ));
				$data['assessment']['JPA-009'][$key]['dibrakom'] = ($item['is_available'] == true)? $item['data']['id_brand'] : $this->add_brand($data['id_company'], $value['dibrakom'] , $value['id_commodity'] );
			}
		}

		// if(isset($data['assessment']['YQ-005']))

		// 	foreach ($data['assessment']['YQ-005'] as $key => $value) {
		// 		# code...
		// 		$item = $this->check_availability_divisi(array('divisi_name' => $value['dibrakom'], 'id_company' => $data['id_company'] ));
		// 		$data['assessment']['YQ-005'][$key]['dibrakom'] = $this->add_divisi($data['id_company'], $value['dibrakom']);
		// 	}

		$this->certification_model->save_certification_company($data);
		// print_r($data);
	}

	public function update_brand($data)
	{
		$this->dataakses->SQL('UPDATE brand set brand_name = "'.$data['brand_name'].'", id_commodity="'.$data['brand_commodity'].'" where id_brand = '.$data['id_brand']);
	}

	public function update_company($where, $update)
	{
		$this->db->update('company', $update, $where);
		// $this->dataakses->SQL('UPDATE company set company_name = "'.$data['company_name'].'", company_address="'.$data['company_address'].'", company_post="'.$data['company_address'].'", email="'.$data['email'].'", telephone="'.$data['telephone'].'" where id_company = '.$data['id_company']);
	}

	public function update_contact($where, $update)
	{
		$this->db->update('company_contact', $update, $where);
		// $this->dataakses->SQL('UPDATE company set company_name = "'.$data['company_name'].'", company_address="'.$data['company_address'].'", company_post="'.$data['company_address'].'", email="'.$data['email'].'", telephone="'.$data['telephone'].'" where id_company = '.$data['id_company']);
	}

	public function authentication_change_password()
	{
		$get = $this->dataakses->SQL('SELECT * FROM company join keychain on company.keychain = keychain.keychain_id where email = ?', 's', $data['username']);
			
		$datafilter = $this->process_check_user($get, $data['password']);
	}
	/*
	|-------------------
	| Function check data authentication login
	|-------------------
	*/
	public function authenticationLogin($data)
	{
		$get = $this->dataakses->SQL('SELECT * FROM company join keychain on company.keychain = keychain.keychain_id where email = ?', 's', $data['username']);
			
		$datafilter = $this->process_check_user($get, $data['password']);

		if(count($datafilter) == 1)
		{			
			$users = $get[$datafilter[0]];

			/*jika tidak ditemukan userauthentication berarti belum ada login. buat session*/
			if(!isset($_SESSION['userauthentication']))
			{

				$_SESSION['userauthentication']['is_login'] = true;
				$_SESSION['userauthentication']['level'] = $users['company_level'];
				$_SESSION['userauthentication']['username'] = $users['company_name'];
				$_SESSION['userauthentication']['email'] = $users['email'];
				$_SESSION['userauthentication']['id_company'] = $users['id_company'];
				$_SESSION['userauthentication']['id_users'] = $users['id_company'];

				$this->pengguna->login($_SESSION['userauthentication']);

				return $result = array(
					'found' => true,
					'data' => array(
						'username' => $users['company_name'],
						'level' 	=> $users['company_level'],
						'id_users' 	=> $users['id_company'],
						),
					'is_auth' => true
				);
			}else
			{
				return $get[$datafilter[0]];
			}

		
		}elseif( count($datafilter) !== 1 )
		{
			header('HTTP/1.0 500 Error of recognized users. please call your administrator '.count($datafilter));

			
		}else
		{
			return $result = array(
				'found' => count( $this->dataakses->result_array() ) > 0 ? true : false,
			);
		}
	}
	/*
	|----------------------------
	| Masih bagian authentication Login
	|----------------------------
	*/
	public function process_check_user($datausers, $password)
	{
		require_once(APPPATH.'libraries/profiling/Pengguna.php');
		$dch = array();
		$ch = array();
		$u = new Pengguna();

		foreach ($datausers as $key => $value) {
			$as = $u->user_authentication($password, $value['company_password'], $value['fkey'], $value['skey']);
			if($as === true)
			{
				array_push($ch, 'true');
			}else
			{
				array_push($ch, 'false');
			}

			if( in_array('false', $ch) )
			{
				continue;
			}else
			{
				array_push($dch, $key);
			}
		}
		return $dch;
	}


	/*
	|---------------------------
	| Send email after create company
	|--------------------------
	*/
	public function send_email_after_create_company($data)
	{
		$companyName = $data['company_name'];
		$companyEmail = $data['email'];
		$companyPassword = $data['company_password'];

		$namaLembaga = 'YOQA Quality Management System';
		$urlDashboard = site_url('perusahaan/login');
		$mailContent = <<<EOF
		
		<div class="display:inline;">
			Hallo, Perusahaan $companyName.<br>
			<p>Anda telah terdaftar didalam sistem informasi $namaLembaga </p> 
			<p>Dengan sistem informasi ini, perusahaan dapat melihat sertifikat yang terbit, dan jadwal Kunjungan</p>
			<p> Untuk Mengaksesnya, anda dapat menuju tautan <a href="$urlDashboard"> Halaman Login Perusahaan </a> </p>
			<p> Anda dapat masuk kedalam sistem dengan memasukkan email anda dan password yang telah kami siapkan. </p>
			<p> Dan mohon untuk segera mengganti / mengupdate password yang telah kami siapkan dengan password yang dapat anda ingat. </p>
		</div>
		<div>
			Dibawah ini adalah data pengguna yang dapat digunakan untuk login.
		</div>
		<div style="display:inline;"> 
			<ul>
				<li> <strong> Email </strong> : $companyEmail </li>
				<li> <strong> Password </strong> : $companyPassword </li>
			</ul>
		</div>
		<p>Karena Sistem masih dalam tahap pengembangan, mohon dapat memberikan kritik dan saran kepada kami, melalui costumer service YOQA</p>
		<p> Jika Saat Login terdapat Kesulitan, silahkan hubungi costumer support kami. Terima kasih. </p>
		<br>
		<br>
		<br>
		<div>Salam hangat</div>
		<div><strong>$namaLembaga</strong></div>

EOF;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Yoqa Costumer Service <costumer.service@yoqa.com>' . "\r\n";
		mail( $companyEmail, 'Konfirmasi Pendaftaran Perusahaan', $mailContent, $headers);

	}

	public function send_email_after_reset_company_password($data)
	{
		$companyName = $data['company_name'];
		$companyEmail = $data['email'];
		$companyPassword = $data['company_password'];

		$namaLembaga = 'Reset Company Password';
		$urlDashboard = site_url('perusahaan/login');
		$mailContent = <<<EOF
		
		<div class="display:inline;">
			Hallo, Perusahaan $companyName.<br>
			<p> Password anda telah direset oleh system </p> 
			<p> Untuk Mengaksesnya, anda dapat menuju tautan <a href="$urlDashboard"> Halaman Login Perusahaan </a> </p>
			<p> Anda dapat masuk kedalam sistem dengan memasukkan email anda dan password yang telah kami siapkan. </p>
			<p> Dan mohon untuk segera mengganti / mengupdate password yang telah kami siapkan dengan password yang dapat anda ingat. </p>
		</div>
		<div>
			Dibawah ini adalah data pengguna yang dapat digunakan untuk login.
		</div>
		<div style="display:inline;"> 
			<ul>
				<li> <strong> Email </strong> : $companyEmail </li>
				<li> <strong> Password </strong> : $companyPassword </li>
			</ul>
		</div>
		<p>Karena Sistem masih dalam tahap pengembangan, mohon dapat memberikan kritik dan saran kepada kami, melalui costumer service YOQA</p>
		<p> Jika Saat Login terdapat Kesulitan, silahkan hubungi costumer support kami. Terima kasih. </p>
		<br>
		<br>
		<br>
		<div>Salam hangat</div>
		<div><strong>$namaLembaga</strong></div>

EOF;

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Yoqa Costumer Service <costumer.service@yoqa.com>' . "\r\n";
		if(!mail( $companyEmail, 'LSBBKKP Service', $mailContent, $headers) )
		{
			header('HTTP/1.0 500 kesalahan saat pengiriman email. kemungkinan data tetap terkirim.');
		}

	}


	/*
	|
	| Update company password
	|
	*/
	public function change_password_perusahaan($update, $where)
	{

		$this->db->where($where);
		$this->db->update('company', $update); 
	}

	/*R E M O V E */
	public function delete_contact($where)
	{
		$this->db->delete('company_contact', $where); 
		// $this->dataakses->SQL('UPDATE company set company_name = "'.$data['company_name'].'", company_address="'.$data['company_address'].'", company_post="'.$data['company_address'].'", email="'.$data['email'].'", telephone="'.$data['telephone'].'" where id_company = '.$data['id_company']);
	}
}