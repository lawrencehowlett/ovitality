<div class="content-container unit size1of1">
	<article>
		<h1>$Title</h1>
		<p>Hi $CurrentUser.FirstName</p>	
		<p>Welcome to your OVitality members area. Please complete the following steps to finalise your profile.</p>	
		<div class="line">
			<div class="unit size2of4">
				<iframe width="360" height="315" src="https://www.youtube.com/embed/Wfql_DoHRKc" frameborder="0" allowfullscreen></iframe>
			</div>
			<div class="unit size3of4 lastUnit">
				<div class="line">
					<div class="unit size1of1">
						<h2>1. Complete your profile by uploading a picture of yourself</h2>				
						$ProfileImageForm				
					</div>
				</div>
				<div class="line">
					<div class="unit size1of1 lastUnit">
						<h2>2. Select a challenge to join</h2>
						<div class="line">
							<% loop $Challenges %>
								<div class="unit size1of2 <% if $Last %>lastUnit<% end_if %>">
									<h3>$Title</h3>
									<ul>
										<li><a href="$JoinIndividualChallengeLink">Join Challenge (Individual)</a></li>
										<li><a href="$JoinTeamChallengeLink">Join Challenge (Team)</a></li>
									</ul>
									<p>$StartLabel $StartDate.Format(jS M Y)</p>
								</div>
							<% end_loop %>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
</div>