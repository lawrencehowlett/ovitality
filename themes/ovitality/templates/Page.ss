<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->
<head>
	<% base_tag %>
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	$MetaTags(false)
</head>
<body>
<% include Header %>
	<div class="main-container">
		<% if not $IsAdminLoginPage %>
			$Layout		
		<% else %>
            <section class="cover fullscreen image-bg overlay">
                <div class="background-image-holder">
                    <img alt="image" class="background-image" src="$ThemeDir/img/home12.jpg" />
                </div>
                <div class="container v-align-transform">
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2">
                            <div class="feature bordered text-center">
                                <h4 class="uppercase">$Title</h4>
                                $Form
                            </div>
                        </div>
                    </div>
                    <!--end of row-->
                </div>
                <!--end of container-->
            </section>			
		<% end_if %>
	</div>
<% include Footer %>
</body>
</html>
