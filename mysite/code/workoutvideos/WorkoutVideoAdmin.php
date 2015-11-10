<?php
class WorkoutVideoAdmin extends ModelAdmin {

    private static $managed_models = array(
        'WorkoutVideo', 'WorkoutVideoCategory'
    );

    private static $url_segment = 'workout-videos';

    private static $menu_title = 'Workout Videos';

    private static $menu_icon = 'mysite/images/video-icon.png';
}
