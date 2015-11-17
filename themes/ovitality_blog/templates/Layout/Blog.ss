<section class="page-title page-title-4 bg-secondary">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="uppercase mb0">
                    <% if $ArchiveYear %>
                        <%t Blog.Archive "Archive" %>:
                        <% if $ArchiveDay %>
                            $ArchiveDate.Nice
                        <% else_if $ArchiveMonth %>
                            $ArchiveDate.format("F, Y")
                        <% else %>
                            $ArchiveDate.format("Y")
                        <% end_if %>
                    <% else_if $CurrentTag %>
                        <%t Blog.Tag "Tag" %>: $CurrentTag.Title
                    <% else_if $CurrentCategory %>
                        <%t Blog.Category "Category" %>: $CurrentCategory.Title
                    <% else %>
                        $Title
                    <% end_if %>
                </h3>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-9 mb-xs-24">
                <% if $PaginatedList.Exists %>
                    <% loop $PaginatedList %>
                        <% include PostSummary %>                 
                    <% end_loop %>
                <% end_if %>

                <% with $PaginatedList %>
                    <% include Pagination %>
                <% end_with %>
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