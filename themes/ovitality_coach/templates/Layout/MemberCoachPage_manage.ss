<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>        
            <div class="col-md-10 mb-xs-24">
            	
                <div class="col-md-12">
                    <h3 class="uppercase mb0">Teams I Coach</h3>
                    <hr />
            	</div>

                <div class="col-md-12">
                    <% if $CurrentUser.CoachTeams %>
                        <ul class="accordion accordion-1 one-open">
                            <% loop $CurrentUser.CoachTeams %>
                                <li>

                                    <% if $Title %>
                                        <div class="title">
                                            <span>$Title</span>
                                        </div>
                                    <% end_if %>

                                    <div class="content">

                                        <% if $Description %>
                                            <p>$Description</p>
                                        <% end_if %>

                                        <% if $Leaders %>
                                            <h5 class="uppercase mt8 mb8">Leaders</h5>
                                            <table class="table cart mb48">
                                                <tbody>
                                                    <% loop $Leaders %>
                                                        <tr>
                                                            <td>
                                                                <img src="$ProfileImage.PaddedImage(577, 442, #FFFFFF).Link" class="product-thumb" alt="Product">
                                                            </td>
                                                            <td>
                                                                <span>julius.caamic@yahoo.com</span>
                                                            </td>
                                                            <td>
                                                                <span>+63 999 483 8438</span>
                                                            </td>
                                                        </tr>
                                                    <% end_loop %>
                                                </tbody>
                                            </table>
                                        <% end_if %>

                                        <% if $Members %>
                                            <h5 class="uppercase mt32 mb8">Members</h5>
                                            <table class="table cart mb48">
                                                <tbody>
                                                    <% loop $Members %>
                                                        <tr>
                                                            <td>
                                                                <img src="$ProfileImage.PaddedImage(577, 442, #FFFFFF).Link" class="product-thumb" alt="Product">
                                                            </td>
                                                            <td>
                                                                <span>julius.caamic@yahoo.com</span>
                                                            </td>
                                                            <td>
                                                                <span>+63 999 483 8438</span>
                                                            </td>
                                                        </tr>
                                                    <% end_loop %>
                                                </tbody>
                                            </table>
                                        <% end_if %>
                                    </div>
                                </li>
                            <% end_loop %>
                        </ul>
                    <% end_if %>
                </div>                    
            </div>
        </div>
    </div>
</section>