<div class="row">


    <hr class="only-mobile">

    <div class="span10 offset1">


        <div class="page-header">

            <a href="#modalNovoConteudo" data-toggle="modal" class="btn btn-success pull-right"><i class="icon-plus icon-white"></i> Criar novo conteúdo</a>

            <h1>Conteúdos</h1>

            <!-- modal -->
            <div class="modal fade" id="modalNovoConteudo">
                <form name="formNovoConteudo" action="<?php echo url_for('conteudos/criar') ?>" method="post" id="form-criar">

                    <div class="modal-header">
                        <a class="close" data-dismiss="modal">×</a>
                        <h3>Criar novo conteúdo</h3>
                    </div>

                    <div id="div-modal" class="modal-body">

                        <div class="control-group">
                            <div class="controls">
                                <input id="nome" type="text" name="nome" class="span5" id="input-nome-conteudo" placeholder="Nome do conteúdo" value="">
                            </div>
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <div class="pull-right" id="div-botao-criar">
                            <button type="button" onclick="validaForm()" class="btn btn-primary">Criar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /modal -->


        </div>


        <div id="explore" class="clearfix">
<h2>Explore nosso mundo de conteúdos</h2>
<form class="form-search" action="#">
  <input type="text" id="search-content" class="span5 search-query" placeholder="Procurar conteúdo…">
</form>

	<div id="featured">

<ul class="nav nav-pills">
  <li class="active">
    <a href="#thumbs" data-toggle="tab"><i class="icon-fire icon-gray"></i> Mais Populares</a>
  </li>
  <li><a href="#tags" data-toggle="tab"><i class="icon-tags icon-gray"></i> Nuvem de Tags</a></li>
</ul>

<hr>

<div class="tab-content">
  <div class="tab-pane active fade in" id="thumbs">

	<ul class="thumbnails">
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>Nome do conteúdo</h5></div></li>
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>Apostila de C para PIC</h5></div></li>
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>Sistema de Processamento Principal - ARM</h5></div></li>
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>Arduino</h5> <span class="label label-info">Tema de aula</span></div></li>
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>Projeto Mecânico 22</h5></div></li>
	</ul>

	<ul class="thumbnails">
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>Encoder</h5> <span class="label label-info">Tema de aula</span></div></li>
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>ProUCA</h5></div></li>
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>MSWLogo</h5></div></li>
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>Encoder</h5> <span class="label label-info">Tema de aula</span></div></li>
		<li class="span2"><div class="thumbnail"><a href="conteudo.shtml"><img src="/assets/img/rl/170.gif" alt="Nome do conteúdo" title="Nome do conteúdo"></a> <h5>Iniciando com o Arduino</h5></div></li>
	</ul>
  </div>


  <div class="tab-pane fade in" id="tags">
  
	<div id="tagcloud">
		<a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">LAME4</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Nasdaq</a>
		<a href="conteudo.shtml" title="14 itens" style="font-size: 15.0636942675px;">Apresentações</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Programa</a>
		<a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Programação</a>
		<a href="conteudo.shtml" title="5 itens" style="font-size: 22.2611464968px;">LAME4</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">C++</a>
		<a href="conteudo.shtml" title="14 itens" style="font-size: 25.0636942675px;">New Highs New Lows</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Programa</a>
		<a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Projeto</a>
		<a href="conteudo.shtml" title="4 itens" style="font-size: 11.7006369427px;">Animação</a>
		<a href="conteudo.shtml" title="5 itens" style="font-size: 22.2611464968px;">Bípede</a>
		<a href="conteudo.shtml" title="4 itens" style="font-size: 11.7006369427px;">cattec</a>
		<a href="conteudo.shtml" title="96 itens" style="font-size: 20.7388535032px;">Circuitos</a>
		<a href="conteudo.shtml" title="42 itens" style="font-size: 18.2165605096px;">Código Fonte</a>
		<a href="conteudo.shtml" title="6 itens" style="font-size: 12.7515923567px;">Com rodas</a>
		<a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Documento</a>
		<a href="conteudo.shtml" title="7 itens" style="font-size: 13.101910828px;">GGBR4</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 21px;">GVTT3</a>
		<a href="conteudo.shtml" title="147 itens" style="font-size: 22px;">Ibov</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">ITAU4</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 52px;" class="nofade">Arduino</a>
		<a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">ITUB4</a>
		<a href="conteudo.shtml" title="18 itens" style="font-size: 15.7643312102px;">Evento</a>
		<a href="conteudo.shtml" title="36 itens" style="font-size: 17.7961783439px;">LAD</a>
		<a href="conteudo.shtml" title="36 itens" style="font-size: 32px;" class="nofade">Open source</a>
		<a href="conteudo.shtml" title="5 itens" style="font-size: 22.2611464968px;">LAME4</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Nasdaq</a>
		<a href="conteudo.shtml" title="14 itens" style="font-size: 15.0636942675px;">New Highs New Lows</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Programa</a>
		<a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Programação</a>
		<a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">LAME4</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Nasdaq</a>
		<a href="conteudo.shtml" title="14 itens" style="font-size: 25.0636942675px;">New Highs New Lows</a>
		<a href="conteudo.shtml" title="3 itens" style="font-size: 11px;">Programa</a>
		<a href="conteudo.shtml" title="82 itens" style="font-size: 20.2484076433px;">Projeto</a>
	</div>	
	
  </div>
</div>


	</div>

</div><!-- #explore -->

<hr>

<div class="row" id="institucional-content">
	<h3>Conteúdo da Equipe Robô Livre</h3>

<div class="span5 list-conteudos">
	<h6>Apresentações</h6>
<table class="table table-striped">
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
      <td><span class="label label-info">Novo</span> <a href="#">Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum</a></td>
      <td>PPT</td>
    </tr>
    <tr>
      <td><a href="#">Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum</a></td>
      <td>PDF</td>
    </tr>
    <tr>
      <td><a href="#">Mattis Pharetra Sit Amet</a></td>
      <td>ZIP</td>
    </tr>
    <tr>
      <td><a href="#">Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum</a></td>
      <td>PDF</td>
    </tr>
  </tbody>
</table>

</div><!-- list-conteudos -->

<div class="span5 list-conteudos">
	<h6>Publicações científicas</h6>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Arquivo</th>
      <th>Formato</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><span class="label label-info">Novo</span> <a href="#">Mattis Pharetra Sit Amet</a></td>
      <td>PDF</td>
    </tr>
    <tr>
      <td><a href="#">Donec sed odio dui. Cras mattis consectetur purus sit</a></td>
      <td>PDF</td>
    </tr>
    <tr>
      <td><a href="#">Mattis Pharetra Sit Amet</a></td>
      <td>DOC</td>
    </tr>
    <tr>
      <td><a href="#">Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum</a></td>
      <td>ZIP</td>
    </tr>
    <tr>
      <td><a href="#">Donec sed odio dui. Cras mattis consectetur purus sit amet fermentum</a></td>
      <td>PDF</td>
    </tr>
  </tbody>
</table>

</div><!-- list-conteudos -->


</div>

</div><!-- /miolo -->



</div><!-- /row -->

<script type="text/javascript">
    //<![CDATA[
    
    var SEPARADOR_PARAMETRO = '<?php echo Util::SEPARADOR_PARAMETRO ?>';
    
    function getSlug(nome){
        arraySlug = nome.toLowerCase().split(" ");
        retorno = "";
        for(i=0;i< arraySlug.length;++i ){
            if(retorno == ""){
                retorno = arraySlug[i];
            }else{
                retorno += "-"+arraySlug[i];
            }
        }
        
        return retorno;
    }
    
    function getValue(id) {
        return document.getElementById(id).value;
    }
    
    function validaForm() {        
        $("#alert-modalNovoConteudo").remove();
        
        
        if(getValue('nome') != ""){
            
            $("#div-botao-criar").prepend("<img src='<?php echo image_path('/assets/img/rl/loading.gif'); ?>' id='imagem-load' alt='Carregando'>");
            
            $.ajax({
                url: <?php echo "'" . url_for("ajax/ajaxValidaNomeConteudo") . "?nome='+getValue('nome')" ?>,
                success: function(resposta){
                    $("#imagem-load").remove();
                    if(resposta == "ok"){
                        document.forms["formNovoConteudo"].submit();
                    }else{
                        var erros = resposta.split(SEPARADOR_PARAMETRO);
                        idConjunto = erros[0].split('=')[1];
                        nomeConteudo = erros[1].split('=')[1];
                        
                        url_conteudo = "<?php echo url_for('conteudo/'); ?>"+getSlug(nomeConteudo);
                                                
                        $("#div-modal").append("<div id='alert-modalNovoConteudo' class='alert'><a href='"+url_conteudo+"'>"+nomeConteudo+"</a> é um conteúdo que já existe na nossa rede. <br>Deseja colaborar com ele? <a href='"+url_conteudo+"'><strong>Acesse agora</strong></a></div>");
                        
                    }
                }
            });
        }else{ //END if getValue
            $("#div-modal").append("<div id='alert-modalNovoConteudo' class='alert-error'>Digite um nome</div>");
        }
        
    }//END validaForm
    
    
    $('#form-criar').submit(function(){
        validaForm();
        return false;
    });
    
    
    
    //]]>   
</script>