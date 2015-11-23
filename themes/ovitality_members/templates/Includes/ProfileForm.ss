<form $AttributesHTML>
	<div class="col-md-8">

	<% if $Message %>
		<div id="{$FormName}_error" class="alert alert-success alert-dismissible $MessageType" role="alert">
			$Message
		</div>
	<% end_if %>

		<div class="input-with-label">
			<span>$Fields.dataFieldByName(FirstName).Title</span>
			$Fields.dataFieldByName(FirstName)
		</div>

		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Surname).Title</span>
			$Fields.dataFieldByName(Surname)
		</div>

		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Email).Title</span>
			$Fields.dataFieldByName(Email)
		</div>		

		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Phone).Title</span>
			$Fields.dataFieldByName(Phone)
		</div>

		$Fields.dataFieldByName(SecurityID)
		<% loop $Actions %>$Field<% end_loop %>
	</div>
	<div class="col-md-4">
		$Fields.dataFieldByName(ProfileImage)
	</div>
</form>