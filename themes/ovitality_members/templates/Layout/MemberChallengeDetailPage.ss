<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">$ActiveChallenge.Title</h3>
                    <hr>
                </div>
                <div class="col-md-7">
                    <% if $ActiveChallenge.FeaturedVideo %>
                        <div class="embed-video-container embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="http://player.vimeo.com/video/$ActiveChallenge.FeaturedVideo?badge=0&title=0&byline=0&title=0"></iframe>
                        </div>
                    <% end_if %>

                    $ActiveChallenge.Content

                    <div>
                        <a href="#" class="btn btn-sm btn-filled">Log Points</a> 
                        <a href="#" class="btn btn-sm btn-filled">Individual Leaderboard</a> 
                        <a href="#" class="btn btn-sm btn-filled">Team Leaderboard</a>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="feature feature-1 boxed">
                                <h4>Awaiting Challenge Start</h4>
                                <div class="countdown mb40" style="font-size:50px;" data-date="2015/12/14"></div>
                            </div>
                        </div>
                    </div>

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
                        <div class="feature feature-1 boxed bordered text-center">
                            <% loop $ActiveChallenge.Attachments %>
                                <a href="$Attachment.Link" target="_blank" class="btn btn-sm" title="Go Log Points">$Title</a>
                            <% end_loop %>
                        </div>
                    <% end_if %>

                    <div class="feature">
                        <h4 class="uppercase">My Team</h4>
                        <a href="$Team.TeamManagementLink" class="btn">Manage Team</a>
                        <% if $Team.FacebookURL %>
                            <a href="$Team.FacebookURL" target="_blank" class="btn">Go to Team Facebook Group</a>
                        <% end_if %>
                    </div>

                    <% if $TeamMembers %>
                         <% loop $TeamMembers %>
                            <div class="feature boxed">
                                <div class="row">
                                    <div class="col-md-4 mb-xs-24">
                                        <img src="$ProfileImage.Link" alt="$ProfileImage.Title">
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
                    <% end_if %>
                </div>
            </div>
            <% include MemberSidebar %>
        </div>
    </div>
</section>