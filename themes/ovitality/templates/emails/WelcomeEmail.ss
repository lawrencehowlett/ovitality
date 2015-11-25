<div style="font-family:Arial; font-size:10pt;">
	<table style="width:100%;">
		<tr>
			<tr>
				<td style="text-align:center;">
					<br /><img src="{$Logo.SetWidth(200).Link}" />
				</td>
			</tr>
		</tr>
	</table>

	<br />

	<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">Dear $FirstName,</p>

	<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">Welcome to OVitality</p>

	<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">We have created your free online account and you can access this service 24 hours a day 7 days a week.</p>

	<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">You can now log into your <b>Members Area</b> <a href="{$DashboardPage.Link}">{$DashboardPage.Link}</a> section of our website. You can also update your contact details using this service.</p>

	<% if $GeneratedPassword %>
		<div>
			Email: $Email<br>
			Password: $GeneratedPassword
		</div>
	<% end_if %>
	<br>

	<% if $ContactNumber %>
		<p style="margin:0; padding:0; margin:0; margin-bottom:20px;">
			If you have any problems using the website, please contact us on $ContactNumber. 
		</p>
	<% end_if %>

	<p style="margin:0; padding:0; margin:0; margin-bottom:10px;">For a fitter, happier &amp; healthier you!</p>
	<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">The ŌVITALity Team.</p>
</div>