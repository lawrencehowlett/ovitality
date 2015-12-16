<form $AttributesHTML>

	<% if $Message %>
		<div class="col-md-12">
			<div id="{$FormName}_error" class="alert alert-info alert-dismissible $MessageType" role="alert">
				$Message
			</div>
		</div>
	<% end_if %>

	<div class="col-md-6">
		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Title).Title</span>			
			$Fields.dataFieldByName(Title)
		</div>

		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Limit).Title</span>			
			$Fields.dataFieldByName(Limit)
		</div>

		<div class="input-with-label">
			<span>$Fields.dataFieldByName(FacebookURL).Title</span>			
			$Fields.dataFieldByName(FacebookURL)
		</div>

		$Fields.dataFieldByName(SecurityID)
		<% loop $Actions %>$Field<% end_loop %>		
	</div>
	<div class="col-md-6">
		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Description).Title</span>			
			$Fields.dataFieldByName(Description)
		</div>
	</div>

</form>