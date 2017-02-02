<!-- navbar -->

<style type="text/css">
    .section--navbar .popover
    {
        width: 350px !important;
        max-width: none;
        left: 770px !important;
    }    
    .__list-item-notification { display: flex; align-items:flex-start;justify-content:flex-start; }
</style>

<div class="section--navbar">

    <nav class="navbar navbar-default navbar-fixed-top container-fluid"> 
        <div class="btn-group pull-right">
            <a href="#" class="" id="__popover-notification" data-container="body" data-toggle="popover" data-placement="bottom" >
                <span class="material-icons mdl-badge mdl-badge--overlap" data-badge="1"> notifications </span>
            </a>
        </div>

    </nav>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane" id="__navbar_notif">  
            <div class="list-group list-group-notification" id="__list_group_notification">
                <a href="#" class="list-group-item __list-item-notification"> <i class="material-icons">date_range</i> Client X telah konfirmasi tanggal assessment. </a>
                <a href="#" class="list-group-item __list-item-notification"> <i class="material-icons">date_range</i> Client B telah konfirmasi tanggal reassessment. </a>
                <a href="#" class="list-group-item __list-item-notification"> <i class="material-icons">info</i> Client U reassessment telah kadaluarsa, system akan otomatis me-icebox-kan sertifikatnya.. </a>
                <a href="#" class="list-group-item __list-item-notification"> <i class="material-icons">update</i> sertifikat Client F telah diperpanjang. </a>
                <a href="#" class="list-group-item __list-item-notification"> <i class="material-icons">update</i> sertifikat Client T telah diterbitkan ulang. </a>
                <a href="#" class="list-group-item __list-item-notification"> <i class="material-icons">verified_user</i> sertifikat XX-XXX/X Milik Client K telah diterbitkan. </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(function(){
		// $('.list-group-notification').hide();

		// initialize notification popover
        $('#__popover-notification').popover({
            html:true,
            trigger:'click',
            title: 'notification',
            placement:'bottom',
            content: $('#__navbar_notif #__list_group_notification'),
            container: '.section--navbar'
        })
	})
</script>