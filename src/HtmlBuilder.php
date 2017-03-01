<?php namespace App\Helpers\Html;

use Slakbal\Html\Traits\Alert;
use Slakbal\Html\Traits\Image;
use Slakbal\Html\Traits\Labels;
use Collective\Html\HtmlBuilder as CollectiveHtmlBuilder;

class HtmlBuilder extends CollectiveHtmlBuilder
{

	use Labels, Alert, Image;

}
