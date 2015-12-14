<form $AttributesHTML>

	<% if $Message %>
		<div class="col-md-12">
			<div id="{$FormName}_error" class="alert alert-success alert-dismissible $MessageType" role="alert">
				$Message
			</div>
		</div>
	<% end_if %>

	<div class="col-md-6">
		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Name[]).Title</span>			
			$Fields.dataFieldByName(Name[])
		</div>

		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Name[]).Title</span>			
			$Fields.dataFieldByName(Name[])
		</div>
	</div>

	<div class="col-md-6">
		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Email[]).Title</span>			
			$Fields.dataFieldByName(Email[])
		</div>
		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Email[]).Title</span>			
			$Fields.dataFieldByName(Email[])
		</div>
	</div>

	<div class="col-md-6 col-md-onset-6">
		$Fields.dataFieldByName(SecurityID)
		<% loop $Actions %>$Field<% end_loop %>    
	</div>

</form>