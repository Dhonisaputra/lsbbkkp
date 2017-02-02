<?php #echo $this->load->component('js', 'plugins/angular/angular.min.js');  ?>
<?php #echo $this->load->component('js', 'js/jstools/angular.company_registration.js') ?>


<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs sr-only" role="tablist">
        <li role="presentation" class="<?php echo (isset($_GET['edit']) && $_GET['edit'] === 'email')? 'active' : '' ?>"><a href="#editEmail" aria-controls="home" role="tab" data-toggle="tab"></a></li>
        <li role="presentation" class="<?php echo (isset($_GET['edit']) && $_GET['edit'] === 'address')? 'active' : '' ?>"><a href="#editAddress" aria-controls="profile" role="tab" data-toggle="tab"></a></li>
        <li role="presentation" class="<?php echo (isset($_GET['edit']) && $_GET['edit'] === 'contact')? 'active' : '' ?>"><a href="#editContact" aria-controls="messages" role="tab" data-toggle="tab"></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content" ng-app="company_profile">

        <!-- edit email -->
        <div role="tabpanel" class="tab-pane <?php echo (isset($_GET['edit']) && $_GET['edit'] === 'email')? 'active' : '' ?>" id="editEmail">
            <form onsubmit="submitupdateMail(event, this)" id="updateMail" name="updateMail"> </form>
            <section class="navbar">
                <a href="<?php echo site_url('company/'.$company['id_company']) ?>" class="flat btn btn-default text-uppercase mdl-button mdl-js-button" ><i class="material-icons">keyboard_arrow_left</i> Back</a>
                <button class="flat btn btn-primary pull-right text-uppercase" type="submit" form="updateMail">update</button>
            </section>
            <div style="margin-top:10px;">
                <input type="hidden" name="id_company" value="<?php echo $company['id_company'] ?>" form="updateMail">
                <div class="form-group">
                    <input type="email" class="form-control" name="email" value="<?php echo $company['email'] ?>" form="updateMail">
                </div>
            </div>

        </div>
        <!-- end of edit email -->

        <!-- start edit address -->
        <div role="tabpanel" class="tab-pane <?php echo (isset($_GET['edit']) && $_GET['edit'] === 'address')? 'active' : '' ?>" id="editAddress">
            <div>
                
                <form id="updateAddress" name="updateAddress" onsubmit="processUpdateAddress(event, this)">
                    <input type="hidden" name="id_company" value="<?php echo $company['id_company'] ?>">
                    
                    <section class="navbar">
                        <a href="<?php echo site_url('company/'.$company['id_company']) ?>" class="flat btn btn-default text-uppercase mdl-button mdl-js-button" ><i class="material-icons">keyboard_arrow_left</i> Back</a>
                        <button class="flat btn btn-primary pull-right text-uppercase" type="submit" form="updateAddress">update</button>
                    </section>

                    <div class="form-group">
                        <label>Kota / kabupaten</label>
                        <input class="form-control" name="company_city" value="<?php echo $company['company_region'] ?>" >
                    </div>

                    <div class="form-group">
                        <label>Kodepos</label>
                        <input class="form-control" name="company_postzip" value="<?php echo $company['company_post'] ?>" >
                    </div>

                    <div class="form-group">
                        <label>Alamat perusahaan</label>
                        <textarea class="form-control" name="company_address" > <?php echo $company['company_address'] ?> </textarea>
                    </div>
                </form>

            </div>
        </div>
        <!-- end of edit address -->
        
        <!-- start of edit company contact -->
        <div role="tabpanel" class="tab-pane <?php echo (isset($_GET['edit']) && $_GET['edit'] === 'contact')? 'active' : '' ?>" id="editContact" >
            <div ng-controller="company_contact as compCont">
                <input type="hidden" ng-model="id_company" ng-value="<?php echo $company['id_company'] ?>" value="<?php echo $company['id_company'] ?>">
                <section class="navbar">
                    <a href="<?php echo site_url('company/'.$company['id_company']) ?>" class="flat btn btn-default text-uppercase mdl-button mdl-js-button" ><i class="material-icons">keyboard_arrow_left</i> Back</a>
                    <button class="flat btn btn-primary pull-right text-uppercase" onclick="$('section#form-new-contact').removeClass('sr-only');" ng-click="compCont.cancelEditContact()">Tambah kontak</button>
                </section>

                <div  style="margin-top:10px;">
                    <!-- form new contact -->
                    <section class="row sr-only" id="form-new-contact" style="margin-bottom:20px;">
                        <div class="form-new-contact col-md-4 col-xs-4 col-md-4 col-lg-4">
                            <form ng-submit="compCont.addContact()">
                                <div class="form-group">
                                    <label>Nama kontak</label>
                                    <input type="text" ng-model="compCont.newContact.name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nomor telephone</label>
                                    <input type="text" ng-model="compCont.newContact.number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Ext</label>
                                    <input type="number" ng-model="compCont.newContact.ext" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button class="flat btn btn-default text-uppercase" type="reset" ng-click="compCont.cancelAddContact()">Batal</button>
                                    <button class="flat btn btn-primary pull-right text-uppercase" type="submit">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                    </section>

                    <section class="row sr-only" id="form-edit-contact" style="margin-bottom:20px;">
                        <div class="form-edit-contact col-md-4 col-xs-4 col-md-4 col-lg-4">
                            <form ng-submit="compCont.updateContact()">
                                <div class="form-group">
                                    <label>Nama kontak</label>
                                    <input type="text" name="name" ng-model="compCont.dataEditContact.name" ng-value="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nomor telephone</label>
                                    <input type="text" name="number" ng-model="compCont.dataEditContact.number" ng-value="" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Ext</label>
                                    <input type="number" name="ext" ng-model="compCont.dataEditContact.ext" ng-value="" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button class="flat btn btn-default text-uppercase" type="reset" ng-click="compCont.cancelEditContact()">Batal</button>
                                    <button class="flat btn btn-primary pull-right text-uppercase" type="submit">Simpan data</button>
                                </div>
                            </form>
                        </div>
                    </section>    

                    <!-- list contact -->
                    <div class="list-group">
                        <div class="list-group-item active">
                            Kontak yang terdaftar
                        </div>
                        <div class="list-group-item">
                            
                            <div ng-repeat="contact in company_contact" ng-init="compCont.id_company=<?php echo $company['id_company'] ?>">
                                <div style="height: 35px; border-bottom: 1px solid #D8D8D8;margin-top: 5px;">
                                    <strong>{{contact.contact_name}}</strong>  
                                    <div class="pull-right ">
                                        {{contact.contact_number}} 
                                        <button class="text-uppercase mdl-button mdl-js-button mdl-button--icon" ng-click="compCont.editContact(this)"><i class="material-icons">mode_edit</i></button>  
                                        <button class="text-uppercase mdl-button mdl-js-button mdl-button--icon"  ng-click="compCont.removeContact(this)"><i class="material-icons">close</i></button>
                                    </div> 
                    
                                </div> <!-- end  -->
                    
                            </div> <!-- end ng-repeat -->
                    
                        </div> <!-- end list group item -->
                    
                    </div> <!-- end of list group -->

                </div> <!-- end of margin top -->

            </div> <!-- end ng controller -->
        
        </div> <!-- end of tabpanel -->

    </div> <!-- end of ng-app -->

</div>

<script type="text/javascript">
    function submitupdateMail(e, ui)
    {
        e.preventDefault();
        Snackbar.manual({message: 'Memperbarui email', spinner: true })
        var $this = $(ui),
            $data = $this.serializeArray()


        $.post(site_url('company/process/update/settings/email'), $data)
        .done(function(res){
            console.log(res)
            Snackbar.show('Email berhasil diperbarui');
        })
        .fail(function(res){
            Snackbar.show('Gagal memperbarui email')
            swal({
                title: 'Gagal dalam pembaruan email',
                text: 'Pembaruan password anda gagal. Kemungkinan karena masalah koneksi atau server yang tidak stabil!',
                showCancelButton: true,
                type: 'error',
                // closeOnConfirm: false,
            }, function(res){
                if(res)
                {
                    submitupdateMail(e, ui);
                }
            })
            console.error(res)
        })
    }

    function processUpdateAddress(e, ui)
    {
        e.preventDefault();
        Snackbar.manual({message: 'Memperbarui data alamat', spinner: true })
        var $this = $(ui),
            $data = $this.serializeArray()

        console.log($data)
        $.post(site_url('company/process/update/settings/update_address'), $data)
        .done(function(res){
            console.log(res)
            Snackbar.show('Alamat telah diperbarui');
        })
        .fail(function(res){
            Snackbar.show('Gagal saat memperbarui alamat')
            swal({
                title: 'Gagal saat memperbarui alamat',
                text: ' Pembaruan password anda gagal. Kemungkinan karena masalah koneksi atau server yang tidak stabil! Kilahkan ulangi langkah memperbarui alamat perusahaan!',
                showCancelButton: true,
                type: 'error',
                // closeOnConfirm: false,
            }, function(res){
                if(res)
                {
                    submitupdateMail(e, ui);
                }
            })
            console.error(res)
        })

    }
</script>