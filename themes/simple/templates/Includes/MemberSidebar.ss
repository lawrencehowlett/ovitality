<aside class="sidebar unit size1of4">
	<table>
		<tr>
			<td>
				<img src="$CurrentUser.ProfileImage.SetRatioSize(230, 230).Link" />
				<h3>$CurrentUser.FirstName $CurrentUser.Surname</h3>
				<p><a href="Security/logout">Sign out</a></p>
			</td>
		</tr>
	</table>
	<% if $Menu(2) %>
		<nav class="secondary">
			<% with $Level(1) %>
				<ul>
					<% include SidebarMenu %>
				</ul>
			<% end_with %>
		</nav>
	<% end_if %>
</aside>
