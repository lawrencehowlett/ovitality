<?php
class TeamAdmin extends ModelAdmin {

    private static $managed_models = array(
        'Team'
    );

    private static $url_segment = 'teams';

    private static $menu_title = 'Team';

    private static $menu_icon = 'mysite/images/group-icon.png';
}
