<div id="$HolderID" class="field<% if $extraClass %> $extraClass<% end_if %> input-with-label text-left">
	<span>$Title</span>
	<div class="checkbox-option pull-right">
	    <div class="inner"></div>
	    $Field
		<% if $Message %><span class="message $MessageType">$Message</span><% end_if %>
		<% if $Description %><span class="description">$Description</span><% end_if %>
	</div>
</div>