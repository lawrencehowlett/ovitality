<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 mb-xs-24">
            	<div class="col-md-12">
	                <h3 class="uppercase mb16">
                        <% if $SesJoinChallenge.IndividualOrTeam == 'individual' %>
                            Enter a challenge as individual
                        <% else %>
                            Enter a challenge as a team
                        <% end_if %>
                    </h3>
                    <hr>
            	</div>
            	<div class="col-md-8 mt16">
                    $Form
            	</div>
                <div class="col-md-4 mt16">
                  <div class="feature feature-1 bordered text-center">
                        <h5 class="uppercase">$Challenge.Title</h5>
                        $Challenge.Summary
                    </div>                    
                </div>
            </div>
            <% include MemberSidebar %>
        </div>
    </div>
</section>