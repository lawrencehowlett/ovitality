<?php
class MemberAdmin extends ModelAdmin {

    private static $managed_models = array(
        'MembershipLevel'
    );

    private static $menu_icon = 'mysite/images/members-icon.png';

    private static $url_segment = 'members';

    private static $menu_title = 'Members';
}