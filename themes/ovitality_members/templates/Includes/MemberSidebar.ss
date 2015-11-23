<div class="col-md-3 col-md-pull-9 hidden-sm">

    <div class="widget bg-secondary">
        <div class="image-tile outer-title text-center">
            <% if $CurrentUser.ProfileImage %>
                <img src="$CurrentUser.ProfileImage.Link" alt="$CurrentUser.ProfileImage.Title">
            <% end_if %>
            <div class="title mb16">
                <h5 class="uppercase mb0">$CurrentUser.FullName</h5>
                <span><a href="Security/logout">Sign Out</a></span>
            </div>
        </div>    
    </div>

    <div class="button-tabs vertical">
        <ul>
            <li>
                <div class="tab-title">
                    <span>My Ovitality</span>
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
            <li>
                <div class="tab-title">
                    <span>Challenges</span>
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
    </div>
</div>