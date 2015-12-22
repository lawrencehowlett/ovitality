<form $AttributesHTML>

	<p class="payment-errors alert" role="alert" style="display: none;"></p>

	<div class="input-with-label text-left">
	    <span>Card Number:</span>
	    $Fields.dataFieldByName(CardNumber)
	</div>	

	<div class="input-with-label text-left">
	    <span>CVC:</span>
	    $Fields.dataFieldByName(CVC)
	</div>

	<div class="input-with-label text-left">
	    <span>Expiration (MM/YYYY)</span>
	    <div class="row">
	    	<div class="col-md-6">
	    		$Fields.dataFieldByName(ExpirationMonth)
	    	</div>
	    	<div class="col-md-6">
	    		$Fields.dataFieldByName(ExpirationYear)
	    	</div>
	    </div>
	</div>			

	<span>I agree to the <a href="" title="Go to our terms and conditions">terms and conditions</a></span>
	<div class="checkbox-option pull-right">
	    <div class="inner"></div>
	    $Fields.dataFieldByName(TermsConditions)
	</div>	

	$Fields.dataFieldByName(SecurityID)
	<% loop $Actions %>$Field<% end_loop %>
</form>