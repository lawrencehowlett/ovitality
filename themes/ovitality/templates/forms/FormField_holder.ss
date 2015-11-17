<div id="$HolderID" class="field<% if $extraClass %> $extraClass<% end_if %> input-with-label text-left">

	<% if $Title %>
		<span >$Title</label>
	<% end_if %>
		$Field
	<% if $RightTitle %><label class="right" for="$ID">$RightTitle</label><% end_if %>
	<% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
	<% if $Description %><span class="description">$Description</span><% end_if %>
</div>
