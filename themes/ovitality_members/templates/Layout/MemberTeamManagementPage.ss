<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>        
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">My Team > $Team.Title</h3>
                    <hr>
                </div>
                <% if $FeedbackMessage %>
                    <div class="col-md-12">
                        <p class="alert alert-success">$FeedbackMessage</p>
                    </div>
                <% end_if %>
                $TeamForm

                <div class="col-md-12 mt64">
                    <h4 class="uppercase">My Team Members</h4>

                    <% if $Team.CanInviteMembers %>
                        <a href="{$Link}invite" class="btn">Invite Team Members ($Team.NumberMemberSpacesLeft space(s) left)</a>
                    <% end_if %>

                </div>

                <% if $Team.TeamLeaders %>
                    <% loop $Team.TeamLeaders %>
                        <div class="col-md-4 col-sm-6">
                            <div class="image-tile outer-title text-center">
                                <img src="$ProfileImage.PaddedImage(350, 350).Link" alt="$ProfileImage.Title">
                                <div class="title mb16">
                                    <h5 class="uppercase mb0">$FullName</h5>
                                    <a href="mailto:$Email"><span>$Email</span></a> <br>
                                    $Phone
                                </div>
                                <div>
                                    <a href="{$Top.Link}leader/unassign/$ID" class="btn btn-sm" title="notify as team leader">
                                        Unassign as team leader
                                    </a>

                                    <a href="{$Top.Link}remove/confirm/$ID" class="btn btn-sm alert-danger" title="remove team member">
                                        Remove from team
                                    </a>
                                </div>
                            </div>
                        </div>
                    <% end_loop %>
                <% end_if %>

                <% if $Team.TeamMembersForFrontend %>
                    <% loop $Team.TeamMembersForFrontend %>
                        <div class="col-md-4 col-sm-6">
                            <div class="image-tile outer-title text-center">
                                <img src="$ProfileImage.PaddedImage(350, 350).Link" alt="$ProfileImage.Title">
                                <div class="title mb16">
                                    <h5 class="uppercase mb0">$FullName</h5>
                                    <a href="mailto:$Email"><span>$Email</span></a> <br>
                                    $Phone
                                </div>
                                <div>
                                    <a href="{$Top.Link}leader/nominate/$ID" class="btn btn-sm" title="notify as team leader">
                                        Nominate as team leader
                                    </a>

                                    <a href="{$Top.Link}remove/confirm/$ID" class="btn btn-sm alert-danger" title="remove team member">
                                        Remove from team
                                    </a>
                                </div>
                            </div>
                        </div>
                    <% end_loop %>
                <% end_if %>

            </div>
        </div>
    </div>
</section>