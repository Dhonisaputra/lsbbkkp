<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

// $route['default_controller'] = "assessment/index";
$route['default_controller'] = "assessment/index";
$route['setup'] = "assessment/setup";
$route['calendar'] = "assessment/calendar";
$route['notification'] = "assessment/notification";
$route['404_override'] = '';
///////////////////////////////////////////////////////////////////////////////////////////////////



/*
|------------------
| U S E R S -- S E C T I O N S
|------------------
*/
// V I E W S ---------------------------------------------------------
$route['login'] 				= 'users/login';
$route['administrator/login'] 	= 'users/login';
$route['login/forbidden'] 		= 'users/login_forbidden';
$route['logout'] 				= 'users/logout';
$route['users/new'] 			= 'users/create';
$route['faq']					= 'users/user_faq';
$route['faq/dashboard']			= 'users/faq_dashboard';
$route['faq/new'] 				= 'users/user_faq_add';
$route['faq/edit/(:num)']		= 'users/user_faq_edit/$1';
$route['faq/open/(:num)']		= 'users/user_faq_open/$1';

// P R O C E S S ------------------------------------------------------
$route['users/process/add/user'] = 'users/add_user';
$route['users/process/get/faqs'] = 'users/get_faqs';
$route['users/process/authentication'] = 'users/authenticationLogin';
// ---------------------------------------------------------------------


/*
|------------------
| C O M P A N Y -- S E C T I O N S
|------------------
*/
// V I E W S ---------------------------------------------------------
$route['company/(:num)'] = 'company/open_company/$1';
$route['perusahaan/login'] = 'company/login';
$route['company/settings/(:num)'] = 'company/account_settings/$1';
$route['company/tracker_request/(:num)/(:num)'] = 'company/detail_pengajuan_permintaan_sertifikasi/$1/$2'; // $1 = id_company, $2 = id_permintaan_sertifikasi

// P A N E L ---------------------------------------------------------
$route['company/panel/settings'] = 'company/perusahaan_panel_settings';


// P R O C E S S ------------------------------------------------------
// $route['company/process/create/brand'] = 'company/create_new_brand';
$route['company/process/create/company'] 				= 'company/create_new_company';
$route['company/process/get/all/company'] 				= 'company/get_all_company';
$route['company/process/get/brand/(:num)/(:any)'] 		= 'company/get_brand/$1/$2';
$route['company/process/get/commodity/(:num)/(:any)'] 	= 'company/get_commodity/$1/$2';
$route['company/process/get/assessment/(:any)/(:any)'] 	= 'company/get_assessment/$1/$2';

// login perusahaan!
$route['company/process/authentication'] 			= 'company/authenticationLogin'; 

// to check available brandName
$route['company/process/is/available/brandName'] 	= 'company/check_availability_brandName'; 

// to check available brandName
$route['company/process/is/available/company'] 		= 'company/get_check_availability_company_name'; 

// $route['company/process/update'] = 'company/process__update_company';
$route['company/process/update/settings/(:any)'] 	= 'company/process__update_company/$1';

// send request certification
$route['company/process/request/certification'] 	= 'company/request_certification'; 

// get assessment available by company
$route['company/process/get/assessment_available'] 	= 'assessment/company_assessment_available'; 
// ---------------------------------------------------------------------



/*
|------------------
| B R A N D -- S E C T I O N S
|------------------
*/
$route['brand/process/update'] 		= 'company/process__update_brand';
$route['certificate/brand/revoke'] 	= 'certification/revoke_brand';
///////////////////////////////////////////////////////////////////////////////////////////////////

/*
|---------------------------
| A K U N T A N S I -- S E C T I O N
|---------------------------
*/
$route['akuntansi'] = 'certification/review_payment_certification';
$route['certification/pembayaran/upload_nota/(:num)'] = 'certification/upload_nota_pembayaran_sertifikasi/$1';

/*
|------------------
| C E R T I F I C A T I O N S -- S E C T I O N S
|------------------
*/

// D O C U M E N T S 
$route['certification/request/document/kondisi_umum_perusahaan/informasi_tambahan'] = 'certification/document__kondisi_ummum_peusahaan__informasi_tambahan';
$route['certification/request/document/surat_pernyataan'] = 'certification/document__surat_pernyataan';


// V I E W S ---------------------------------------------------------
$route['certification/panel'] = 'certification/panel_certification';
$route['certificate/search'] = 'certification/search_certificate';
// panel add new certification request
$route['certification/panel/new/certification'] 	= 'certification/panel_form_new_certification'; 
$route['certification/panel/new/product_line'] 		= 'certification/panel_form_new_product_line';
$route['certification/panel/edit/product_line'] 	= 'certification/panel_form_edit_product_line';
$route['certification/panel/detail/audit_reference/(:num)/(:any)'] = 'certification/detail_audit_reference/$1/$2';
$route['certification/panel/request/list'] 	= 'certification/daftar_permintaan_sertifikasi'; 
$route['certification/panel/request/detail/(:num)'] 	= 'certification/detail_permintaan_sertifikasi'; 

$route['certification/add/(:num)'] 			= 'certification/adding_certification/$1';
$route['certification/exist/add/(:num)'] 	= 'certification/add_existing_certification/$1';
$route['certification/exist/detail/(:num)/(:num)'] = 'certification/add_existing_certification_a0_cat_detail_section/$1/$2';
$route['certification/(:any)/audit_khusus'] = 'certification/audit_khusus/$1';
// TAMBAH OLD REFERENCE
$route['certification/add/oldreference/(:any)'] = 'certification/add_old_reference/$1';

# ambil data certificate yang telah terbit
$route['certification/view/(:any)/(:num)'] 	= 'certification/view_certificate/$2';  

// P R O C E S S ------------------------------------------------------
$route['certification/process/get/list'] 	= 'certification/get_certification_list';  # ambil data certification category
$route['certificate/process/get/list'] 		= 'certification/get_certificate_list';  # ambil data certificate yang telah terbit

$route['certification/process/post/new_certification'] 	= 'certification/insert_new_certification_list'; 
$route['certification/process/get/certificate/scope'] 	= 'certification/get_scope_certificate'; 
$route['certification/process/get/certificate/nace'] 	= 'certification/get_nace_certificate'; 

// U P L O A D
$route['certification/process/upload/bukti_pembayaran']	= 'certification/update_bukti_pembayaran';

# product line
$route['certification/process/get/certificate/product_line'] 				= 'certification/get_product_line_overall'; 
$route['certification/process/get/certificate/product_line/item'] 			= 'certification/get_product_line_certificate'; 
$route['certification/process/get/certificate/product_line/subcategory'] 	= 'certification/get_product_line_subcategory_certificate'; 
$route['certification/process/get/certificate/product_line/category'] 		= 'certification/get_product_line_category_certificate'; 

$route['certification/process/post/new_scope'] 					= 'certification/insert_new_scope'; 
$route['certification/process/post/insert/category'] 			= 'certification/insert_product_line_category'; 
$route['certification/process/post/insert/subcategory'] 		= 'certification/insert_product_line_subcategory'; 
$route['certification/process/post/insert/item'] 				= 'certification/insert_product_line_item'; 
$route['certification/process/post/update/resurvey'] 			= 'certification/update_resurvey'; 
$route['certification/process/post/update/audit_reference'] 	= 'certification/update_audit_reference'; 
$route['certification/process/post/update/product_line_item'] 	= 'certification/update_product_line_item'; 
$route['certification/process/post/update/certificate/status'] 	= 'certification/update_certificate_status'; 
$route['certification/process/get/used'] 						= 'certification/getUsedCertification'; 
$route['certification/process/create/certificate'] 				= 'certification/create_certificate'; 
$route['certification/process/insert/product'] 					= 'certification/request_insert_product'; 
$route['certification/process/get/company/active_certification'] 	= 'certification/company_active_certification';
$route['certification/process/get/brand/available_certification'] 	= 'certification/brand_available_certification';
$route['certification/process/check/compatibility_dibrakom'] 		= 'certification/get_compatibility_dibrakom_with_certification';
$route['certification/process/update/reference_old_certificate'] = 'certification/add_old_certificate';
// certification server sent
$route['certification/ss/get/assessment/progress'] = 'certification/server_sent__assessment_progress'; 
///////////////////////////////////////////////////////////////////////////////////////////////////


/*
|--------------
| A S S E S S M E N T  -  V I E W S 
|--------------
*/
// REDIRECTED USERS
$route['lsbbkkp'] 				= 'users/lsbbkkp';
$route['master'] 				= 'users/lsbbkkp_master';

$route['assessment/lanjutan/(:num)/(:any)'] 	= 'assessment/assessment_lanjutan/$1/$2'; 
$route['assessment/confirmation/(:num)/(:any)'] = 'assessment/confirmation/$1/$2'; 
$route['assessment/detail/(:any)/(:num)'] 		= 'assessment/detail_schedule/$1/$2'; 
$route['assessment/detail/schedules/all'] 		= 'assessment/detail_all_schedule'; 
$route['assessment/notify_as/group'] 			= 'assessment/notify_as_group'; 
$route['assessment/result/(:num)'] 				= 'assessment/assessment_confirmation_result/$1'; 
$route['assessment/moderasi/pengajuan/(:num)/(:num)'] = 'assessment/detail_precertification/$1/$2'; 
$route['assessment/precertification/list'] 			= 'assessment/precertification'; 
$route['assessment/collective/confirmation/coordinator/(:num)/(:any)'] = 'assessment/collective_coordinator_confirmation/$1/$2'; 

/*
|--------------
| A S S E S S M E N T  - P J T -  V I E W S 
|--------------
*/
$route['pjt/panel'] 			= 'assessment/pjt_dashboard'; 
$route['pjt/panel/dashboard'] 	= 'assessment/pjt_dashboard'; 
$route['pjt/panel/company'] 	= 'assessment/pjt_dashboard_pick_company'; 
$route['pjt/panel/company/(:num)/register/certification'] 	= 'certification/adding_certification/$1'; 
$route['pjt/panel/schedules/detail/(:any)/(:num)'] 			= 'company/perusahaan_panel_detail_schedules/$1/$2'; 

// P R O C E S S ------------------------------------------------------
$route['assessment/process/get/schedules/complete'] 		= 'assessment/complete_schedule'; 
$route['assessment/process/get/schedules/unconfirmed'] 		= 'assessment/get__unconfirmed_schedules'; 
$route['assessment/process/get/schedules/confirmed'] 		= 'assessment/get__confirmed_schedules'; 
$route['assessment/process/get/schedules/confirmed/single'] = 'assessment/get__confirmed_schedules_single'; 
$route['assessment/process/get/schedules/confirmed/group'] 	= 'assessment/get__confirmed_schedules_group'; 
$route['assessment/process/get/list'] 						= 'assessment/get_all_assessment_data'; 
$route['assessment/process/confirmation/date'] 				= 'assessment/confirmation_assessment_date'; 
$route['assessment/process/confirmation/status']			= 'assessment/confirmation_assessment_date'; 
$route['assessment/process/post/resend_email'] 				= 'assessment/resend_email'; 
$route['assessment/process/post/assessment/collective'] 	= 'assessment/post_assessment_collective'; 
$route['assessment/process/post/assessment/single'] 		= 'assessment/post_assessment_single'; 
$route['assessment/process/update/confirmation/date'] 		= 'assessment/update_confirmation_assessment_date'; 
$route['assessment/process/collective/confirmation/date'] 	= 'assessment/confirmation_collective_date_assessment'; # tautan untuk konfirmasi tanggal oleh koordinator assessment kolektif;
$route['assessment/process/confirmation/assessment/lanjutan/date'] = 'assessment/confirmation_advanced_assessment'; 

# assessment services
$route['assessment/service/serversent/assessment_lanjutan'] = 'assessment/ss_assessment_lanjutan'; 
///////////////////////////////////////////////////////////////////////////////////////////////////


/*commodity processing*/
$route['commodity/process/get/list'] 	= 'commodity/get_commodity'; 
$route['commodity/process/add/list'] 	= 'commodity/add_commodity'; 
$route['scope/process/update'] 			= 'commodity/update_scope'; 
$route['scope/process/update/status_revoke_scope'] = 'commodity/update_status_revoke_scope'; 
///////////////////////////////////////////////////////////////////////////////////////////////////

/*client processing*/
$route['clients/process/(:any)/countries'] = 'clients/countries/$1'; 
///////////////////////////////////////////////////////////////////////////////////////////////////

/*Auditor*/
// view
$route['auditor'] = 'auditor/panel_auditor'; 
$route['auditor/profile/add/kompetensi/(:num)'] = 'auditor/auditor_add_competency/$1'; 
$route['auditor/profile/settings/(:num)'] 		= 'auditor/panel_auditor_settings/$1'; 
$route['auditor/picker']	 					= 'auditor/pick_auditor'; 
$route['auditor/create/new/(:num)'] 			= 'auditor/panel_auditor_add_auditor/$1'; 

// P A N E L -- A U D I T O R

$route['auditor/panel'] = 'auditor/index'; 
$route['auditor/panel/profile/(:num)'] 		= 'auditor/panel_auditor_profile/$1'; 
$route['auditor/panel/dashboard/(:num)'] 	= 'auditor/panel_auditor_dashboard/$1'; 
$route['auditor/panel/calendar/(:num)'] 	= 'auditor/panel_auditor_show_schedule/$1'; 
$route['auditor/panel/schedule/(:num)'] 	= 'auditor/panel_auditor_dashboard/$1'; 
$route['auditor/panel/add/competency/documents/(:num)/(:num)'] 	= 'auditor/upload_competency_documents/$1/$2';
$route['auditor/panel/add/education/documents/(:num)'] 	= 'auditor/upload_pendidikan_documents/$1';


//  processing
$route['auditor/process/get/jabatan'] = 'auditor/get_jabatan'; 
$route['auditor/process/get/auditor'] = 'auditor/get_auditor'; 
$route['auditor/process/get/competency/auditor'] 	= 'auditor/get_competency_auditor'; 
$route['auditor/process/get/log/auditor'] 			= 'auditor/get_log_audit'; 
$route['auditor/process/get/education'] 			= 'auditor/get_auditor_education'; 
$route['auditor/process/get/competency'] 			= 'auditor/get_auditor_competency'; 
$route['auditor/process/get/unrequested_competency']= 'auditor/get_unrequested_competency'; 

$route['auditor/process/post/auditor_assignment'] 	= 'auditor/post_auditor_assignment'; 
$route['auditor/process/post/add_education'] 		= 'auditor/post_auditor_education';
$route['auditor/process/post/update_education'] 	= 'auditor/update_auditor_education';
$route['auditor/process/post/new_auditor'] 			= 'auditor/insert_new_auditor';
$route['auditor/process/post/insert/auditor_log'] 	= 'auditor/insert_auditor_log';
$route['auditor/process/post/insert/competency'] 	= 'auditor/insert_new_competency';


$route['auditor/process/update/auditor'] 		= 'auditor/update_auditor';
$route['auditor/process/update/photo_auditor'] 	= 'auditor/update_photo_auditor';

$route['auditor/process/delete/auditor'] 		= 'auditor/delete_auditor';
$route['auditor/process/delete/kompetensi'] 	= 'auditor/delete_auditor_competency';
$route['auditor/process/post/remove/auditor_log'] = 'auditor/delete_auditor_log';
$route['auditor/process/post/delete/pendidikan/formal'] = 'auditor/delete_log_pendidikan_auditor';
///////////////////////////////////////////////////////////////////////////////////////////////////

/*Nace processing*/
$route['nace/process/get/data'] 	= 'nace/get_nace_json'; 
$route['nace/process/get/unused'] 	= 'nace/getUnusedNace'; 
$route['nace/process/get/used'] 	= 'nace/getUsedNace'; 
$route['nace/process/post/insert/new/item'] 	= 'nace/insert_new_item'; 
$route['nace/process/post/update/revoke/item'] 	= 'nace/revoke_item'; 
$route['nace/process/post/update/edit/item'] 	= 'nace/update_data_nace'; 
///////////////////////////////////////////////////////////////////////////////////////////////////

/*Nace processing*/
$route['product_line/process/post/delete/item'] = 'product_line/delete_product_line_item'; 
///////////////////////////////////////////////////////////////////////////////////////////////////

/*File processing*/
$route['files/download/(:num)'] = 'files/download_file/$1'; 
///////////////////////////////////////////////////////////////////////////////////////////////////


/* End of file routes.php */
/* Location: ./application/config/routes.php */