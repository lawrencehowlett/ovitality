<form $AttributesHTML>

	<% if $Message %>
		<div id="{$FormName}_error" class="alert alert-success alert-dismissible $MessageType" role="alert">
			$Message
		</div>
	<% end_if %>

	<span>$Fields.dataFieldByName(ActivityNotification).Title</span>
	<div class="checkbox-option pull-right <% if $Fields.dataFieldByName(ActivityNotification).Value %>checked<% end_if %>">
		<div class="inner"></div>	
		$Fields.dataFieldByName(ActivityNotification)
	</div>
	<div class="clearfix"></div>
	<span>$Fields.dataFieldByName(NewsNotification).Title</span>
	<div class="checkbox-option pull-right <% if $Fields.dataFieldByName(NewsNotification).Value %>checked<% end_if %>">
		<div class="inner"></div>	
		$Fields.dataFieldByName(NewsNotification)
	</div>

	$Fields.dataFieldByName(SecurityID)
	<% loop $Actions %>$Field<% end_loop %>

</form>