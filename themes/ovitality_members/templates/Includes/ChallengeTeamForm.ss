<form $AttributesHTML>

	<% if $Message %>
		<div id="{$FormName}_error" class="alert alert-success alert-dismissible $MessageType" role="alert">
			$Message
		</div>
	<% end_if %>

	<% if $Fields.dataFieldByName(Category) %>
		<div class="input-with-label">
			<span>$Fields.dataFieldByName(Category).Title</span>			
			$Fields.dataFieldByName(Category)
		</div>
	<% end_if %>

	<% if $Fields.dataFieldByName(AutoAssignedTeam) %>
		<span>$Fields.dataFieldByName(AutoAssignedTeam).Title</span>
		<div class="checkbox-option pull-right">
		    <div class="inner"></div>
			$Fields.dataFieldByName(AutoAssignedTeam)
		</div>
	<% end_if %>

	<% if $Fields.dataFieldByName(TeamAssignment) %>
		<h5 class="uppercase">Choose a method below to join a team</h5>
		<div id="Form_Form_TeamAssignment" class="input-with-label">
			<span>$Fields.dataFieldByName(TeamAssignment).Title</span>
			$Fields.dataFieldByName(TeamAssignment)
		</div>
	<% end_if %>

	<div id="JoinExistingTeam" class="input-with-label mt16" style="display: none;">
		<span>$Fields.dataFieldByName(SuggestTeam).Title</span>
		$Fields.dataFieldByName(SuggestTeam)
		$Fields.dataFieldByName(TeamID)
	</div>

	<div id="CreateNewTeam" class="row mt16" style="display: none;">
		<div class="col-md-12">
			<h5 class="uppercase">Create a new team and invite your friends to earn extra points!</h5>
			<div class="input-with-label">
				<span>$Fields.dataFieldByName(TeamName).Title</span>
				$Fields.dataFieldByName(TeamName)
			</div>
			<h5 class="uppercase mt36">Invite your team members</h5>
		</div>
		<div class="col-md-6">
			<div class="input-with-label">
				<span>$Fields.dataFieldByName(TeamMemberName[]).Title</span>
				$Fields.dataFieldByName(TeamMemberName[])
			</div>			
		</div>
		<div class="col-md-6">
			<div class="input-with-label">
				<span>$Fields.dataFieldByName(TeamMemberEmail[]).Title</span>
				$Fields.dataFieldByName(TeamMemberEmail[])
			</div>			
		</div>
		<div class="col-md-6">
			<div class="input-with-label">
				<span>$Fields.dataFieldByName(TeamMemberName[]).Title</span>
				$Fields.dataFieldByName(TeamMemberName[])
			</div>			
		</div>
		<div class="col-md-6">
			<div class="input-with-label">
				<span>$Fields.dataFieldByName(TeamMemberEmail[]).Title</span>
				$Fields.dataFieldByName(TeamMemberEmail[])
			</div>			
		</div>
		<div class="col-md-6">
			<div class="input-with-label">
				<span>$Fields.dataFieldByName(TeamMemberName[]).Title</span>
				$Fields.dataFieldByName(TeamMemberName[])
			</div>			
		</div>
		<div class="col-md-6">
			<div class="input-with-label">
				<span>$Fields.dataFieldByName(TeamMemberEmail[]).Title</span>
				$Fields.dataFieldByName(TeamMemberEmail[])
			</div>			
		</div>
	</div>

	$Fields.dataFieldByName(SecurityID)
	<% loop $Actions %>$Field<% end_loop %>	
</form>