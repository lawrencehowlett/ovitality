<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 mb-xs-24">
            	<div class="col-md-12">
	                <h3 class="uppercase mb16">Select a membership plan</h3>
                    <hr>
            	</div>
                <% if $Challenge.MembershipPlans %>
                    <% loop $Challenge.MembershipPlans %>
                        <div class="col-md-6 col-sm-6 mt16">
                            <div class="pricing-table pt-1 text-center boxed">
                                <h5 class="uppercase">$Title</h5>
                                <span class="price">$Price.Whole</span>
                                <a class="btn btn-filled btn-lg" href="$SelectMembershipPlanLink">Select Plan</a>
                                $Features
                            </div>
                        </div>
                    <% end_loop %>
                <% else %>
                    <div class="col-md-12">
                        <div role="alert" class="alert alert-warning">
                            No membership plans is available for this challenge.
                        </div>
                    </div>
                <% end_if %>
            </div>
            <% include MemberSidebar %>
        </div>
    </div>
</section>