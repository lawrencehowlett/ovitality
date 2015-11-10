<aside class="sidebar unit size1of4" style="display: block;">
	<% if $Categories %>
		<nav class="secondary">
			<h3>Categories</h3>
			<ul>
				<% loop $Categories %>
					<li><a href="$AbsoluteLink">$Title</a></li>
				<% end_loop %>
			</ul>
		</nav>
	<% end_if %>
</aside>

<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">$Content</div>
	</article>

	<table>
		<tr>
			<% loop $PaginatedVideos %>
				<td>
					<a href="$AbsoluteLink">
						<img src="$FeaturedImage.CroppedImage(150, 150).Link" / ><br>
						$Title
					</a>
				</td>
			<% end_loop %>
		</tr>
	</table>

	<% if $PaginatedVideos.MoreThanOnePage %>
	    <% if $PaginatedVideos.NotFirstPage %>
	        <a class="prev" href="$PaginatedVideos.PrevLink">Prev</a>
	    <% end_if %>
	    <% loop $PaginatedVideos.Pages %>
	        <% if $CurrentBool %>
	            $PageNum
	        <% else %>
	            <% if $Link %>
	                <a href="$Link">$PageNum</a>
	            <% else %>
	                ...
	            <% end_if %>
	        <% end_if %>
	        <% end_loop %>
	    <% if $PaginatedVideos.NotLastPage %>
	        <a class="next" href="$PaginatedVideos.NextLink">Next</a>
	    <% end_if %>
	<% end_if %>	
</div>