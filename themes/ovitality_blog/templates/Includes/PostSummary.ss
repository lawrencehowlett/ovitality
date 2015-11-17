<div class="post-snippet mb64">
    <a href="$Link" title="Read more about $Title">
        <img class="mb24" alt="Post Image" src="$FeaturedImage.CroppedImage(900, 600).Link" />
    </a>
    <div class="post-title">
        <span class="label">$PublishDate.Format('d M')</span>
        <a href="$Link" title="Read more about $Title">
            <h4 class="inline-block">
                <% if $MenuTitle %>
                    $MenuTitle
                <% else %>
                    $Title
                <% end_if %>
            </h4>
        </a>
    </div>
    <% include EntryMeta %>
    <hr>
    <% if $Summary %>
        $Summary
    <% else %>
        $Excerpt
    <% end_if %>
    <a class="btn btn-sm" href="$Link" title="Read more about $Title">Read More</a>
</div>   