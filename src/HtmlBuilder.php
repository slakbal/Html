<?php namespace Slakbal\HtmlBs4;

use Slakbal\HtmlBs4\Traits\Alert;
use Slakbal\HtmlBs4\Traits\Image;
use Slakbal\HtmlBs4\Traits\Labels;
use Collective\Html\HtmlBuilder as CollectiveHtmlBuilder;

class HtmlBuilder extends CollectiveHtmlBuilder
{

	use Labels, Alert, Image;

}
