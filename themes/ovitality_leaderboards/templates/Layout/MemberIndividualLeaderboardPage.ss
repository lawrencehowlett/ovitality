<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16 pull-left">$Title</h3>
                    <a class="btn pull-right" href="$MyChallengesDetailsPage.Link" title="Go back to challenge dashboard">Back to Challenge Dashboard</a>
                    <div class="clearfix"></div>
                    <hr>
                </div>

                <% if $Challenges %>
                    <form>
                        <div class="col-md-3">
                            <div class="select-option">
                                <i class="ti-angle-down"></i>
                                <select id="mark-remote" name="challenge">
                                    <option value="0">Select a challenge</option>
                                    <% loop $Challenges %>
                                        <option value="$ID" <% if $Top.getSelectedChallenge.ID == $ID %>selected<% end_if %>>$Title</option>
                                    <% end_loop %>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-onset-6">
                            <div class="select-option">
                                <i class="ti-angle-down"></i>
                                <select id="series-remote" name="series">
                                    <% if $SelectedChallengeWeek %>
                                        <% loop $SelectedChallengeWeek %>
                                            <option value="$WeekNumber" <% if $Selected %>selected<% end_if %>>$Title</option>
                                        <% end_loop %>
                                    <% else %>
                                        <option value="Default" selected="">Select a week</option>
                                    <% end_if %>
                                </select>
                            </div>
                        </div>                    
                        <button id="button-remote" type="submit" style="display:none;">Button</button>         
                    </form>
                <% end_if %>

                <div class="col-md-12 mt64">
                    <h4 class="uppercase">Top Individuals</h4>

                    <% if $TopIndividuals %>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Team</th>
                                </tr>
                            </thead>
                            <tbody>
                                <% loop $TopIndividuals %>
                                    <tr>
                                        <td>$Pos</td>
                                        <td>$FullName</td>
                                        <td>$Team</td>
                                    </tr>
                                <% end_loop %>
                            </tbody>                    
                        </table>
                    <% end_if %>
                </div>                
            </div>
        </div>
    </div>
</section>

