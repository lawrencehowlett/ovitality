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

            <% if $CurrentUser.canAccess(LEVEL_2) || $CurrentUser.canAccess(LEVEL_3) %>
                <li>
                    <a href="$MyRecipesPage.Link" title="Go to my recipes page">
                        <i class="ti-pin-alt"></i> $MyRecipesPage.Title
                    </a>
                </li>
            <% end_if %>
            
            <% if $CurrentUser.canAccess(LEVEL_3) %>
                <li>
                    <a href="$MyWorkoutVideosPage.Link" title="Go to my workout videos page">
                        <i class="ti-basketball"></i> $MyWorkoutVideosPage.Title
                    </a>
                </li>
            <% end_if %>

            <% if not $CurrentUser.IsCoach && $CurrentUser.HasActiveChallenge && $CurrentUser.ActiveChallengeReference.IsTeam %>
                <li>
                    <a href="$getMemberPageInstance(MemberMyCoachPage).Link" title="Go to my coach">
                        <i class="ti-user"></i> My Coach
                    </a>
                </li>
            <% end_if %>

            <% if $CurrentUser.IsCoach || $CurrentUser.IsTeamLeader %>
                <li>
                    <a href="{$getMemberPageInstance(MemberCoachPage).Link}ManageTeams" title="Go to my team coach page">
                        <i class="ti-user"></i> Teams | Coach 
                        <ul class="bullets" style="margin-left:15px;">
                            <li><a href="{$getMemberPageInstance(MemberCoachPage).Link}ManageTeams">Manage Teams</a></li>
                            <li><a href="">Team Points</a></li>
                        </ul>
                    </a>
                </li>
            <% end_if %>

        </ul>
    </div>    
</div>