<% if $IncludeFormTag %>
<form $AttributesHTML>
<% end_if %>

	<% if $Message %>
		<div id="{$FormName}_error" class="alert alert-warning alert-dismissible $MessageType" role="alert">
			$Message
		</div>
	<% end_if %>
	
	<% loop $Fields %>
		$FieldHolder
	<% end_loop %>

	<% if $Actions %>
		<% loop $Actions %>
			$Field
		<% end_loop %>
	<% end_if %>

<% if $IncludeFormTag %>
</form>
<% end_if %>
