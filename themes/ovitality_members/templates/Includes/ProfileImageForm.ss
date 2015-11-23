<form $AttributesHTML>
	<div class="col-md-8">

	<% if $Message %>
		<div id="{$FormName}_error" class="alert alert-success alert-dismissible $MessageType" role="alert">
			$Message
		</div>
	<% end_if %>

	$Fields.dataFieldByName(ProfileImage)

	$Fields.dataFieldByName(SecurityID)
	<% loop $Actions %>$Field<% end_loop %>	
</form>