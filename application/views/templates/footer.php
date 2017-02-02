
		</div> <!-- end document-actual-tab -->
		<div role="tabpanel" class="tab-pane" id="document-inline-tab">
			<section class="navbar">
				<button class="mdl-button mdl-js-button " id="doctab--btn-doctab" onclick="Doctab.hide()">
					<span class="material-icons ">chevron_left </span> Kembali
				</button>
			</section>
			<section id="document-inline-content"></section>
		</div> <!--  end  document-inline-tab-->
	</div> <!-- end tab-content -->
	<div id="snackbarTemp" class="mdl-snackbar mdl-js-snackbar" style=""> 
		<div class="mdl-spinner mdl-js-spinner is-active sr-only" style="margin-top: 9px;margin-left: 7px;"></div>
		<div class="mdl-snackbar__text"></div> 
		<button type="button" class="mdl-snackbar__action"></button> 
	</div>
</main> <!-- end main -->

</div>

<div class="popover" id="notification-popover-content" role="tooltip" data-level="<?php echo $_SESSION['level'] ?>">
	<div class="popover-content-notification" style="max-height: 70vh;">
		<div class="btn-group">
			<button type="button" class="mdl-button mdl-js-button mdl-button--icon" onclick="fetching_notification()"> <i class="material-icons">refresh</i> </button>
		</div>
		<div class="list-group flat" id="list-group-notification" style="margin-top:10px; max-height: 60vh; overflow-y: auto; overflow-x: hidden;">
			
		</div>
	</div>
</div>

<div id="lsbbkkp-helper-components">
	<div id="sound"></div>
</div>
	
</body>
</html>