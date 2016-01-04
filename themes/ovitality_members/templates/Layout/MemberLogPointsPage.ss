<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb16 pull-left">Log Points</h3>
                    <a class="btn pull-right" href="$MyChallengesDetailsPage.Link" title="Go back to challenge dashboard">Back to Challenge Dashboard</a>
                    <div class="clearfix"></div>
                    <hr>
                </div>
                <div class="col-md-8">
                    <div class="row mt32 mb64">
                        <div class="col-md-12">
                            <h5 class="uppercase">Daily Progress</h5>
                        </div>
                        <div class="col-md-6 text-center">
                            <input class="knob" data-min="0" data-max="3000" data-fgColor="#0093D0" data-fgColor="chartreuse" data-thickness=".4" readonly value="1000">
                            <p class="lead mt8">My Points</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <input class="knob" data-min="0" data-max="3000" data-fgColor="#0093D0" data-fgColor="chartreuse" data-thickness=".4" readonly value="1000">
                            <p class="lead mt8">Team Points</p>
                        </div>
                    </div>
                    <div class="row mb64">
                        <div class="col-md-11 col-md-onset-1">
                            <h5 class="uppercase">My Points (Last 7 Days)</h5>
                            <canvas id="canvas" height="450" width="600"></canvas>
                        </div>
                    </div>
                    <div class="row mb64">
                        <div class="col-md-12">
                            <h5 class="uppercase">Total Points (Last 7 Days)</h5>
                        </div>
                        <div class="col-md-6 text-center">
                            <h1 class="uppercase">0</h1>
                            <p class="lead">My Points</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <h1 class="uppercase">100</h1>
                            <p class="lead">Team Points</p>
                        </div>
                    </div>
                    <div class="row mb64">
                        <div class="col-md-12">
                            <h5 class="uppercase">Cumulative Contest Points</h5>
                        </div>
                        <div class="col-md-6 text-center">
                            <h1 class="uppercase">2654</h1>
                            <p class="lead">My Points</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <h1 class="uppercase">8845</h1>
                            <p class="lead">Team Points</p>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 feature bordered">
                    <div class="testimonials text-slider slider-arrow-controls">
                        <div class="row mb16">
                            <div class="col-md-2 text-left">
                                <a href="" title="Go to previous date"><i class="ti-arrow-left"></i></a>
                            </div>

                            <div class="col-md-8 text-center">
                                <h3 class="mb36 uppercase">Feb 31</h3>
                            </div>

                            <div class="col-md-2 text-right">
                                <a href="" title="Go to next date"><i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="row mb16">
                            <div class="col-md-12">
                                <p class="lead mb8">What is Lorem Ipsum</p>
                                <div class="quote-author">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="radio-option checked">
                                                <div class="inner"></div>
                                                <input type="radio" value="radio1" name="radio">
                                            </div>
                                            <span>Yes</span>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="radio-option">
                                                <div class="inner"></div>
                                                <input type="radio" value="radio1" name="radio">
                                            </div>
                                            <span>No</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb16">
                            <div class="col-md-12">
                                <p class="lead mb8">Why do we use it</p>
                                <input type="text" placeholder="Enter a number">
                            </div>
                        </div>
                        <div class="row mb16">
                            <div class="col-md-12">                                  
                                <p class="lead mb8">Where can I get some</p>
                                <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</section>