<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="uppercase mb0">Select a membership plan</h3>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <% if $Challenge.MembershipPlans %>
            <div class="row">
                <% loop $Challenge.MembershipPlans %>
                    <div class="col-md-4 col-sm-6">
                        <div class="pricing-table pt-2 boxed text-center">
                            <h5 class="uppercase">$Title</h5>
                            <span class="price">$Price.Whole</span>

                            <a href="{$Top.Link}SelectMembershipPlan/$ID" class="btn btn-filled btn-lg">Select Plan</a>

                            $Features
                        </div>
                    </div>
                <% end_loop %>
            </div>
        <% end_if %>
    </div>
</section>