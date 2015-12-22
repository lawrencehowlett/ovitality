<div class="col-md-2 hidden-sm feature boxed bordered">

    <div class="row">
        <div class="col-md-12">
            <div class="image-tile outer-title">
                <% if $CurrentUser.ProfileImage %>
                    <img src="$CurrentUser.ProfileImage.Link" alt="$CurrentUser.ProfileImage.Title">
                <% end_if %>

                <div class="title mb16">
                    <h6 class="uppercase mb0">$CurrentUser.FullName</h6>
                    <span><a href="Security/logout"><i class="ti-na"></i> Sign Out</a></span>
                </div>
            </div>
        </div>        
    </div>

    <!--<div class="button-tabs vertical">
        <ul>
            <li class="<% if $ID == $MyDashboardPage.ID %>active<% end_if %>">
                <div class="tab-title">
                    <span>
                        <% if $ID == $MyDashboardPage.ID %>
                            My OVitality
                        <% else %>
                            <a href="$MyDashboardPage.Link" title="Go to my OVitality page">My OVitality</a>
                        <% end_if %>
                    </span>
                </div>
            </li>
            <li class="<% if $ID == $MyProfilePage.ID %>active<% end_if %>">
                <div class="tab-title">
                    <span>
                        <% if $ID == $MyProfilePage.ID %>
                            $MyProfilePage.Title
                        <% else %>
                            <a href="$MyProfilePage.Link" title="Go to my profile page">$MyProfilePage.Title</a>
                        <% end_if %>
                    </span>
                </div>
            </li>

            <li class="<% if $ID == $MyChallengesListPage.ID %>active<% end_if %>">
                <div class="tab-title">
                    <span>
                        <% if $ID == $MyChallengesListPage.ID %>
                            $MyChallengesListPage.Title
                        <% else %>
                            <a href="$MyChallengesListPage.Link" title="Go to my profile page">$MyChallengesListPage.Title</a>
                        <% end_if %>
                    </span>
                </div>
            </li>

            <li class="<% if $ID == $MyRecipesPage.ID %>active<% end_if %>">
                <div class="tab-title">
                    <span>
                        <% if $ID == $MyRecipesPage.ID %>
                            $MyRecipesPage.Title
                        <% else %>
                            <a href="$MyRecipesPage.Link" title="Go to my recipes page">$MyRecipesPage.Title</a>
                        <% end_if %>
                    </span>
                </div>
            </li>
            <li class="<% if $ID == $MyWorkoutVideosPage.ID %>active<% end_if %>">
                <div class="tab-title">
                    <span>
                        <% if $ID == $MyWorkoutVideosPage.ID %>
                            $MyWorkoutVideosPage.Title
                        <% else %>
                            <a href="$MyWorkoutVideosPage.Link" title="Go to my workout videos page">$MyWorkoutVideosPage.Title</a>
                        <% end_if %>
                    </span>
                </div>
            </li>
            <li>
                <div class="tab-title">
                    <span>My Coach</span>
                </div>
            </li>
        </ul>
    </div>-->

    <div class="widget">
        <ul class="link-list">
            <li>
                <a href="$MyDashboardPage.Link" title="Go to my OVitality page">
                    <i class="ti-dashboard"></i> My OVitality
                </a>
            </li>
            <li>
                <a href="$MyProfilePage.Link" title="Go to my profile page">
                    <i class="ti-id-badge"></i> $MyProfilePage.Title
                </a>
            </li>
            <li>
                <a href="$MyChallengesListPage.Link" title="Go to my profile page">
                    <i class="ti-timer"></i> $MyChallengesListPage.Title
                </a>
            </li>
            <li>
                <a href="$MyRecipesPage.Link" title="Go to my recipes page">
                    <i class="ti-pin-alt"></i> $MyRecipesPage.Title
                </a>
            </li>
            <li>
                <a href="$MyWorkoutVideosPage.Link" title="Go to my workout videos page">
                    <i class="ti-basketball"></i> $MyWorkoutVideosPage.Title
                </a>
            </li>
            <li>
                <a href="" title="Go to my coach">
                    <i class="ti-user"></i> My Coach
                </a>
            </li>
        </ul>
    </div>    
</div>