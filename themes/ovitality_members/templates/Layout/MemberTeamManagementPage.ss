<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">My Team > $Team.Title</h3>
                    <hr>
                </div>
                $TeamForm

                <div class="col-md-12 mt64">
                    <h4 class="uppercase">My Team Members</h4>
                    <a href="" class="btn">Invite Team Members (2 spaces left)</a>
                </div>

                <% if $Team.TeamMembers %>
                    <% loop $Team.TeamMembers %>
                        <div class="col-md-4 col-sm-6">
                            <div class="image-tile outer-title text-center">
                                <img src="$ProfileImage.PaddedImage(350, 350, #000000).Link" alt="$ProfileImage.Title">
                                <div class="title mb16">
                                    <h5 class="uppercase mb0">$FullName</h5>
                                    <a href="mailto:$Email"><span>$Email</span></a> <br>
                                    $Phone
                                </div>
                                <div>
                                    <a href="#" class="btn btn-sm" title="notify as team leader">
                                        Notify as team leader
                                    </a>

                                    <a href="#" class="btn btn-sm alert-danger" title="remove team member">
                                        Remove from team
                                    </a>
                                </div>
                            </div>
                        </div>
                    <% end_loop %>
                <% end_if %>
            </div>
            <% include MemberSidebar %>
        </div>
    </div>
</section>