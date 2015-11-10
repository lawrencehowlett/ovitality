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
			<% loop $PaginatedRecipes %>
				<td>
					<a href="$AbsoluteLink">
						<img src="$GalleryImages.First.Image().CroppedImage(150, 150).Link" / ><br>
						$Title
					</a>
				</td>
			<% end_loop %>
		</tr>
	</table>

	<% if $PaginatedRecipes.MoreThanOnePage %>
	    <% if $PaginatedRecipes.NotFirstPage %>
	        <a class="prev" href="$PaginatedRecipes.PrevLink">Prev</a>
	    <% end_if %>
	    <% loop $PaginatedRecipes.Pages %>
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
	    <% if $PaginatedRecipes.NotLastPage %>
	        <a class="next" href="$PaginatedRecipes.NextLink">Next</a>
	    <% end_if %>
	<% end_if %>	
</div>