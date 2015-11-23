<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb0">$Title</h3>
                    <hr>
                </div>
                <div class="col-md-6 mt16">
                    <div class="image-slider slider-thumb-controls controls-inside">
                        <ul class="slides">
                            <% loop $GalleryImages %>
                                <li>
                                    <img alt="Image" src="$Image.CroppedImage(1440, 960).Link" />
                                </li>
                            <% end_loop %>
                        </ul>
                    </div>                    
                </div>
                <div class="col-md-6 mt16">
                    <div class="row">
                        <div class="col-md-12 mb-xs-24">
                            <div class="post-snippet mb64">
                                <% if $RecipeCategories %>
                                    <ul class="post-meta">
                                        <li>
                                            <i class="ti-view-list"></i>
                                            <span>Categories
                                                <% loop $RecipeCategories %>
                                                    <a href="$AbsoluteLink">$Title</a>
                                                <% end_loop %>
                                            </span>
                                        </li>
                                    </ul>
                                <% end_if %>
                                $Content
                            </div>                         
                        </div>                
                    </div>                   
                </div>
                <div class="col-md-12">
                    <div class="disqus-comments">
                        <div id="disqus_thread"></div>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES * * */
                            var disqus_shortname = '$SiteConfig.DisqusShortName';
                            
                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                    </div>                  
                </div>
            </div>
            <% include MemberSidebar %>
        </div>
    </div>
</section>