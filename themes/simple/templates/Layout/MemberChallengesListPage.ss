<% include MemberSidebar %>

<div class="content-container unit size3of4 lastUnit">
	<article>
		<h1>$Title</h1>

		<h3>Current and upcoming challenges</h3>
		<div class="line">
			<% loop $ActiveChallenges %>
				<% if $ComingSoon || $InProgress %>
					<div class="unit size1of2">
						<h3>$Title</h3>
						<p><a href="">Log Points</a></p>
						<p><a href="">Individual Leaderboard</a></p>
						<p><a href="">Team Leaderboard</a></p>
						<p><% if $ComingSoon %>Starting<% else_if $InProgress %>Started<% end_if %> $StartDate.Format(jS M Y)</p>
					</div>
				<% end_if %>
			<% end_loop %>		
		</div>

		<h3>Completed challenges</h3>
		<div class="line">
			<% loop $ActiveChallenges %>
				<% if $HasEnded %>
					<div class="unit size1of2">
						<h3>$Title</h3>
						<p><a href="">Individual Leaderboard</a></p>
						<p><a href="">Team Leaderboard</a></p>
					</div>
				<% end_if %>
			<% end_loop %>		
		</div>		
	</article>
</div>