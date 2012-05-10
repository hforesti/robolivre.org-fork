<?php

require_once '/home/robolivre/GitHub/robolivre.org/lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
require_once '/home/robolivre/GitHub/robolivre.org/lib/robolivre/htmlpurifier-4.4.0/library/HTMLPurifier.auto.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfProtoculousPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfImageTransformPlugin');
  }
}
