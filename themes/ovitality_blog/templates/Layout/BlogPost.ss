<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="uppercase mb0">$Title</h3>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 mb-xs-24">
                <div class="post-snippet mb64">
                    <img class="mb24" alt="Post Image" src="$FeaturedImage.CroppedImage(900, 600).Link" />
                    <div class="post-title">
                        <span class="label">$PublishDate.Format(d M)</span>
                        <h4 class="inline-block">
                            <% if $MenuTitle %>
                                $MenuTitle
                            <% else %>
                                $Title
                            <% end_if %>                            
                        </h4>
                    </div>

                    <% include EntryMeta %>
                    <hr>
                    $Content
                </div>

                <hr>
                <div class="disqus-comments">
                    <a href="#" class="comments-toggle">Comments</a>

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

            <% if $SideBarView %>
                <div class="col-md-3 hidden-sm">
                    $SideBarView
                </div>
            <% end_if %>
        </div>
        <!--end of container row-->
    </div>
    <!--end of container-->
</section>