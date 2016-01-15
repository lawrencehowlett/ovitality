<form $AttributesHTML>

    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="input-with-label">
                <span>$Fields.dataFieldByName(FirstName).Title</span>
                $Fields.dataFieldByName(FirstName)
            </div>
            <div class="input-with-label">
                <span>$Fields.dataFieldByName(Surname).Title</span>
                $Fields.dataFieldByName(Surname)
            </div>
            <div class="input-with-label">
                <span>$Fields.dataFieldByName(Email).Title</span>
                $Fields.dataFieldByName(Email)
            </div>
            <div class="input-with-label">
                <span>$Fields.dataFieldByName(EmailConfirm).Title</span>
                $Fields.dataFieldByName(EmailConfirm)
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="input-with-label">
                <span>$Fields.dataFieldByName(Password).Title</span>
                $Fields.dataFieldByName(Password)
            </div>
            <div class="input-with-label">
                <span>$Fields.dataFieldByName(Phone).Title</span>
                $Fields.dataFieldByName(Phone)
            </div>
            <div class="input-with-label">
                <span>$Fields.dataFieldByName(ReasonForJoining).Title</span>
                $Fields.dataFieldByName(ReasonForJoining)
            </div>
        </div>
        <div class="col-md-12 col-sm-12">
            $Fields.dataFieldByName(SecurityID)
            <% loop $Actions %>$Field<% end_loop %>
        </div>
    </div>

</form>