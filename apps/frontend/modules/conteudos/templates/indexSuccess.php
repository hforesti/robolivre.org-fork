<div class="modal fade" id="modalInfo">
    <div class="modal-header">
        <h3>Simples como 1, 2, 3</h3>
    </div>
    <div class="modal-body">
        <p>Antes de começar a buscar e criar conteúdos:</p>

        <p><span class="label label-success">1</span> Pense <strong>Conteúdo</strong> aqui na rede como galhos de uma árvore;</p>
        <p><span class="label label-success">2</span> Em cada conteúdo é possível encontrar coisas "penduradas" (Imagens, links...);</p>
        <p><span class="label label-success">3</span> Eles podem estar conectados, ou seja, ser conteúdos relacionados.</p>

    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary btn-large" data-dismiss="modal"><i class="icon-ok icon-white"></i> Começar a explorar e colaborar</a>
    </div>
</div>

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

                        <ul>
                            <?php foreach($melhoresConteudos as $conteudo){ ?>
                            <li>
                                <div class="thumbnail">
                                    <?php $innerHTML = "<img src='" . image_path($conteudo->getImagemPerfil(Util::IMAGEM_GRANDE)) . "' alt='" . $conteudo->getNome() . "' title='" . $conteudo->getNome() . "'>"; ?>
                                    <?php echo Util::getTagConteudoSlug($innerHTML, $conteudo->getNome()) ?>
                                    <h4><?php echo $conteudo->getNome(); ?></h4>
                                    <?php if($conteudo->getTemaAula()){ ?>
                                        <span class="label label-info">Tema de aula</span>
                                    <?php } ?>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>

                    </div>


                    <div class="tab-pane fade in" id="tags">

                        <div id="tagcloud">
                            <?php echo Util::getNuvemTags(); ?>
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


<script src="<?php echo javascript_path("/assets/js/autoSuggestv14/jquery.autoSuggest.minified.js") ?>"></script>
<script type="text/javascript">
//<![CDATA[
        
        $("#search-content").autoSuggest("<?php echo url_for('ajax/ajaxAutoSuggestConteudo'); ?>", 
        {
            minChars: 2, 
            matchCase: false,
            resultsHighlight: true,
            selectedItemProp: "name",
            searchObjProps: "name",
            startText: "Procurar conteúdo…",
            emptyText: "Nenhuma sugestão encontrada",
            resultClick: function(data){
                try{
                    url = url_for("conteudo/"+data['attributes']['slug']);
                    window.location = url;
                }catch(e){alert(e);}
            },

            formatList: function(data, elem){
                    //var new_elem = elem.html("<i class='icon-tag icon-gray'></i>"+ data.name);
                    //return new_elem;
                    var my_image = data.image;
                    var new_elem = elem.html("<img src='"+my_image+"' alt='"+ data.name+"'><h4 style='display:inline'>"+ data.name+"<h4><a href='conteudo.shtml'></a><br clear='all'>");
                    return new_elem;
            }
        });
        

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
                        var erros = resposta.split('<?php echo Util::SEPARADOR_PARAMETRO ?>');
                        idConjunto = erros[0].split('=')[1];
                        nomeConteudo = erros[1].split('=')[1];
                        slugConteudo = erros[2].split('=')[1];
                        
                        url_conteudo = "<?php echo url_for('conteudo/'); ?>"+slugConteudo;
                                                
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