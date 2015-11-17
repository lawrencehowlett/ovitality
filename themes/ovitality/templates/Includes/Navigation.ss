<ul class="menu">
    <% loop $Menu(1) %>
         <li class="<% if $Children %>has-dropdown<% end_if %>">
            <a href="$Link" title="$Title.XML">$MenuTitle.XML</a>   
            <% if $Children %>
                <ul>
                    <% loop $Children %>
                        <li class="<% if $Children %>has-dropdown<% end_if %>">
                            <a href="$Link" title="$Title.XML">$MenuTitle.XML</a>   
                                <% if $Children %>
                                    <ul>
                                        <% loop $Children %>
                                            <li>
                                                <a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                                            </li>
                                        <% end_loop %>
                                    </ul>
                                <% end_if %>
                        </li>    
                    <% end_loop %>
                </ul>            
            <% end_if %>
         </li>
    <% end_loop %>
</ul>