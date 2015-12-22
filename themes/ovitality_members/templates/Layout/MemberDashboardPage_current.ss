<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16">My OVitality</h3>
                    <hr>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="testimonials text-slider challenge-today-slider">
                        <ul class="slides">
                            <% loop $ActiveChallenge.DailyChallenges %>
                                <li>
                                    
                                    <div class="image-tile outer-title">
                                        <% if $Image %>
                                            <img src="$Image.PaddedImage(577, 442).Link" alt="$Image.Title" />
                                        <% end_if %>

                                        <div class="title mt16 mb16">
                                            <h5 class="uppercase mb0">$Title</h5>
                                        </div>

                                        $Content
                                        
                                    </div>
                                </li>
                            <% end_loop %>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">
                    <div class="feature feature-1 boxed bordered text-center">
                        <div>
                            <h5 class="uppercase"><a href="$ActiveChallenge.ChallengeDetailsPageLink">$ActiveChallenge.Title</a></h5>
                        </div>
                        <a href="" class="btn" title="Go Log Points">Log Points</a>
                        <a href="" class="btn" title="Checkout individual leaderboard">Individual Leaderboard</a>
                        <a href="" class="btn" title="Checkout team leaderboard">Team Leaderboard</a>

                        <p class="uppercase">$ActiveChallenge.StartLabel $ActiveChallenge.StartDate.Format(jS M Y)</p>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</section>