<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">Current and upcoming challenges</h3>
                    <hr>
                </div>
                <div class="col-md-12 mt48">
                    <div class="row">
                        <% if $ActiveChallenge %>
                            <div class="col-md-6">
                                <div class="feature feature-2 bordered text-center">
                                    <div>
                                        <h5 class="uppercase">$ActiveChallenge.Title</h5>
                                    </div>
                                    <% if $CurrentUser.canAccess(LEVEL_2) || $CurrentUser.canAccess(LEVEL_3) %>
                                        <a href="" class="btn">Log Points</a>
                                    <% end_if %>

                                    <a href="" class="btn">Individual Leaderboard</a>
                                    <a href="" class="btn">Team Leaderboard</a>
                                    <p class="uppercase">$ActiveChallenge.StartLabel $ActiveChallenge.StartDate.Format(jS M Y)</p>
                                </div>
                            </div>
                        <% end_if %>
                        <% loop $AvailableChallenges %>
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