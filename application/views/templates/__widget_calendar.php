<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.1/fullcalendar.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.1/fullcalendar.min.css">
<style type="text/css">
	.__widget-content{ display: flex; flex-direction: column; }
	.__widget-legend--label{ display: block; margin: 15px 0px;}
	.__widget_legend{ }
</style>

<div class="__widget-content">

	<div id='__widget_calendar'></div>
	<hr>
	<div class="__widget_legend form-group">
		<label>Legend:</label>
		<div class="__widget-legend--label "><span class="label label-default" style="background:#4183D7">Re Assessment</span></div>
		<div class="__widget-legend--label "><span class="label label-default" style="background:#1BBC9B">New Assessment</span></div>
	</div>

</div>

<script type="text/javascript">
	$(function(){
		$('#__widget_calendar').fullCalendar({
	        // put your options and callbacks here
	        eventSources: [
	        	{ url: site_url('assessment/__widget_calendar') },
	        ]
	    })
	})
</script>