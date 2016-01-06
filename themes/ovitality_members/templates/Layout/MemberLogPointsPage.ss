<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16 pull-left">Log Points</h3>
                    <a class="btn pull-right" href="$MyChallengesDetailsPage.Link" title="Go back to challenge dashboard">Back to Challenge Dashboard</a>
                    <div class="clearfix"></div>
                    <hr>
                </div>
                <div class="col-md-8">
                    <div class="row mt32 mb64">
                        <div class="col-md-12">
                            <h5 class="uppercase">Daily Progress</h5>
                        </div>
                        <div class="col-md-6 text-center">
                            <input class="knob" data-min="0" data-max="$MyPerfectTotalPoints" data-fgColor="#0093D0" data-fgColor="chartreuse" data-thickness=".4" readonly value="$MyTotalPoints">
                            <p class="lead mt8">My Points</p>
                        </div>

                        <% if $CurrentUser.ActiveChallengeReference.Team %>
                            <div class="col-md-6 text-center">
                                <input class="knob" data-min="0" data-max="$TeamPerfectTotalPoints" data-fgColor="#0093D0" data-fgColor="chartreuse" data-thickness=".4" readonly value="$TeamTotalPoints">
                                <p class="lead mt8">Team Points</p>
                            </div>
                        <% end_if %>

                    </div>
                    <div class="row mb64">
                        <div class="col-md-11 col-md-onset-1">
                            <h5 class="uppercase">My Points (Last 7 Days)</h5>
                            <canvas id="canvas" height="450" width="600"></canvas>
                        </div>
                    </div>
                    <div class="row mb64">
                        <div class="col-md-12">
                            <h5 class="uppercase">Total Points (Last 7 Days)</h5>
                        </div>
                        <div class="col-md-6 text-center">
                            <h1 class="uppercase">$SevenDaysIndividualTotalPoints</h1>
                            <p class="lead">My Points</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <h1 class="uppercase">$SevenDaysTeamTotalPoints</h1>
                            <p class="lead">Team Points</p>
                        </div>
                    </div>
                    <div class="row mb64">
                        <div class="col-md-12">
                            <h5 class="uppercase">Cumulative Contest Points</h5>
                        </div>
                        <div class="col-md-6 text-center">
                            <h1 class="uppercase">2654</h1>
                            <p class="lead">My Points</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <h1 class="uppercase">8845</h1>
                            <p class="lead">Team Points</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 feature bordered">
                    <div class="testimonials text-slider slider-arrow-controls">
                        <div class="row mb16">
                            <div class="col-md-2 text-left">
                                <% if $PreviousDailyChallenge %>
                                    <a href="{$Link}DailyChallenge/$PreviousDailyChallenge.ID" title="Go to previous date">
                                        <i class="ti-arrow-left"></i>
                                    </a>
                                <% end_if %>
                            </div>

                            <div class="col-md-8 text-center">
                                <h3 class="mb36 uppercase">$DailyChallenge.Title</h3>
                            </div>

                            <% if $NextDailyChallenge %>
                                <div class="col-md-2 text-right">
                                    <a href="{$Link}DailyChallenge/$NextDailyChallenge.ID" title="Go to next date">
                                        <i class="ti-arrow-right"></i>
                                    </a>
                                </div>
                            <% end_if %>
                        </div>
                        <% if $DailyChallenge %>
                            $PointsForm
                        <% else %>
                            <div class="col-md-12">
                                <div role="alert" class="alert alert-info uppercase">
                                    No activities available
                                </div>
                            </div>
                        <% end_if %>
                    </div>              
                </div>
            </div>
        </div>
    </div>
</section>