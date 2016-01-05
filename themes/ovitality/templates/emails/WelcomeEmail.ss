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

	<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">We are excited to have you join us to find out more about how to get fit and healthy, the natural way.</p>


	<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">We have created your free 3 day trial account. </p>
<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">Are you ready to start your 80 day challenge? Who do you want on your team? Sign up now and Let’s get fit together!  *A link to pay for the trial.*</p>
<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">You can now log intoyour <a href="{$DashboardPage.Link}">Members Area</a> section of our website. You can also update your contact details using this service.</p>

	<% if $GeneratedPassword %>
		<div>
			Email: $Email<br>
			Password: $GeneratedPassword
		</div>
	<% end_if %>
	<br>

	<p style="margin:0; padding:0; margin:0; margin-bottom:10px;">For a fitter, happier &amp; healthier you!</p>
	<p style="margin:0; padding:0; margin:0; margin-bottom:15px;">The ŌVITALity Team.</p>
</div>