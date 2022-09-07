<?php

namespace App\Constants;

final class Size
{

    // The ideal blog post title length is 60 characters but
    // we'll be generous up 100 characters
    const POST_TITLE = 100;
    // Assuming post description limit from the Instagram caption limit
    // is 2,200 characters.
    const POST_DESCRIPTION = 2200;
    const WEBSITE_TITLE = 100;
    // Microsoft Internet Explorer has a maximum uniform resource
    // locator (URL) length of 2,083 characters.
    const WEBSITE_URL = 2083;

}
