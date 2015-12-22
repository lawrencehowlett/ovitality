<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
            	<div class="col-md-12">
	                <h3 class="uppercase mb16">
                        Join the challenge
                    </h3>
                    <hr>
            	</div>
            	<div class="col-md-7 mt16">
                    <div class="feature bordered">
                        <h4 class="uppercase">
                            Your chosen plan $Reference.MembershipPlan.Title at $Reference.MembershipPlan.Price.Whole
                        </h4>
                    </div>

                    <div class="feature bordered">
                        <h5 class="upperclass">Payment Information</h5>
                        $Form
                    </div>
            	</div>
                <div class="col-md-5 mt16 feature bordered">
                    <h4 class="uppercase">Your plan includes:</h4>
                    $Reference.MembershipPlan.Features
                </div>
            </div>
        </div>
    </div>
</section>