var company_profile = angular.module('company_profile', [])

company_profile.controller('company_address', function($scope, $http){
	// initialize scope variable as this. its diferrent with $scope
	var scope = this;

	scope.dataUpdate = {}


	this.updateAddress = function()
	{
		console.log(scope, $scope, $scope.id_company)
	}
})
.controller('company_contact', function($scope, $http){
	// initialize scope variable as this. its diferrent with $scope
	var scope = this;
	// 
	scope.dataEditContact = {}
	
	// get array company contact
	$scope.company_contact = [];
	
	// function get data company
	function getCompanyContact()
	{
		var def = $.Deferred();
		$http({
		  	method  : 'POST',
		  	url     : base_url('company/get_company_contacts'),
		  	data    : $.param({id_company: $scope.id_company}),  // pass in data as strings
		  	headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
		})
		.then(function successCallback(response) {
			def.resolve(response.data)
		}, function errorCallback(response) {
			console.error(response)
		});

		return $.when(def.promise() );
	}

	getCompanyContact().done(function(data){
		$scope.company_contact = data;
	})

	// function remove contact
	this.removeContact = function(ui){

		// check apakah sedang diedit?
		if($('section#form-edit-contact').hasClass('sr-only') == false && $('section#form-edit-contact [name="number"]').val() == ui.contact.contact_number)
		{
			swal('Kesalahan saat menghapus kontak', 'Kontak ini masih dalam tahap perubahan data. Silahkan batalkan perubahan data lalu ulangi aksi hapus kontak!', 'error');
			return false;
		}

		var id_company 	= $scope.compCont.id_company,
			data 		= {id_company: id_company, no_telp: ui.contact.contact_number};
		
		swal({
			title: 'Hapus kontak',
			text: 'Apakah anda yakin ingin menghapus kontak ini? Aksi ini akan menghapus kontak secara permanen.',
			type: 'warning',
			showCancelButton: true,
			closeOnConfirm: true,
			allowEscapeKey: false,
		}, function(e){
			if(e)
			{
				Snackbar.manual({message: 'Sedang menghapus kontak. Silahkan tunggu!', spinner: true});

				$http({
				  	method  : 'POST',
				  	url     : site_url('company/process/update/settings/remove_contact'),
				  	data    : $.param(data),  // pass in data as strings
				  	headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
				 })
				.then(function successCallback(response) {
					console.log(response);

					Snackbar.show('Kontak telah dihapus');
					getCompanyContact().done(function(data){
						$scope.company_contact = data;
					})
					
				}, function errorCallback(response) {
					console.log(response);
					swal({
						title: 'Kesalahan saat menghapus kontak',
						text: 'Gagal dalam menghapus kontak. silahkan ulang kembali aksi ini!',
						type: 'error',
					})
				});
			}
		});
	};

	this.addContact = function()
	{
		var data = scope.newContact;
		data.id_company = $scope.compCont.id_company
		$http({
		  	method  : 'POST',
		  	url     : site_url('company/process/update/settings/add_contact'),
		  	data    : $.param(data),  // pass in data as strings
		  	headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
		 })
		.then(function successCallback(response) {

			Snackbar.show('contact has been added');
			getCompanyContact().done(function(data){
				$scope.company_contact = data;
			})
			scope.newContact.ext = ''
			scope.newContact.name = ''
			scope.newContact.number = ''
			
		}, function errorCallback(response) {
			swal({
				title: 'Gagal saat menambahkan kontak',
				text: 'Gagal saat menambahkan kontak. Silahkan ulangi kembali! ',
				type: 'error',
			})
		});
	};

	this.cancelAddContact = function()
	{
		$('section#form-new-contact').addClass('sr-only')
	};

	this.editContact = function(ui)
	{
		console.log(scope, $scope)

		scope.dataEditContact.ext = parseInt(ui.contact.ext)
		scope.dataEditContact.name = ui.contact.contact_name
		scope.dataEditContact.number = ui.contact.contact_number
		scope.dataEditContact.old_number = ui.contact.contact_number
		$('section#form-edit-contact').removeClass('sr-only')
		scope.cancelAddContact();
	};

	this.updateContact = function()
	{
		Snackbar.manual({message: 'Memperbarui kontak. Silahkan tunggu', spinner:true})

		var data = scope.dataEditContact;
		data.id_company = scope.id_company
		$http({
		  	method  : 'POST',
		  	url     : site_url('company/process/update/settings/update_contact'),
		  	data    : $.param(data),  // pass in data as strings
		  	headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
		 })
		.then(function successCallback(response) {
			console.log(response);

			Snackbar.show('Kontak selesai diperbarui');
			getCompanyContact().done(function(data){
				$scope.company_contact = data;
			})

			scope.cancelEditContact();
			
		}, function errorCallback(response) {
			console.log(response);
			swal({
				title: 'Kesalahan saat memperbarui kontak',
				text: 'Gagal dalam memperbarui kontak. Silahkan klik tombol OK untuk refresh halaman lalu ulangi kembali!',
				type: 'error',
				function(e){
					if(e)
					{
						window.location.reload();
					}
				}
			})
		});
		
	};

	this.cancelEditContact = function()
	{	
		scope.dataEditContact.ext = '';
		scope.dataEditContact.name = '';
		scope.dataEditContact.number = '';
		$('section#form-edit-contact').addClass('sr-only')
	}

})
