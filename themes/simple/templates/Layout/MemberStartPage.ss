<table>
	<tr>
		<td>
			<img src="$CurrentUser.ProfileImage.SetRatioSize(250, 250).Link" />
			<h3>$CurrentUser.FirstName $CurrentUser.Surname</h3>
			<p><a href="Security/logout">Sign out</a></p>
		</td>
	</tr>
</table>
<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>
		<div class="content">
			<p>Hi $CurrentUser.FirstName</p>		
			<p>Welcome to your OVitality members area. Please complete the following steps to finalise your profile.</p>

			<section>			
				<iframe width="560" height="315" src="https://www.youtube.com/embed/Wfql_DoHRKc" frameborder="0" allowfullscreen></iframe>
			</section>

			<section>			
				$ProfileImageForm
			</section>

			<section>			
				<% if $Challenges %>
					<table>
						<tr>
							<% loop $Challenges %>
								<td>
									<h1>$Title</h1>
								</td>
							<% end_loop %>
						</tr>
					</table>
				<% end_if %>
			</section>
		</div>
	</article>
</div>