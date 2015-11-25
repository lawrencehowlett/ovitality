<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-xs-24">
            	<div class="col-md-12">
	                <h3 class="uppercase mb0">
						$Title
					</h3>
                    <hr>
                    <p class="lead">Hi $CurrentMember.FirstName</p>
                    <p class="lead">Welcome to your OVitality members area. Please complete the following steps to finalise your profile.</p>
            	</div>

                <div class="col-md-5 mt16">
                    <div class="embed-video-container embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="http://player.vimeo.com/video/25737856?badge=0&title=0&byline=0&title=0"></iframe>
                    </div>                    
                </div>
                <div class="col-md-7 mt16">
                    <div class="row">
                        <div class="col-md-2">
                            <h3 class="uppercase">1.</h3>
                        </div>
                        <div class="col-md-10">
                            <p class="input-with-label"><span>Complete your profile by uploading a picture of yourself</span></p>
                            $ProfileImageForm
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <h3 class="uppercase">2.</h3>
                        </div>
                        <div class="col-md-10">
                            <p class="input-with-label"><span>Select a challenge to join</span></p>
                            <div class="row">
                                <% loop $Challenges %>
                                    <div class="col-md-6">
                                        <div class="feature feature-1 boxed text-center">
                                            <div>
                                                <h5 class="uppercase">$Title</h5>
                                            </div>
                                            <p>Join a challenge</p>
                                            <a href="$JoinIndividualChallengeLink" class="btn">As Individual</a>
                                            <a href="$JoinTeamChallengeLink" class="btn">As a Team</a>
                                            <p>$StartLabel $StartDate.Format(jS M Y)</p>
                                        </div>
                                    </div>
                                <% end_loop %>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>