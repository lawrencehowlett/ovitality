<% if $MoreThanOnePage %>
<div class="text-center">
    <ul class="pagination">
        <% if $NotFirstPage %>
            <li>
                <a href="{$PrevLink}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <% end_if %>

        <% loop $Pages %>
            <li class="<% if $CurrentBool %>active<% end_if %>">
                <a href="$Link">$PageNum</a>
            </li>
        <% end_loop %>

        <% if $NotLastPage %>
            <li>
                <a href="{$NextLink}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <% end_if %>
    </ul>
</div>
<% end_if %>