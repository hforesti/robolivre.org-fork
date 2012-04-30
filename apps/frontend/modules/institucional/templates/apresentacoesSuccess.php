<div class="row">

<div class="span4">
<h6>Institucional</h6>
    <ul class="nav nav-tabs nav-stacked">
        <li><a href="<?php echo url_for("institucional/sobre") ?>">Sobre a Robô Livre</a></li>
        <li><a href="<?php echo url_for("institucional/instituicoesParceiras") ?>">Instituições parceiras</a></li>
        <li class="active"><a href="<?php echo url_for("institucional/apresentacoes") ?>">Apresentações</a></li>
        <li><a href="<?php echo url_for("institucional/publicacoesCientificas") ?>">Publicações científicas</a></li>
    </ul>
        <a href="<?php echo url_for("perfil/index") ?>" class="btn"><i class="icon-chevron-left icon-gray"></i> Início</a>
</div>


    <div class="span8">

        <div class="page-header">
            <h1>Apresentações</h1>
        </div>

        <p>Aqui você encontra um diretório de downloads onde estarão sempre disponíveis os arquivos de apresentações feitas por nossa equipe. Confira a tabela a seguir:</p>


        <h2>Downloads</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th>Formato</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="label label-info">Novo</span> <a href="#">Mattis Pharetra Sit Amet</a></td>
                    <td>PPT</td>
                </tr>
                <tr>
                    <td><a href="#">Mattis Pharetra Sit Amet</a></td>
                    <td>PPT</td>
                </tr>
                <tr>
                    <td><a href="#">Mattis Pharetra Sit Amet</a></td>
                    <td>PDF</td>
                </tr>
                <tr>
                    <td><a href="#">Mattis Pharetra Sit Amet</a></td>
                    <td>ZIP</td>
                </tr>
            </tbody>
        </table>

        <p>
            Não encontrou uma apresentação nossa? <a href="<?php echo url_for("contato") ?>">Entre em contato conosco</a>.
        </p>

    </div>


</div><!-- /row -->
