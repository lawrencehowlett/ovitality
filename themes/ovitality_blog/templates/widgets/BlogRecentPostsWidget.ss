<% if $Posts %>
	<ul class="link-list recent-posts">
		<% loop $Posts %>
			<li>
				<a href="$Link" title="$Title">
					$Title
				</a>
				<span class="date">$PublishDate.Format('F d, Y')</span>
			</li>
		<% end_loop %>
	</ul>
<% end_if %>