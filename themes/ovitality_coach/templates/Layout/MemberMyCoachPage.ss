<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb8">$Title</h3>
                    <hr>
                    $Content
                </div>
                <% if $CurrentUser.ActiveTeam.Coaches %>
                    <% loop $CurrentUser.ActiveTeam.Coaches %>
                        <div class="col-md-12 col-sm-12 mb40 mb-xs-24 p0">
                            <div class="col-sm-7 mb64 mb-xs-24">
                                <img src="$ProfileImage.Link" alt="$ProfileImage.Title">
                            </div>
                            <div class="col-sm-5 mb64 mb-xs-24">
                                <h5 class="uppercase mb8">$FullName</h5>
                                <span class="inline-block mb8 mb-xs-24"><a href="mailto:$Email">$Email</a></span><br>
                                <span class="inline-block mb-xs-24">$Phone</span>
                            </div>
                        </div>
                    <% end_loop %>
                <% end_if %>
                <div class="col-md-12 feature bordered">
                    <h2 class="mb8">Become an Ō Leader</h2>
                    <a class="btn btn-filled btn-lg mb0" href="#">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</section>