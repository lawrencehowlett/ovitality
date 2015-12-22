<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">Join a challege</h3>
                    <hr>
                </div>
                <div class="col-md-12 mt48">
                    <p>To get access to all the recipes and workout videos, plus all your members benefits please join a new challenge</p>
                    <div class="row">
                        <% loop $AvailableChallenges %>
                            <div class="col-md-6">
                                <div class="feature feature-1 boxed bordered text-center">
                                    <div>
                                        <h5 class="uppercase">$Title</h5>
                                    </div>
                                    <a href="$JoinIndividualChallengeLink" class="btn" title="Join a challenge as an individual">Join Challenge (Individual)</a>
                                    <a href="$JoinTeamChallengeLink" class="btn" title="Join a challenge as a team">Join Challenge (Team)</a>
                                    <p class="uppercase">$StartLabel $StartDate.Format(jS M Y)</p>
                                </div>
                            </div>
                        <% end_loop %>                            
                    </div>
                </div>
                <% if $CompletedChallenges %>
                    <div class="col-md-12 mt48">
                        <h4 class="uppercase">Completed Challenges</h4>
                        <div class="row">
                            <% if $CompletedChallenges %>
                                <% loop $CompletedChallenges %>
                                    <div class="col-md-6">
                                        <div class="feature feature-1 boxed bordered text-center">
                                            <div>
                                                <h5 class="uppercase">$Challenge.Title</h5>
                                            </div>
                                            <a href="" class="btn" title="Checkout individual leaderboard">Individual Leaderboard</a>
                                            <a href="" class="btn" title="Checkout team leaderboard">Team Leaderboard</a>
                                            <p class="uppercase">Challenge Complete</p>
                                        </div>
                                    </div>
                                <% end_loop %>
                            <% end_if %>
                        </div>
                    </div>
                <% end_if %>
            </div>
        </div>
    </div>
</section>