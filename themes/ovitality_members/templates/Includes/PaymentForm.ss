<form $AttributesHTML>
	<% if $Message %>
		<div id="{$FormName}_error" class="alert alert-success alert-dismissible $MessageType" role="alert">
			$Message
		</div>
	<% end_if %>

	<span>I agree to the <a href="" title="Go to our terms and conditions">terms and conditions</a></span>
	<div class="checkbox-option pull-right">
	    <div class="inner"></div>
	    $Fields.dataFieldByName(TermsConditions)
	</div>	

	$Fields.dataFieldByName(SecurityID)
	<% loop $Actions %>$Field<% end_loop %>
</form>