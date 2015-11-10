<?php
class ChallengeAdmin extends ModelAdmin {

    private static $managed_models = array(
        'Challenge'
    );

    private static $url_segment = 'challenges';

    private static $menu_title = 'Challenges';
}
