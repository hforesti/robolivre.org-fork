<?php
// auto-generated by sfViewConfigHandler
// date: 2012/05/11 15:21:28
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);

  $response->addStylesheet('/assets/css/bootstrap.min.css', '', array ());
  $response->addStylesheet('/assets/css/main-robolivre.css', '', array ());
  $response->addJavascript('/assets/js/bootstrap.min.js', '', array ());
  $response->addJavascript('/assets/js/jquery.placeholder.min.js', '', array ());
  $response->addJavascript('/assets/js/jquery.imagesloaded.min.js', '', array ());
  $response->addJavascript('/assets/js/jquery.masonry.min.js', '', array ());
  $response->addJavascript('/assets/js/jquery.autoresize.min.js', '', array ());
  $response->addJavascript('/assets/js/CLEditor1_3_0/jquery.cleditor.min.js', '', array ());
  $response->addJavascript('/assets/js/autoSuggestv14/jquery.autoSuggest.minified.js', '', array ());
  $response->addJavascript('/assets/js/file-uploader/fileuploader.js', '', array ());
  $response->addJavascript('/assets/js/main-robolivre.js', '', array ());


