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
                    <h4 class="uppercase">Week 6 Top Individuals</h4>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Name</th>
                                <th>Team</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>Dixies Chicks</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Hanna Copeland</td>
                                <td>Healthy Home Builders 2.0</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Danyel Turner</td>
                                <td>Takin the Bacon</td>
                            </tr>
                        </tbody>                    
                    </table>
                </div>                
            </div>
        </div>
    </div>
</section>

