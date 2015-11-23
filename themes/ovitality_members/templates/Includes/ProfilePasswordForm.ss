<form $AttributesHTML>
	<% if $Message %>
		<div id="{$FormName}_error" class="alert alert-success alert-dismissible $MessageType" role="alert">
			$Message
		</div>
	<% end_if %>

	<div class="input-with-label">
		<span>$Fields.dataFieldByName(Password).Title</span>
		$Fields.dataFieldByName(Password)
	</div>

	$Fields.dataFieldByName(SecurityID)
	<% loop $Actions %>$Field<% end_loop %>

</form>