<?php
class ProductAdmin extends ModelAdmin {

    private static $managed_models = array(
        'Product', 'ProductCategory'
    );

    private static $menu_icon = 'mysite/images/shopping-icon.png';

    private static $url_segment = 'products';

    private static $menu_title = 'Products';
}
