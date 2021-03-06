<section>
    <div class="container">
        <div class="row">
            <% include MemberSidebar %>
            <div class="col-md-10 mb-xs-24">
                <div class="col-md-12">
                    <h3 class="uppercase mb0">$Title</h3>
                    <hr>
                </div>
                <div class="col-md-12 mt16">
                    <div class="row">
                        <div class="col-md-12 mb-xs-24">
                            <div class="post-snippet mb64">
                                <% if $VideoURL %>
                                    <div class="embed-video-container embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{$VideoURL}?badge=0&title=0&byline=0&title=0"></iframe>
                                    </div>
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
        </div>
    </div>
</section>