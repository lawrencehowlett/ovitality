<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">Remove a team member</h3>
                    <hr>
                </div>
                <div class="col-md-12">
                    <p class="lead">Are you sure you want to remove this team member?</p>

                    <div class="row feature feature-1 boxed">
                        <div class="col-md-4">
                            <img src="$TeamMember.ProfileImage.PaddedImage(350, 350, #000000).Link" alt="$TeamMember.ProfileImage.Title">
                        </div>
                        <div class="col-md-8">
                            <h6 class="uppercase mb0">$TeamMember.FullName</h6>
                            <p class="mb0"><a href="mailto:$TeamMember.Email">$TeamMember.Email</a></p>
                            <p>$TeamMember.Phone</p>
                        </div>
                    </div>                    

                    $DeleteConfirmationForm
                </div>
            </div>
        </div>
    </div>
</section>