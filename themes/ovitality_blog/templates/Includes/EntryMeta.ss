<ul class="post-meta">
    <% if $Credits %>
        <li>
            <i class="ti-user"></i>
            <span>Written by
                <% loop $Credits %>
                    <% if not $First && not $Last %>, <% end_if %>
                    <% if not $First && $Last %> and <% end_if %>
                       $Name.XML
                <% end_loop %>
            </span>                
        </li>
    <% end_if %>

    <% if $Categories.exists %>
        <li>
            <i class="ti-tag"></i>
            <span>Categories 
                <% loop $Categories %>
                    <a href="$Link" title="$Title">$Title</a>
                <% end_loop %>
            </span>
        </li>
    <% end_if %>

    <% if $Tags.exists %>
        <li>
            <i class="ti-tag"></i>
            <span>Tags 
                <% loop $Tags %>
                    <a href="$Link" title="$Title">$Title</a>
                <% end_loop %>
            </span>
        </li>
    <% end_if %>    

</ul>