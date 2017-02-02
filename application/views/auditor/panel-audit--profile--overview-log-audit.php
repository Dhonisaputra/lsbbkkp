<div class="overview-log-audit col-md-12">
	<!-- Icon button -->

	<h3>Log Audit</h3>
	<table class="table table-stripped table-hover table-bordered table-auditor-profile-overview--log-audit" id="table-auditor-profile-overview--log-audit" style="width:100%; margin:none;">
		<thead>
			<tr>
				<th>No.</th>
				<th>Tanggal audit</th>
				<th>Audit sebagai</th>
				<th>Perusahaan</th>
				<th>Type audit</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div>

<script type="text/javascript">
	// log audit
	window.auditorLog = $('#table-auditor-profile-overview--log-audit').DataTable({
        info: false,
        lengthChange: false,
        searching: false,
        ajax: {
            url: site_url('auditor/process/get/log/auditor'),
            type: 'POST',
            data: function(d){
            	return {id_auditor: '<?php echo $profile["id_auditor"] ?>'}
            },
            dataSrc: function(json)
            {
                console.log(json);
                json = (json.data)? json.data : json;
                var i = 1;
                $.each(json, function(a,b){
                	json[a]['no'] = i;
                	json[a]['action'] = '<button class="mdl-button mdl-js-button mdl-button--icon" onclick="editAuditorEducation(this)" ><i class="material-icons" style="font-size:20px;">create</i></button>';
                	i++;
                })
                if(!json){return false; }
                return json;
            }
        },
        columns:[
            {data: 'no'},
            {data: 'audit_date'},
            {data: 'nama_jabatan'},
            {data: 'company_name'},
            {data: 'assessment_type'},
        ]
    })
</script>