<?php
//$form = new UsuariosForm();
$erros = $form->getErrorSchema()->getErrors();
$valoresInciais = $form->getTaintedValues();
//Util::pre($valoresInciais);

?>

<form id="cadastro-form" class="form-horizontal" onsubmit="return validaConfirmacaoSenhaEmail()" action="<?php echo url_for('inicial/create'); ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
        
    <h1>Criar uma conta <small>último passo</small></h1>
    <fieldset>
        
        <?php
        $class = "success";
        $descricao = "Bonito nome!";
        if (isset($erros['nome'])) {
            if($erros['nome']=="Required."){
                $class = "error";
                $descricao = "Campo obrigatório!";
            }else{
                $class = "warning";
                $descricao = $erros['nome'];
            }
        }
        ?>
        <div id="div-nome" class="control-group <?php echo $class ?>">
            <label class="control-label" for="nome">Nome e Sobrenome</label>
            <div class="controls">
                <?php echo $form->getWidget('nome')->render($form->getName() . "[nome]", null, array('id' => 'nome', 'placeholder' => "Nome e Sobrenome", 'class' => 'span5', 'value' => $valoresInciais['nome'],'onBlur'=>'validaCampoNome(this)')); ?>
                <span id="help-nome" class="help-inline"><?php echo ($descricao != "")?$descricao:"" ?></span>
            </div>
        </div>


        <?php
        $class = "success";
        $descricao = "";
        if (isset($erros['login'])) {
            if($erros['login']=="Required."){
                $class = "error";
                $descricao = "Campo obrigatório!";
            }else{
                $class = "warning";
                $descricao = $erros['login'];
            }
        }
        ?>
        <div id="div-login" class="control-group <?php echo $class ?>">
            <label class="control-label" for="username">Nome de usuário</label>
            <div class="controls">
                <?php echo $form->getWidget('login')->render($form->getName() . "[login]", null, array('id' => 'username', 'placeholder' => "Nome de usuário", 'value' => $valoresInciais['login'],'onBlur'=>'validaForm()')); ?>
                <span id="help-login" class="help-inline"><?php echo ($descricao != "")?$descricao:"" ?></span>
            </div>
        </div>
        
        
        <?php
        $class = "success";
        $descricao = "";
        if (isset($erros['email'])) {
            if($erros['email']=="Required."){
                $class = "error";
                $descricao = "Campo obrigatório!";
            }else{
            $class = "warning";
            $descricao = $erros['email'];
            }
        }
        ?>
        <div id="div-email" class="control-group <?php echo $class ?>">
            <label class="control-label" for="email">Seu e-mail</label>
            <div class="controls">
                <?php echo $form->getWidget('email')->render($form->getName() . "[email]", null, array('id' => 'email', 'placeholder' => "E-mail", 'value' => $valoresInciais['email'],'onBlur'=>'validaForm()')); ?>
                <span id="help-email" class="help-inline"><?php echo ($descricao != "")?$descricao:"" ?></span>
            </div>
        </div>
        <?php
        $class = "";
        $descricao = "";
        if (isset($valoresInciais['email'])) {
            $class = "error";
            $descricao = "Repita o mesmo email acima!";
        }
        ?>
        <div id="div-confirmacao-email" class="control-group <?php echo $class ?>">
            <label class="control-label" for="email-conf">Confirmar seu e-mail</label>
            <div class="controls">
                <input id="email-conf" type="email" onkeyup="validaConfirmacaoSenhaEmail()" placeholder="Repetir e-mail" value="" />
                <span id="help-confirmacao-email" class="help-inline"><?php echo $descricao ?></span>
            </div>
        </div>
        
        
        <?php
        $class = "success";
        $descricao = "";
        if (isset($erros['senha'])) {
            if($erros['senha']=="Required."){
                $class = "error";
                $descricao = "Campo obrigatório!";
            }else{
                $class = "warning";
                $descricao = $erros['senha'];
            }
        }
        ?>
        <div id="div-senha" class="control-group <?php echo $class ?>">
            <label class="control-label" for="pass">Senha</label>
            <div class="controls">
                <?php echo $form->getWidget('senha')->render($form->getName() . "[senha]", null, array('id' => 'pass', 'placeholder' => "Senha", "value" => (array_key_exists('senha',$valoresInciais))?$valoresInciais['senha']:'','onKeyUp'=>'atualizaForcaSenha(this)')); ?>
                <span id="help-forca-senha" class="help-inline"><?php echo ($descricao != "")?$descricao:"" ?></span>
            </div>
        </div>
        
        <div id="div-confirmacao-senha" class="control-group">
            <label class="control-label" for="pass-conf">Confirme a senha</label>
            <div class="controls">
                <input id="pass-conf" type="password" onkeyup="validaConfirmacaoSenhaEmail()" placeholder="Repetir senha" />
                <span id="help-confirmacao-senha" class="help-inline"></span>
            </div>
        </div>
        
        <?php echo $form->renderHiddenFields() ?>
        
        <div class="control-group">
            <label class="control-label" for="optionsCheckbox">Lembrar dados</label>
            <div class="controls">
                <label class="checkbox">
                    <input type="checkbox" id="optionsCheckbox" value="option1">
                    Não estou em um computador público e quero me manter conectado
                </label>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <textarea class="span5" id="terms-textarea" rows="5" readonly="readonly">
Ao clicar no botão, você concordará com os termos abaixo:
---------------------------------------------------------------------
Estes Termos de Uso aplicam-se ao uso do site e dos serviços oferecidos pela rede social Robolivre.org, que é gerenciado pela empresa Mix Tecnologia. Este site e seus serviços têm por objetivo criar uma comunidade virtual colaborativa para trocar conhecimentos sobre robótica livre.
    
A aceitação destes Termos de Uso é totalmente indispensável à utilização do site e seus serviços. Todos os Usuários são informados destes Termos de Uso, os quais deverão ler, certificar-se de tê- los entendidos e aceitar todas as condições neles estabelecidas. Deve ficar claro que a utilização do site implica na aceitação total dos seus Termos de Uso.
    
O uso dos serviços do Robô Livre também é governado pela nossa Política de Privacidade, a qual está incorporada nesse Acordo por esta referência e é encontrada no endereço http:// www.robolivre.org/termos/privacidade/.
    
I - Objetivo
O site Robô Livre, visa promover relações, discussões, debates e promover a interação de pessoas que tenham interesse em robótica livre num nível formal e informal mas de seriedade. Qualquer usuário que aja fora desse escopo definido, poderá ser punido com o cancelamento de sua ação pelos administradores do site ou até mesmo pela expulsão desse serviço.
    
II - Cadastro
Os Dados Informados no cadastro são verdadeiros. O Usuário deve fazer o preenchimento do cadastro com informações exatas, precisas e verdadeiras, também assume o compromisso de atualizar todos os dados que disponibilizarem no site, sempre que houver neles alguma alteração. A empresa Mix Tecnologia se reserva o direito de utilizar todos os meios válidos e possíveis para identificar seus Usuários.
    
Os Usuários garantem e respondem, em qualquer hipótese, pela veracidade, exatidão e autenticidade dos dados que disponibilizarem no site. A Mix Tecnologia não se responsabiliza pela correção desses Dados inseridos por seus Usuários. A Mix Tecnologia também se reserva o direito de solicitar dados adicionais e documentos que entenda serem pertinentes a fim de conferir os dados informados pelo Usuário, assim como inabilitar, temporária ou definitivamente o Usuário que apresentar alguma informação que não seja verdadeira ou que ao serviço Robô Livre não conseguir contatar para a verificação dos dados. Ao ser cancelado o cadastro do Usuário, automaticamente será cancelado seu acesso ao uso do site e também a qualquer serviço.
    
III - Manutenção da conta de acesso
O Usuário manterá sua senha em sigilo. O Usuário acessará sua conta por meio de seu login(Usuário) e senha, comprometendo-se a não informar a terceiros esses dados, responsabilizando-se integralmente pelo uso que deles seja feito. Compromete-se também a notificar o Robô Livre imediatamente, e através de meio seguro, a respeito de qualquer uso não autorizado de sua conta, bem como o acesso não autorizado por terceiros à mesma.
    
Caso o Usuário venha a ficar por um período de 12 meses sem movimentar sua conta ou utilizar- se dos serviços oferecidos pelo Robô Livre, esta poderá ser imediatamente cancelada com ou sem notificação.
    
IV - Modificação dos termos de uso
O site Robô Livre pode Mudar seus Termos de Uso. A empresa Mix Tecnologia reserva-se o direito de modificar quaisquer dos termos e condições contidas neste Termo de Uso, a qualquer tempo, por meio de atualização do mesmo no site. Estas modificações entrarão em vigor 15 dias após sua publicação no site.
    
Caso as modificações a serem realizadas neste Termo de Uso não sejam aprovadas pelo Usuário, cabe a ele o direito de recusar as novas condições e rescindir este Termo de Uso (enviando comunicação por escrito ao Robô Livre), no prazo de 10 dias contados da data da publicação referente à modificação.
    
Na hipótese do Usuário continuar participando do site e serviços do Robô Livre, após 15 dias contados da publicação no site, referente às modificações nos Termos de Uso, isso indicará que ele concordou com todas as modificações comunicadas.
    
V - Responsabilidade do usuário
Você declara e garante que todos os conteúdos inseridos por você no Robô Livre (i) estão de acordo com todas as leis, os estatutos, os decretos e os regulamentos aplicáveis; (ii) não infringem nem infringiram qualquer obrigação ou direito de qualquer pessoa ou entidade incluindo, sem limitação, direitos de propriedade intelectual, publicidade ou privacidade, ou direitos e deveres incluídos no direito do consumidor, responsabilidade do produto, delito ou teorias de contrato; e (iii) não são pornográficos ou violentos e nem incitam à violência. Não infringir as Regras do Robô Livre.
    
Agir de Acordo com a Moral
O Usuário compromete-se, em geral, a utilizar o site e seus serviços em conformidade com os presentes Termos de Uso do Robô Livre com a lei, a moral e os bons costumes aceitos e a ordem pública.
    
Não Praticar Atividades Hacker
O Usuário se compromete a utilizar o site e seus serviços de forma adequada e diligente, assim como se abster de utilizá-lo com objetivos ou meios para a prática de atos ilícitos, proibidos pela lei e pelos presentes Termos de Uso, lesivos aos direitos e interesses de terceiros, ou que, de qualquer forma, possa danificar, inutilizar, sobrecarregar ou deteriorar o site e seus serviços, bem como os equipamentos de informática de outros Usuário ou de outros internautas (hardware e software) assim como os documentos, arquivos e toda classe de conteúdos armazenados nos seus equipamentos de informática ou impedir a normal utilização ou gozo do site e seus serviços, equipamentos de informática e documentos, arquivos e conteúdos por parte dos demais Usuários e de outros internautas.
    
Materiais postados no site são materiais públicos
O material, informações e dados inseridos nas comunidades virtuais públicas e nos perfis estão sujeitas a serem inseridas nos mecanismos de busca.
    
Envio e Recebimento de Arquivos no robolivre.org
O armazenamento de arquivos é de responsabilidade dos usuários que realizam a operação, e não do Robô Livre. Assim cabe ao usuário verificar se o arquivo solicitado ou enviado contém vírus ou não. E também, verificar se o conteúdo do arquivo corresponde ao que nele é anunciado.
    
Agir de Acordo com os Limites da Liberdade de Expressão
Dentro do site Robô Livre há liberdade de expressão. Porém, deve-se respeitar as pessoas e instituições não agindo de forma a praticar Calúnia, Injúria ou Difamação como descritos nos artigos 138, 139 e 140, respectivamente do Código Penal Brasileiro. Portanto, é proibido ofender ou fazer julgamentos morais a terceiros dentro do site, estando sujeito à exclusão do perfil, como às penalidades previstas na lei pela parte prejudicada.
    
VI - Dos Direitos Autorais
O Usuário não deve infringir direitos de terceiros, sobretudo aqueles atinentes aos direitos personalíssimos (incluindo, mas não se limitando a: honra, nome e imagem da pessoa) ou direitos autorais (tais como reproduzir, modificar ou divulgar obra alheia sem expressa autorização do titular). Um material escrito, fotográfico, cinematográfico, dentre outras formas de captura e divulgação constituem obras passíveis de proteção autoral, sob a égide da Lei nº. 9.610/98. Em regra, o Usuário é titular dos direitos autorais de toda e qualquer obra que disponibilizar no site, seja na qualidade de autor, detentor de autorização do titular original dos direitos ou ainda como cessionário dos direitos patrimoniais da respectiva obra, salvo quando tal obra estiver consagradamente em domínio público ou sujeita às exceções legais previstas na Lei nº. 9.610/98. O Usuário, ao aceitar esses Termos de Uso do Robô Livre, autoriza o acesso aos materiais inseridos no site por outros Usuários devidamente cadastrados, além dessas obras estarem sujeitas a serem inseridas em mecanismos de busca. O Usuário se responsabiliza pelas obras que inserir no Robô Livre e deverá observar a legislação em vigor, tanto sob o aspecto formal (como a questão dos direitos autorais) quanto para o conteúdo (que não deverá violar as regras positivas nem os bons costumes e os princípios gerais da sociedade). Sendo assim, o Robô Livre não se responsabilizará civil ou penalmente em virtude de eventuais danos, morais ou materiais, causados pelas obras inseridas no site, sejam esses danos causados a outros usuários cadastrados ou a terceiros que porventura não estejam cadastrados como usuários do Robô Livre. O Usuário envolvido em denúncias de irregularidades ou infrações a direitos de terceiros se compromete, portanto, a eximir a Robô Livre de eventuais litígios decorrentes do dano que causou. Caso o Robô Livre seja imputado responsável por quaisquer danos morais ou materiais em virtude de inserção irregular e danos a terceiros, o Robô Livre promoverá ação indenizatória contra o usuário, sendo que este aceita desde já a arcar com todas as custas processuais e honorários advocatícios decorrentes dessa ação judicial.
    
VII - O spam é proibido
Não se Pode Usar o Robô Livre para Spam
O Usuário não usará o site Robô Livre para transmitir, seja direta ou indiretamente, nenhum email em massa nem email comercial não solicitado. Também não usará o site do Robô Livre de nenhuma maneira que viole as Políticas Anti-Spam existentes no país. A sua transgressão constitui uma violação deste Contrato. O Robô Livre pode usar tecnologia de filtragem ou outras medidas para barrar emails em massa e emails comerciais não solicitados e, se o seu uso do site Robô Livre incluir serviços de email relacionados, então, tal tecnologia de filtragem ou outras medidas podem bloquear, seja temporária ou permanentemente, alguns emails enviados a você por meio do site do Robô Livre, até mesmo se tais emails não violarem a Política Anti-Spam.
    
O Robô Livre não Pratica Spam
Os dados, assim como o e-mail dos usuários não serão em hipótese alguma vendidos ou fornecidos a terceiros sem a autorização expressa do mesmo. O Robô Livre pode apenas fazer campanha de e- mail Marketing com parceiros, caso o usuário assinalar que aceita esse tipo de e-mail ao fazer seu cadastro no Robô Livre , e essas campanhas estarão dentro do âmbito profissional.
    
VIII - Gratuidade do serviço
O serviços gratuitos oferecidos pelo Robô Livre são:
Perfil
Criação e participação de Conteúdos
Criação e participação de Comunidades
Projetos
Interatividade em campos públicos
O rol relacionado acima é exemplificativo, podendo o Robô Livre acrescentar, a qualquer tempo e sem aviso prévio, novas funcionalidades e módulos gratuitos a todos os usuários.
    
IX - Parceiros do Robô Livre
O Robô Livre poderá realizar parcerias com diversas empresas. Nesses casos os (a) Termos de Uso, (b) Regras do Robô Livre têm a mesma validade.
    
X - Legislação Aplicável e Foro de Eleição
Tudo que consta desses Termos de Uso estão regidos pelas normas vigentes na República Federativa do Brasil.
    
Fica eleito como foro competente para solucionar eventuais controvérsias decorrentes do presente Termo de Uso o Foro Central da cidade de Recife, estado de Pernambuco.
    
                </textarea>
                                            
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-large">Concluir Cadastro</button>
<!--            <a href="<?php echo url_for('inicial/index') ?>" class="btn">Cancelar</a>-->

            <p class="help-block"><strong>Nota:</strong> Outros usuários poderão encontrá-lo pelo nome, nome de usuário ou e-mail. Seu e-mail não será exibido publicamente. Você pode alterar suas configurações de privacidade a qualquer momento.</p>

        </div>

    </fieldset>    
</form>


<?php use_helper('Javascript') ?>
<script type="text/javascript">
    //<![CDATA[
    
    var SEPARADOR_PARAMETRO = '<?php echo Util::SEPARADOR_PARAMETRO ?>';
    
    function getValue(id) {
        return document.getElementById(id).value;
    }
    
    function validaCampoNome(campoNome){
        if(campoNome.value==""){
            document.getElementById('div-nome').className = "control-group error";
            document.getElementById('help-nome').innerHTML = "Campo obrigatório!";
        }else{
            document.getElementById('div-nome').className = "control-group success";
            document.getElementById('help-nome').innerHTML = "Bonito nome!";
        }
    }
    
    function atualizaHelpECampo(id,mensagem){
        
        descricao = "";
        classe = "success";
        
        if(mensagem != ""){
            if(mensagem == "Required."){
                classe = "error";
                descricao = "Campo obrigatório!";
            }else{
                classe = "warning";
                descricao = mensagem;
            }
        }
        
        document.getElementById('div-'+id).className = "control-group "+classe;
        document.getElementById('help-'+id).innerHTML = descricao;
    }
    
    function atualizaCamposAjax(mensagem){
        
        var erros = mensagem.split(SEPARADOR_PARAMETRO);
        var erro = '';
        for(i=0;i<erros.length;++i){
            if(erros[i]!= ""){
                erro = erros[i].split('=');
                atualizaHelpECampo(erro[0],erro[1]);
            }
        }
    }
    
    function validaForm() {
            new Ajax.Request(<?php echo "'".url_for("ajax/ajaxValidacaoFormCadastro") . "?usuarios[nome]='+getValue('nome')+'&usuarios[login]='+getValue('username')+'&usuarios[email]='+getValue('email')+'&usuarios[senha]='+getValue('pass')+'&usuarios[_csrf_token]='+getValue('usuarios__csrf_token')" ?>, {
                method: 'post', 
                onComplete: function(resposta) {
                    atualizaCamposAjax(resposta.responseText);
                }
            });     
        <?php  //echo remote_function(array('update' => 'conteudoPagina','url' => url_for("inicial/ajaxValidacaoFormCadastro") . "?usuarios[nome]='+getValue('nome')+'&usuarios[login]='+getValue('username')+'&usuarios[email]='+getValue('email')+'&usuarios[senha]='+getValue('pass')+'&usuarios[_csrf_token]='+getValue('usuarios__csrf_token')+'",)); ?>
    }//END validaForm

    function atualizaForcaSenha(inputSenha){

        var forca = getForcaSenha(inputSenha,document.getElementById('help-forca-senha'));

        if(forca == "Campo obrigatório!" || forca == "Insuficiente"){
            document.getElementById('div-senha').className = "control-group error";
        }else{
            document.getElementById('div-senha').className = "control-group success";
        }
        
        validaConfirmacaoSenhaEmail();
    }
    
    function validaConfirmacaoSenhaEmail(){

        var isValido = true;
       
        if(document.getElementById('pass').value.length==0){
            document.getElementById('div-confirmacao-senha').className = "control-group";
            document.getElementById('help-confirmacao-senha').innerHTML = "";
            isValido = false;
        }else if(document.getElementById('pass').value == document.getElementById('pass-conf').value){
            document.getElementById('div-confirmacao-senha').className = "control-group success";
            document.getElementById('help-confirmacao-senha').innerHTML = "";
        }else{
            document.getElementById('div-confirmacao-senha').className = "control-group error";
            document.getElementById('help-confirmacao-senha').innerHTML = "Repita a mesma senha acima!";
            
            isValido = false;
        }
        
        if(document.getElementById('email').value.length==0){
            document.getElementById('div-confirmacao-email').className = "control-group";
            document.getElementById('help-confirmacao-email').innerHTML = "";
            isValido = false;
        }else if(document.getElementById('email').value == document.getElementById('email-conf').value){
            document.getElementById('div-confirmacao-email').className = "control-group success";
            document.getElementById('help-confirmacao-email').innerHTML = "";
        }else{
            document.getElementById('div-confirmacao-email').className = "control-group error";
            document.getElementById('help-confirmacao-email').innerHTML = "Repita o mesmo email acima!";
            
            isValido = false;
        }
        
        return isValido;
    }
    
    validaConfirmacaoSenhaEmail();
    
    //]]>   
</script>