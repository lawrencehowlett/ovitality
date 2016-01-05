<?php

global $project;
$project = 'mysite';

global $database;
$database = 'SS_ovitalitystage';

require_once("conf/ConfigureFromEnv.php");

i18n::set_locale('en_GB');

Object::useCustomClass('MemberLoginForm', 'CustomLoginForm');

FulltextSearchable::enable();