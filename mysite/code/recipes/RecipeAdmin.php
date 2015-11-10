<?php
class RecipeAdmin extends ModelAdmin {

    private static $managed_models = array(
        'Recipe', 'RecipeCategory'
    );

    private static $url_segment = 'recipes';

    private static $menu_title = 'Recipes';

    private static $menu_icon = 'mysite/images/recipes-icon.png';
}
