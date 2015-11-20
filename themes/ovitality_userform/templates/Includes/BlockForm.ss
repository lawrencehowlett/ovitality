<form $AttributesHTML>
	
<% include UserFormProgress %>
<% include UserFormStepErrors %>

<% if $Message %>
	<div id="{$FormName}_error" class="alert alert-warning alert-dismissible $MessageType" role="alert">
		$Message
	</div>
<% end_if %>

<% loop $Fields %>
	$FieldHolder
<% end_loop %>

<% if $Steps.Count > 1 %>
	<% include UserFormStepNav %>
<% else %>
	<% include UserFormActionNav %>
<% end_if %>

</form>
