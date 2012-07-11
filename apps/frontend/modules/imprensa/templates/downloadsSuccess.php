<div class="row">

<div class="span4">
<h6>Imprensa</h6> 
    <ul class="nav nav-tabs nav-stacked">
        <li><a href="<?php echo url_for("imprensa/index") ?>">Robô Livre na mídia</a></li>
        <li class="active"><a href="<?php echo url_for("imprensa/Downloads") ?>">Downloads</a></li>
    </ul>

    <hr>

<div class="well" id="press-info">
<h4><i class="icon-envelope icon-gray"></i> imprensa [at] robolivre.org</h4>
</div>

    <a href="http://blog.robolivre.org/" class="btn btn-primary" rel="external">Blog Oficial <i class="icon-chevron-right icon-white"></i></a>


    <hr>
    <a href="profile-home.shtml" class="btn"><i class="icon-chevron-left icon-gray"></i> Início</a>


</div>


    <div class="span8">

        <div class="page-header">
            <h1>Downloads</h1>
        </div>

        <p>Aqui você jornalista encontra um diretório de downloads onde estarão sempre disponíveis os materiais como fotos oficiais da equipe em alta resolução, logotipo em vetor e releases. Confira a tabela a seguir:</p>

        <h2>Downloads</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th>Formato</th>
                    <th>Tamanho</th>
                </tr>
            </thead>
            <tbody>
                <?php Util::imprimeListaArquivos("arquivosImprensa") ?>
            </tbody>
        </table>


    </div>


</div><!-- /row -->
