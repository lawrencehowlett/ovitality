<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>        
            <div class="col-md-10 mb-xs-24">
            	<div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="uppercase mb0">Teams I Coach</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <!--<a href="{$Link}CreateTeam" class="btn btn-filled " title="Create team">Create New Team</a>-->
                        </div>
                    </div>
                    <hr />
            	</div>
                <div class="col-md-12">
                    <% if $FeedbackMessage %>
                        <div class="alert alert-success" role="alert">$FeedbackMessage</div>
                    <% end_if %>

                    <% if $CurrentUser.CoachTeams %>
                    <ul class="accordion accordion-1">
                        <% loop $CurrentUser.CoachTeams %>
                            <li>
                                <div class="title">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="uppercase">$Title</h5>
                                            <p>$Description</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="content" style="padding:10px;">
                                    <div class="row">
                                        <% if $Leaders %>
                                            <div class="col-md-12">
                                                <h5>Team Leaders</h5>
                                            </div>
                                            <% loop $Leaders %>
                                                <div class="col-md-6 mb16">
                                                    <div class="row v-align-children">
                                                        <div class="col-md-5 mb-xs-24">
                                                            <% if $ProfileImage %>
                                                                <img src="$ProfileImage.Link" alt="$ProfileImage.Title" class="cast-shadow">
                                                            <% end_if %>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <h5 class="mb0">$FullName</h5>
                                                            <p class="mb0">$Email</p>
                                                            <p>$Phone</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <% end_loop %>
                                        <% end_if %>

                                        <div class="col-md-12">
                                            <h5>Members</h5>
                                        </div>
                                        <% if $TeamMembersForFrontend %>
                                            <% loop $TeamMembersForFrontend %>
                                                <div class="col-md-6 mb16">
                                                    <div class="row v-align-children">
                                                        <div class="col-md-5 mb-xs-24">
                                                            <% if $ProfileImage %>
                                                                <img src="$ProfileImage.Link" alt="$ProfileImage.Title" class="cast-shadow">
                                                            <% end_if %>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <h5 class="mb0">$FullName</h5>
                                                            <p class="mb0">$Email</p>
                                                            <p>$Phone</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <% end_loop %>
                                        <% else %>
                                            <div class="col-md-12">
                                                <p class="alert alert-info" role="alert">
                                                    You don't have team members yet.
                                                </p>
                                            </div>
                                        <% end_if %>
                                        <!--<div class="col-md-12 mt16">
                                            <a href="{$Top.Link}InviteMembers/$ID" class="btn btn-filled">Invite Your Team Members</a>
                                        </div>-->
                                    </div>
                                </div>
                            </li>
                        <% end_loop %>
                    </ul>
                    <% else %>
                        <div class="alert alert-info" role="alert">You don't have any teams for this challenge.</div>
                    <% end_if %>
                </div>
            </div>
        </div>
    </div>
</section>