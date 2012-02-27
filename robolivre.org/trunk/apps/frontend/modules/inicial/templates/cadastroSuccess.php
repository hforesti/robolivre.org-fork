<!--#include virtual="includes/header-home.html" -->

<div class="container">
    <!-- Topo
      ================================================== -->
    <div class="row">
        <a class="brand span3" href="<?php echo url_for('inicial/index') ?>">Robô Livre</a>
    </div>

    <div class="row" id="intro">

        <div class="span8">
            <?php include_partial('formCadastro', array('form' => $form)) ?>
        </div>

    </div><!-- /row -->


    <!--#include virtual="includes/footer.html" -->