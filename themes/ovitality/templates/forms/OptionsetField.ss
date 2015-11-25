<% loop $Options %>
	<div $AttributesHTML>
	    <div class="radio-option $Class <% if $isChecked %>checked<% end_if %>">
	        <div class="inner"></div>
	        <input id="$ID" class="radio" name="$Name" type="radio" value="$Value"<% if $isChecked %> checked<% end_if %><% if $isDisabled %> disabled<% end_if %> />
	    </div>
	    <span>$Title</span>
	</div>
<% end_loop %>