<?php

require_once '/home/sfproject/lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfProtoculousPlugin');
    $this->enablePlugins('sfThumbnailPlugin');
  }
}
