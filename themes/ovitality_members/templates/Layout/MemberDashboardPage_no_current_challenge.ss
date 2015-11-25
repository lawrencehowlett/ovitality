<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">Join a challege</h3>
                    <hr>
                </div>
                <div class="col-md-12 mt48">
                    <p>To get access to all the recipes and workout videos, plus all your members benefits please join a new challenge</p>
                    <div class="row">
                        <% loop $InProgressChallenges %>
                            <div class="col-md-6">
                                <div class="feature feature-1 boxed bordered text-center">
                                    <div>
                                        <h5 class="uppercase">$Title</h5>
                                    </div>
                                    <a href="$JoinIndividualChallengeLink" class="btn" title="Join a challenge as an individual">Join Challenge (Individual)</a>
                                    <a href="$JoinTeamChallengeLink" class="btn" title="Join a challenge as a team">Join Challenge As a Team</a>
                                    <p class="uppercase">$StartLabel $StartDate.Format(jS M Y)</p>
                                </div>
                            </div>
                        <% end_loop %>                            
                    </div>
                </div>
                <div class="col-md-12 mt48">
                    <h4 class="uppercase">Completed Challenges</h4>
                    <div class="row">
                        <% loop $CompletedChallenges %>
                            <div class="col-md-6">
                                <div class="feature feature-1 boxed bordered text-center">
                                    <div>
                                        <h5 class="uppercase">$Title</h5>
                                    </div>
                                    <a href="" class="btn" title="Checkout individual leaderboard">Individual Leaderboard</a>
                                    <a href="" class="btn" title="Checkout team leaderboard">Team Leaderboard</a>
                                    <p class="uppercase">Challenge Complete</p>
                                </div>
                            </div>
                        <% end_loop %>                        
                    </div>
                </div>
            </div>
            <% include MemberSidebar %>
        </div>
    </div>
</section>