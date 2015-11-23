<div class="image-tile outer-title">
	<% if $CustomisedItems %>
		<% loop $CustomisedItems %>
			<img alt="$hasRelation" src="$URL" />
		<% end_loop %>
	<% end_if %>
    <div class="title mb16 input-with-label">
		<label class="ss-uploadfield-fromcomputer ss-ui-button ui-corner-all" data-icon="drive-upload">
			<span>From your computer</span>
			<input id="$id" name="{$Name}[Uploads][]" class="$extraClass ss-uploadfield-fromcomputer-fileinput" data-config="$configString" type="file" />
		</label>    
    </div>
</div>