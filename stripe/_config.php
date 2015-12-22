<?php
require_once('thirdparty/stripe/init.php');

\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);