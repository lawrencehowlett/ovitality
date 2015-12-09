<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 mb-xs-24">
            	<div class="col-md-12">
	                <h3 class="uppercase mb16">
                        Join the challenge
                    </h3>
                    <hr>
            	</div>
            	<div class="col-md-7 mt16">
                    <div class="feature bordered">
                        <h5 class="uppercase">
                            Your chosen plan $Reference.MembershipPlan.Title at $Reference.MembershipPlan.Price.Nice
                        </h5>
                    </div>

                    <div class="feature bordered">
                        $Form
                    </div>
            	</div>
                <div class="col-md-5 mt16 feature bordered">
                    <h5 class="uppercase">Your plan includes:</h5>
                    $Reference.MembershipPlan.Features
                </div>
            </div>
            <% include MemberSidebar %>
        </div>
    </div>
</section>