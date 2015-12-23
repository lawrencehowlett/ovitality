<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">$ActiveChallenge.Title</h3>
                    <hr>
                </div>
                <div class="col-md-7">
                    <% if $ActiveChallenge.FeaturedVideo %>
                        <div class="embed-video-container embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="$ActiveChallenge.FeaturedVideo?badge=0&title=0&byline=0&title=0"></iframe>
                        </div>
                    <% end_if %>

                    $ActiveChallenge.Content

                    <div>
                        <% if $CurrentUser.IsLevelTwoAccess || $CurrentUser.IsLevelThreeAccess %>
                            <a href="$MyLogPointsPage.Link" title="Go to Log Points Page" class="btn btn-sm btn-filled">Log Points</a> 
                        <% end_if %>

                        <a href="#" class="btn btn-sm btn-filled">Individual Leaderboard</a> 
                        <a href="#" class="btn btn-sm btn-filled">Team Leaderboard</a>
                    </div>

                    <% if $ActiveChallenge.ShowCountdown %>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="feature feature-1 boxed">
                                    <h4>Awaiting Challenge Start</h4>
                                    <div class="countdown mb40" style="font-size:50px;" data-date="$ActiveChallenge.StartDate.Format('Y/m/d')"></div>
                                </div>
                            </div>
                        </div>
                    <% end_if %>

                    <% if $ActiveChallenge.DailyChallenges %>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="testimonials text-slider challenge-today-slider">
                                    <ul class="slides">
                                        <% loop $ActiveChallenge.DailyChallenges %>
                                            <li>
                                                
                                                <div class="image-tile outer-title">
                                                    <% if $Image %>
                                                        <img src="$Image.PaddedImage(577, 442).Link" alt="$Image.Title" />
                                                    <% end_if %>

                                                    <div class="title mt16 mb16">
                                                        <h5 class="uppercase mb0">$Title</h5>
                                                    </div>

                                                    $Content
                                                    
                                                </div>
                                            </li>
                                        <% end_loop %>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <% end_if %>

                </div>
                <div class="col-md-5">
                    <% if $ActiveChallenge.Attachments %>
                        <div class="feature feature-1 boxed cast-shadow-light">
                            <h4 class="color-primary mb8"><i class="ti-download"></i> $ActiveChallenge.AttachmentsTitle</h4>
                            $ActiveChallenge.AttachmentsText
                            <% if $ActiveChallenge.Attachments %>
                                <% loop $ActiveChallenge.Attachments %>
                                    <a href="$Attachment.Link" class="btn btn-sm" target="_blank" title="$Title">
                                        <i class="ti-file"></i> $Title
                                    </a>
                                <% end_loop %>
                            <% else %>
                                <p>There are no available downloads for this challenge</p>
                            <% end_if %>
                        </div>
                    <% end_if %>

                    <% if $CurrentUser.ActiveChallengeReference.IsTeam %>
                        <div class="feature">
                            <h4 class="uppercase">My Team</h4>

                            <% if $CurrentUser.LeaderActiveTeam %>
                                <a href="$Team.TeamManagementLink" class="btn btn-sm"><i class="ti-user"></i> Manage Team</a>
                            <% end_if %>

                            <% if $Team.FacebookURL %>
                                <a href="$Team.FacebookURL" target="_blank" class="btn btn-sm">
                                    <i class="ti-facebook"></i> Go to Team Facebook Group
                                </a>
                            <% end_if %>
                        </div>
                    <% end_if %>

                    <% if $TeamMembers %>
                         <% loop $TeamMembers %>
                            <div class="feature boxed">
                                <div class="row">
                                    <div class="col-md-4 mb-xs-24">
                                        <% if $ProfileImage %>
                                            <img src="$ProfileImage.Link" alt="$ProfileImage.Title">
                                        <% end_if %>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="uppercase mb8">$FullName</h6>
                                        <p>
                                            <a href="mailto:$Email">$Email</a> <br>
                                            $Phone
                                        </p>
                                    </div>
                                </div>
                            </div>
                         <% end_loop %>
                    <% else %>
                        <% if $CurrentUser.LeaderActiveTeam %>
                            <p class="alert alert-warning">
                                You don't have team members yet. 
                                <% if $Team.CanInviteMembers %><br><a href="{$Team.TeamManagementLink}invite">Send team invitation</a><% end_if %>
                            </p>
                        <% end_if %>
                    <% end_if %>
                </div>
            </div>
        </div>
    </div>
</section>