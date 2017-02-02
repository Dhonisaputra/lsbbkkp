
<?php echo $this->load->component('css', 'plugins/fullcalendar/fullcalendar.min.css') ?> 
<?php echo $this->load->component('js', 'plugins/fullcalendar/fullcalendar.min.js') ?>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: <?php echo $schedule; ?>,
			eventClick: function(event) {
		        if (event.url) {
		        	Tools.popupCenter(event.url,'detail assessment',500,500)
		            return false;
		        }
		    }
		});
		
	});

</script>
<style>

	body {
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>

	<div id='calendar'></div>
