<form $AttributesHTML>

	<% if $Message %>
		<div id="{$FormName}_error" class="alert <% if $MessageType == 'good' %>alert-success<% else %>alert-danger<% end_if %>" role="alert">
			$Message
		</div>
	<% end_if %>

	<% if $Fields.dataFieldByName(Category) %>
		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Category).Title</span>			
			$Fields.dataFieldByName(Category)
		</div>
	<% end_if %>

	<% if $Fields.dataFieldByName(AutoAssignTeam) %>
		<p class="input-with-label"><span>Would you like to be assigned to a team?</span></p>
		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
		<span>$Fields.dataFieldByName(AutoAssignTeam).Title</span>
		<div class="checkbox-option pull-right <% if $Fields.dataFieldByName(AutoAssignTeam).Value %>checked<% end_if %>">
		    <div class="inner"></div>
			$Fields.dataFieldByName(AutoAssignTeam)
		</div>
	<% end_if %>

	<% if $Fields.dataFieldByName(JoinExistingTeam) %>
		<div class="mt32">
			<p class="input-with-label"><span>OR Join an existing team</span></p>
			<span>$Fields.dataFieldByName(JoinExistingTeam).Title</span>
			<div class="checkbox-option pull-right <% if $Fields.dataFieldByName(JoinExistingTeam).Value %>checked<% end_if %>">
			    <div class="inner"></div>
				$Fields.dataFieldByName(JoinExistingTeam)
			</div>

			<div id="JoinExistingTeam" class="mt16">
				<span>$Fields.dataFieldByName(SuggestTeam).Title</span>
				$Fields.dataFieldByName(SuggestTeam)
				$Fields.dataFieldByName(TeamID)
			</div>
		</div>
	<% end_if %>	

	<% if $Fields.dataFieldByName(TeamName) %>
		<div id="CreateNewTeam" class="row mt16">
			<div class="col-md-12">
			<p class="input-with-label"><span>OR Create a new team and invite your friends to earn extra points!</span></p>
				<div>
					<span>$Fields.dataFieldByName(TeamName).Title</span>
					$Fields.dataFieldByName(TeamName)
				</div>
				<p class="input-with-label"><span>Invite your team members</span></p>
			</div>
			<div class="col-md-6">
				<div>
					<span>$Fields.dataFieldByName(TeamMemberName[]).Title</span>
					$Fields.dataFieldByName(TeamMemberName[])
				</div>			
			</div>
			<div class="col-md-6">
				<div>
					<span>$Fields.dataFieldByName(TeamMemberEmail[]).Title</span>
					$Fields.dataFieldByName(TeamMemberEmail[])
				</div>			
			</div>
			<div class="col-md-6">
				<div>
					<span>$Fields.dataFieldByName(TeamMemberName[]).Title</span>
					$Fields.dataFieldByName(TeamMemberName[])
				</div>			
			</div>
			<div class="col-md-6">
				<div>
					<span>$Fields.dataFieldByName(TeamMemberEmail[]).Title</span>
					$Fields.dataFieldByName(TeamMemberEmail[])
				</div>			
			</div>
			<div class="col-md-6">
				<div>
					<span>$Fields.dataFieldByName(TeamMemberName[]).Title</span>
					$Fields.dataFieldByName(TeamMemberName[])
				</div>			
			</div>
			<div class="col-md-6">
				<div>
					<span>$Fields.dataFieldByName(TeamMemberEmail[]).Title</span>
					$Fields.dataFieldByName(TeamMemberEmail[])
				</div>			
			</div>
		</div>
	<% end_if %>

	$Fields.dataFieldByName(SecurityID)
	<% loop $Actions %>$Field<% end_loop %>	
</form>