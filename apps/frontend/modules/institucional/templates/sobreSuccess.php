<div class="row">

<div class="span4">
<h6>Institucional</h6>
    <ul class="nav nav-tabs nav-stacked">
        <li class="active"><a href="<?php echo url_for("institucional/sobre") ?>">Sobre a Robô Livre</a></li>
        <li><a href="<?php echo url_for("institucional/instituicoesParceiras") ?>">Instituições parceiras</a></li>
        <li><a href="<?php echo url_for("institucional/apresentacoes") ?>">Apresentações</a></li>
        <li><a href="<?php echo url_for("institucional/publicacoesCientificas") ?>">Publicações científicas</a></li>
    </ul>
        <a href="<?php echo url_for("perfil/index") ?>" class="btn"><i class="icon-chevron-left icon-gray"></i> Início</a>
</div>


    <div class="span8">

        <div class="page-header">
            <h1>Sobre a Robô Livre</h1>
        </div>

        <p>A Plataforma Robótica Livre está disponível desde 2005 para ajudar a desmistificar a tecnologia. Mostramos as pessoas que é fácil fazer. :) 
            O nosso principal objetivo é mostrar que a robótica pode e deve ser desenvolvida por qualquer pessoa que tenha interesse, independente de possuir conhecimentos técnicos sobre o tema ou qualquer formação.
        Nosso desenvolvimento é colaborativo. Aqui você encontrará vários projetos de robôs que poderão ser montados, utilizados, copiados ou desenvolvidos por qualquer pessoa. Todos nossos projetos e metodologias são abertos, liberados e garantidos pelas licenças <strong>GNU GPL</strong> e <strong>GNU FDL</strong>.
        </p>

        <h2>Metodologia</h2>
        <p>Desenvolvida em parceria com o programa de Pós-graduação em Educação Matemática e Tecnológica da UFPE (EDUMATEC) e a Univerdade da República do Uruguai (UdelaR), nossa metodologia se baseia em três pontos para estabelecer um diferencial em relação aos demais modelos de aprendizado da Robótica:</p>
        <ol>
            <li>"É fácil fazer". A convicção de que a Robótica pode e deve ser trabalhada por qualquer pessoa, independentemente de sua formação, idade, condição sociocultural e conhecimento prévio.</li>
            <li>Desenvolvimento colaborativo. Todos os artefatos e conteúdos produzidos e disponibilidados são baseados nas licenças GNU (GPL e FDL).</li>
            <li>Abordagem de ensino desenvolvida de forma horizontal. Trocando a hierarquização na relação facilitador-aluno por uma forma democrática e parcitipativa por meio da prática.</li>
        </ol>

        <p>Informações mais detalhadas sobre nossa plataforma você encontra no nosso Release oficial. O download dele pode ser feito a seguir.</p>

        <h2>Downloads</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th>Formato</th>
                </tr>
            </thead>
            <tbody>
                <?php /*TABELA DE ARQUIVOS DA PASTA "/web/arquivosInstitucionais" */ Util::imprimeListaArquivos($arquivos) ?>
            </tbody>
        </table>


        <h2>Equipe</h2>
        <p>
            Quer saber quem faz a Robô Livre?
        </p>

        <ul class="thumbnails">
            <?php /* ?>
            <li class="span2">
                <div class="thumbnail">
                    <a href="perfil.shtml"><img src="/assets/img/rl/avatar-170.jpg" alt="Rodrigo Medeiros"></a>
                    <strong>Rodrigo Medeiros</strong>
                    <p>Nullam id dolor</p>
                </div>
            </li>
            <?php */ ?>
            <li class="span2">
                <div class="thumbnail">
                  <img src="http://placehold.it/170" alt="Foto de Ricardo Mariz">
                    <h6>Ricardo Mariz</h6>
                    <p>Programador &amp; Professor</p>
                    <p><a href="http://facebook.com/ricardomariz">Facebook</a> ∙ <a href="http://twitter.com/ricardomariz">Twitter</a></p>
                </div>
            </li>
            <li class="span2">
                <div class="thumbnail">
                  <img src="http://placehold.it/170" alt="Foto de Fábio Emmanuel">
                    <h6>Fábio Emmanuel</h6>
                    <p>Programador &amp; Professor</p>
                    <p><a href="http://facebook.com/Fabyuu">Facebook</a> ∙ <a href="http://twitter.com/fabyuu">Twitter</a></p>
                </div>
            </li>
            <li class="span2">
                <div class="thumbnail">
                  <img src="http://placehold.it/170" alt="Foto de Rodrigo Muniz">
                    <h6>Rodrigo Muniz</h6>
                    <p>Designer de Interfaces</p>
                    <p><a href="http://facebook.com/rodrigomuniz">Facebook</a> ∙ <a href="http://twitter.com/rdmuniz">Twitter</a> ∙ <a href="http://lattes.cnpq.br/8973576700699514">Lattes</a></p>
                </div>
            </li>
            <li class="span2">
                <div class="thumbnail">
                  <img src="http://placehold.it/170" alt="Foto de Max Guenes">
                    <h6>Max Guenes</h6>
                    <p>Programador Web</p>
                    <p><a href="http://facebook.com/maxguenes">Facebook</a> ∙ <a href="http://twitter.com/fabyuu">Twitter</a></p>
                </div>
            </li>
</ul>


    </div>


</div><!-- /row -->
