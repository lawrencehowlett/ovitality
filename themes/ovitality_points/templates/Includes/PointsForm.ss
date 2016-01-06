<% if $IncludeFormTag %>
<form $AttributesHTML>
<% end_if %>

	<% if $Message %>
	    <div class="foundry_modal text-center">
	        <h4><i class="ti-info-alt icon icon-sm color-primary"></i> $Message</h4>
	    </div>
    <% end_if %>

    <% loop $Controller.DailyChallenge.DailyActivities %>
        <div class="row mb16">
            <div class="col-md-12">
                <p class="lead mb8">$Title</p>
                <div class="quote-author">
                    <div class="row">
                    	<% if $Type == 'Boolean' %>
	                        <div class="col-md-3">
	                            <div class="radio-option <% if $Top.Controller.getDailyActivityRawPoints($ID) %>checked<% end_if %>">
	                                <div class="inner"></div>
	                                <input type="radio" value="1" name="DailyActivity_$ID">
	                            </div>
	                            <span>Yes</span>
	                        </div>
	                        <div class="col-md-9">
	                            <div class="radio-option <% if not $Top.Controller.getDailyActivityRawPoints($ID) %>checked<% end_if %>">
	                                <div class="inner"></div>
	                                <input type="radio" value="0" name="DailyActivity_$ID">
	                            </div>
	                            <span>No</span>
	                        </div>
                        <% end_if %>

                        <% if $Type == 'Slider' %>
                            <div class="col-md-12">                                  
	                            <div class="select-option">
	                                <i class="ti-angle-down"></i>
	                                <select name="DailyActivity_$ID">
	                                    <option selected value="<% if $Top.Controller.getDailyActivityRawPoints($ID) %>$Top.Controller.getDailyActivityRawPoints($ID)<% else %>0<% end_if %>">
	                                    	<% if $Top.Controller.getDailyActivityRawPoints($ID) %>
	                                    		$Top.Controller.getDailyActivityRawPoints($ID)
	                                    	<% else %>
	                                    		select one
	                                    	<% end_if %>
	                                    </option>
	                                    <% loop $Points %>
	                                    	<option value="$Title">$Title</option>
	                                    <% end_loop %>
	                                </select>
	                            </div>                                
                            </div>
                        <% end_if %>

                        <% if $Type == 'Number' %>
                                <div class="col-md-12">
                                    <input name="DailyActivity_$ID" type="text" placeholder="Enter a number" value="$Top.Controller.getDailyActivityRawPoints($ID)">
                                </div>
                        <% end_if %>
                    </div>
                </div>
            </div>
        </div>
    <% end_loop %>

	$Fields.dataFieldByName(SecurityID)

	<div class="row mt16">
		<div class="col-md-12">
			<% if $Actions %>
				<% loop $Actions %>
					$Field
				<% end_loop %>
			<% end_if %>
		</div>
	</div>

<% if $IncludeFormTag %>
</form>
<% end_if %>
