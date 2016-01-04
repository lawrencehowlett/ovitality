<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>        
            <div class="col-md-10 mb-xs-24">
            	<div class="col-md-12">
	                <h3 class="uppercase mb0">Team Points</h3>
                    <hr>
            	</div>
                <div class="col-md-7">
                    <canvas id="canvas" height="450" width="600"></canvas>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <h5 class="uppercase">Filter team points by</h5>
                    <form>
                        <div class="select-option">
                            <i class="ti-angle-down"></i>
                            <select>
                                <option value="Default" selected="">Teams</option>
                                <option value="Larger">Large</option>
                            </select>
                        </div>
                        <div class="select-option">
                            <i class="ti-angle-down"></i>
                            <select>
                                <option value="Default" selected="">Challenges</option>
                                <option value="Larger">Large</option>
                            </select>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>