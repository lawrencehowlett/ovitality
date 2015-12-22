<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
            	<div class="col-md-12">
	                <h3 class="uppercase mb0">
						$Title
					</h3>
            	</div>
            	<div class="col-md-12 mt16 feature bordered bg-secondary">
            		$ProfileForm
            	</div>
            	<div class="col-md-5 mt16 feature bordered bg-secondary">
            		<h4 class="uppercase mb16">Change Password</h4>
            		$ProfilePasswordForm
            	</div>
            	<div class="col-md-6 col-md-offset-1 mt16 feature bordered bg-secondary">
            		<h4 class="uppercase mb16">Email Notification</h4>
            		$ProfileNotificationForm
            	</div>
            </div>
        </div>
    </div>
</section>