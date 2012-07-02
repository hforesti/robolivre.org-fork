<?php

/**
 * Publicacoes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    robolivre
 * @subpackage model
 * @author     Max Guenes
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Publicacoes extends BasePublicacoes {

    const PUBLICACAO_COMUM = 0;
    const CRIACAO_CONJUNTO = 1;
    const SEGUIR_CONTEUDO = 2;
    
    const PRIVACIDADE_PUBLICA = 1;
    const PRIVACIDADE_PRIVADA = 0;
    const PRIVACIDADE_SOMENTE_AMIGOS = 2;

    const TIPO_NORMAL = "normal";
    const TIPO_VIDEO = "video";
    const TIPO_LINK = "link";
    const TIPO_FOTO = "foto";
    
    
    private $grupoComentarios = array();
    private $nomeUsuario;
    private $nomeUsuarioReferencia;
    private $imagemPerfilUsuario;
    private $nomeConjunto;
    private $imagemPerfilConjunto;
    
    public function getImagemPerfilUsuario($tipoImagem = Util::IMAGEM_MEDIA) {
        $imagem = $this->imagemPerfilUsuario;
        return Util::validaImagem($imagem, $tipoImagem,Util::TIPO_IMAGEM_USUARIO);
    }

    public function getImagemPerfilConjunto($tipoImagem = Util::IMAGEM_MINIATURA) {
        $imagem = $this->imagemPerfilConjunto;
        return Util::validaImagem($imagem, $tipoImagem,Util::TIPO_IMAGEM_CONTEUDO);
    }

    public function setImagemPerfilConjunto($imagemPerfilConjunto) {
        $this->imagemPerfilConjunto = $imagemPerfilConjunto;
    }

    public function setImagemPerfilUsuario($imagemPerfilUsuario) {
        $this->imagemPerfilUsuario = $imagemPerfilUsuario;
    }

    public function getNomeUsuarioReferencia() {
        return $this->nomeUsuarioReferencia;
    }

    public function setNomeUsuarioReferencia($nomeUsuarioReferencia) {
        $this->nomeUsuarioReferencia = $nomeUsuarioReferencia;
    }

    public function getNomeConjunto() {
        return $this->nomeConjunto;
    }

    public function setNomeConjunto($nomeConjunto) {
        $this->nomeConjunto = $nomeConjunto;
    }

    public function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    public function setNomeUsuario($nome_usuario) {
        $this->nomeUsuario = $nome_usuario;
    }

    public function getGrupoComentarios() {
        return array_reverse($this->grupoComentarios);
    }

    public function setGrupoComentarios($comentarios) {
        $this->grupoComentarios = $comentarios;
    }

    public function adicionarPublicacaoComentario(Publicacoes $publicacao) {
        $this->grupoComentarios[$publicacao->getIdPublicacao()] = $publicacao;
    }
    
    public function imprimir($nomeForm = null,$arrayParametrosInclude = null) {
        echo $this->getImpressao($nomeForm, $arrayParametrosInclude);
    }
    
    public function getImpressao($nomeForm = null,$arrayParametrosInclude = null) {
       
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Helper', 'Tag', 'Url', 'Asset'));
        
        $comMenuDropDown = true;
        $comPermaLink = true;
        $string = "";
        if ($this->getTipoPublicacao() == self::PUBLICACAO_COMUM) {
            
            if($this->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()){
                $id = "id=\"".$this->getIdPublicacao()."\"";
            }else{
                $id = "";
            }
            
            $string .= "<li $id class=\"vcard\">";
            $string .= "<a href=\"" . url_for('perfil/exibir?u=' . $this->getIdUsuario()) . "\" class=\"photo\">";
            $string .= "<img src=\"" . image_path($this->getImagemPerfilUsuario()) . "\" alt=\"".$this->getNomeUsuario()."\" title=\"".$this->getNomeUsuario()."\">";
                
            
                 
            //NO CONJUNTO (COMUNIDADE OU CONTEUDO)
            if ($this->getIdConjunto() != null) {
                $string .= "<img src=\"" . image_path($this->getImagemPerfilConjunto()) . "\" alt=\"" . $this->getNomeConjunto() . "\" title=\"" . $this->getNomeConjunto() . "\" class=\"sub-icon\">";
                $string .="</a>";
                $string .= "<div class=\"entry\">";       
                $string .= Util::getTagUsuario($this->getNomeUsuario(), $this->getIdUsuario());
                $string .= " publicou em ".Util::getTagConteudo($this->getNomeConjunto(),"fn",true).".";
            
            //NO PERFIL DE ALGUEM    
            } else if ($this->getIdUsuarioReferencia() != null) {
                $string .="</a>";
                $string .= "<div class=\"entry\">";       
                $string .= Util::getTagUsuario($this->getNomeUsuario(), $this->getIdUsuario());
                $string .= " EM ";
                $string .= Util::getTagUsuario($this->getNomeUsuarioReferencia(), $this->getIdUsuarioReferencia());
            
            //PUBLICAÇÃO ATUALIZAÇÃO DE STATUS
            }else{
                $string .="</a>";
                $string .= "<div class=\"entry\">";
                $string .= Util::getTagUsuario($this->getNomeUsuario(), $this->getIdUsuario());
            }
            
            if($this->getLink()!="" && $this->getLink()!=null){
                $link = Util::formataLink($this->getLink());
                $title = Util::getTitle($link);
                $string .="<blockquote><p>";
                $string .="<a target=\"_blank\" href=\"$link\">$title</a>";
                $string .="</p></blockquote>";
            }else if($this->getIdPasta()!=null && $this->getIdPasta()!=""){
                if($this->getIdImagem()!=null && $this->getIdImagem()!=""){
                    $imagem = Doctrine::getTable('Imagens')->find(array($this->getIdImagem(),$this->getIdUsuario(),$this->getIdPasta()));
                    $array = explode(".",$imagem->getNomeArquivo());
                    
                    $diretorioArquivo = Util::getLinkFotosPublicacoes($this->getIdUsuario())."/".$array[0].'.'.$array[1];
                    
                    $string .= "<div class=\"share-content\">";
                    $string .= "<img src=\"".image_path($diretorioArquivo)."\" alt=\"Imagem compartilhada\" class=\"thumbnail\">";
                    $string .= "</div>";
                    
                }else if($this->getIdVideo()!=null && $this->getIdVideo()!=""){
                    $video = Doctrine::getTable('Videos')->find(array($this->getIdVideo(),$this->getIdUsuario(),$this->getIdPasta()));
                    preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $video->getLinkVideo(), $matches);
                    if(isset($matches[2]) && $matches[2] != ''){
                        $YoutubeCode = $matches[2];
                    }		
                    
                    
                    $string .= "<div class=\"share-content\">";
                        $string .= "<a href=\"".  url_for("publicacao/exibir?u=".$this->getIdPublicacao())."\" class=\"shared-item\"><img src=\"http://img.youtube.com/vi/$YoutubeCode/0.jpg\" alt=\"Imagem do video compartilhado\" class=\"thumbnail\"><div class=\"btn-play\"></div></a>";
                        $string .= "<div class=\"video-embed\">";
                            $string .= "<iframe width=\"480\" height=\"360\" src=\"http://www.youtube.com/embed/$YoutubeCode\" frameborder=\"0\" allowfullscreen></iframe>";
                        $string .= "</div>";
                    $string .= "</div>";
                }
            }
            
            $string .= "<p>".Util::getTextoFormatado($this->getComentario())."</p>";
            $string .= "<ul class=\"meta\">";
            
            if($this->getPrivacidadePublicacao() == self::PRIVACIDADE_PUBLICA){
                $string .= "<li class=\"visivel-para\"><i class=\"icon-eye-open\" title=\"Público\"></i></li>";
            }else if($this->getPrivacidadePublicacao() == self::PRIVACIDADE_SOMENTE_AMIGOS){
                $string .= "<li class=\"visivel-para\"><i class=\"icon-user\" title=\"Só para amigos\"></i></li>";
                $comPermaLink = false;
                $comMenuDropDown = false;
            }else if($this->getPrivacidadePublicacao() == self::PRIVACIDADE_PRIVADA){
                $string .= "<li class=\"visivel-para\"><i class=\"icon-lock\" title=\"Privado\"></i></li>";
                $comPermaLink = false;
                $comMenuDropDown = false;
            }
            
            if($comPermaLink){
             $time = "<a href=\"".  url_for("publicacao/exibir?u=".$this->getIdPublicacao())."\">".Util::getDataSimplificada($this->getDataPublicacao())."</a>";
            }else{
                $time = Util::getDataSimplificada($this->getDataPublicacao());
            }
            $string .= "<li class=\"time\" title=\"" . Util::getDataFormatada($this->getDataPublicacao()) . "\">$time</li>";
            
            if($this->getPrivacidadePublicacao() == self::PRIVACIDADE_PUBLICA){
                $string .= "<li class=\"share-now\">";
                $string .= "<div class=\"btn-group\">";
                $string .= "        <a class=\"btn btn-mini dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Compartilhar\">";
                $string .= "    <span class=\"icon-share icon-gray\"></span>";
                $string .= "        </a>";
                $string .= "        <ul class=\"dropdown-menu\">";
                $string .= "        <li class=\"go-twitter\">";
                $string .= "                <a href=\"https://twitter.com/share?url=".url_for("publicacao/exibir?u=".$this->getIdPublicacao(),true)."&text=Olha+o+que+encontrei+na+rede+%40robolivre%3A&related=robolivre\">Compartilhar no <strong>Twitter</strong></a>";
                $string .= "        </li>";
                $string .= "        <li class=\"go-fb\">";
                $string .= "        <a href=\"https://www.facebook.com/sharer.php?u=".url_for("publicacao/exibir?u=".$this->getIdPublicacao(),true)."&t=Publicação na rede Robô livre\">Compartilhar no <strong>Facebook</strong></a>";
                $string .= "        </li>";
                $string .= "        </ul>";
                $string .= "</div><!-- btn-group -->";
                $string .= "</li>";
            }
            $string .= "</ul>";
            
            $string .= "<ul class=\"comments\">";
            if(count($this->getGrupoComentarios())>0){
                
                foreach ($this->getGrupoComentarios() as $comentario) {
                    $string .= "<li><a href=\"" . url_for('perfil/exibir?u=' . $comentario->getIdUsuario()) . "\" class=\"photo\"><img src=\"" . image_path($this->getImagemPerfilUsuario()) . "\" alt=\"".$comentario->getNomeUsuario()."\" title=\"".$comentario->getNomeUsuario()."\"></a>";
                    $string .= Util::getTagUsuario($comentario->getNomeUsuario(), $comentario->getIdUsuario());
                    $string .= "<div class=\"comment\">";
                    $string .= "<p>".Util::getTextoFormatado($comentario->getComentario())."</p>";
                    $string .= "</div>";
                    $string .= "<a class=\"close\" title=\"Excluir seu comentário\">&times;</a>";
                    $string .= "</li>";
                    
                    
                }
                
                
            }

            //se tem formulário de comentário
            if($nomeForm!=null && $arrayParametrosInclude != null){
                include_partial($nomeForm, $arrayParametrosInclude);
            }

            $string .= "</ul>";
            
            $string .= "</div><!-- entry -->";
            
            
            
            
         /** ATIVIDADES **/   
            
            
        //CRIACAO DE CONTEUDO OU COMUNIODADE    
        } else if ($this->getTipoPublicacao() == self::CRIACAO_CONJUNTO) {
            $comMenuDropDown = false;
            $string .= "<li class=\"vcard activity\">";
            $string .= "<a href=\"" . url_for('perfil/exibir?u=' . $this->getIdUsuario()) . "\" class=\"photo\"><img src=\"" . image_path($this->getImagemPerfilUsuario(Util::IMAGEM_MINIATURA)) . "\" alt=\"".$this->getNomeUsuario()."\" title=\"".$this->getNomeUsuario()."\"></a>";
            $string .= Util::getTagUsuario($this->getNomeUsuario(), $this->getIdUsuario());
            $string .= " criou ";
            $string .= Util::getTagConteudo($this->getNomeConjunto(),"fn",true);
            $string .= ". <span class=\"time\" title=\"" . Util::getDataFormatada($this->getDataPublicacao()) . "\">" . Util::getDataSimplificada($this->getDataPublicacao()) . "</span>";
           
        //SEGUINDO CONTEÚDO
        } else if ($this->getTipoPublicacao() == self::SEGUIR_CONTEUDO) {
            $comMenuDropDown = false;
            $string .= "<li class=\"vcard activity\">";
            $string .= "<a href=\"" . url_for('perfil/exibir?u=' . $this->getIdUsuario()) . "\" class=\"photo\"><img src=\"" . image_path($this->getImagemPerfilUsuario(Util::IMAGEM_MINIATURA)) . "\" alt=\"".$this->getNomeUsuario()."\" title=\"".$this->getNomeUsuario()."\"></a>";
            $string .= Util::getTagUsuario($this->getNomeUsuario(), $this->getIdUsuario());

            $string .= " está seguindo ";
            $string .= Util::getTagConteudo($this->getNomeConjunto(),"fn",true);
            $string .= ". <span class=\"time\" title=\"" . Util::getDataFormatada($this->getDataPublicacao()) . "\">" . Util::getDataSimplificada($this->getDataPublicacao()) . "</span>";
        }

        if($comMenuDropDown){
                $string .= "<div class=\"btn-group drop-options\">";
                $string .= "<a class=\"btn btn-mini dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Opções\">";
                $string .= "                <span class=\"icon-cog icon-gray\"></span>";
                $string .= "            </a>";
                $string .= "            <ul class=\"dropdown-menu\">";
                if(UsuarioLogado::getInstancia()->getIdUsuario() == $this->getIdUsuario()){
                    $string .= "                <li class=\"action-delete\">";
                    $string .= "                    <a data-toggle=\"modal\" href=\"#modalDelete\"><i class=\"icon-remove-circle icon-gray\"></i> Excluir atualização</a>";
                    $string .= "                </li>";
                }else{
                    $string .= "                <li>";
                    $string .= "                    <a data-toggle=\"modal\" href=\"".  url_for("contato/reportarErro?mensagem_sistema=publicacao-exibir-u=".$this->getIdPublicacao())."\"><i class=\"icon-flag\"></i> Reportar abuso ou spam</a>";
                    $string .= "                </li>";
                }
                $string .= "            </ul>";
                $string .= "</div>";
        }
        $string .= "<input type='hidden' name='id_ultima_publicacao' class='input-id-ultima-publicacao' value='".$this->getIdPublicacao()."' >";
        $string .= "</li>";
        return $string;
    }
    
    public function getImpressaoEmConteudo($nomeForm = null,$arrayParametrosInclude = null) {
       
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Helper', 'Tag', 'Url', 'Asset'));
        
        $comMenuDropDown = true;
        $comPermaLink = true;
        $string = "";
        if ($this->getTipoPublicacao() == self::PUBLICACAO_COMUM) {
            
            if($this->getIdUsuario() == UsuarioLogado::getInstancia()->getIdUsuario()){
                $id = "id=\"".$this->getIdPublicacao()."\"";
            }else{
                $id = "";
            }
            
            $string .= "<li $id class=\"vcard\">";
            $string .= "<a href=\"" . url_for('perfil/exibir?u=' . $this->getIdUsuario()) . "\" class=\"photo\">";
            $string .= "<img src=\"" . image_path($this->getImagemPerfilUsuario()) . "\" alt=\"".$this->getNomeUsuario()."\" title=\"".$this->getNomeUsuario()."\">";
                
                 
            //NO CONJUNTO (COMUNIDADE OU CONTEUDO)
            if ($this->getIdConjunto() != null) {
                $string .= "<img src=\"" . image_path($this->getImagemPerfilConjunto()) . "\" alt=\"" . $this->getNomeConjunto() . "\" title=\"" . $this->getNomeConjunto() . "\" class=\"sub-icon\">";
                $string .="</a>";
                $string .= "<div class=\"entry\">";       
                $string .= Util::getTagUsuario($this->getNomeUsuario(), $this->getIdUsuario());
            }
            
            if($this->getLink()!="" && $this->getLink()!=null){
                $title = Util::getTitle($this->getLink());
                $string .="<blockquote><p>";
                $string .="<a target=\"_blank\" href=\"".$this->getLink()."\">$title</a>";
                $string .="</p></blockquote>";
            }else if($this->getIdPasta()!=null && $this->getIdPasta()!=""){
                if($this->getIdImagem()!=null && $this->getIdImagem()!=""){
                    $imagem = Doctrine::getTable('Imagens')->find(array($this->getIdImagem(),$this->getIdUsuario(),$this->getIdPasta()));
                    $array = explode(".",$imagem->getNomeArquivo());
                    
                    $diretorioArquivo = Util::getLinkFotosPublicacoes($this->getIdUsuario())."/".$array[0].'.'.$array[1];
                    
                    $string .= "<div class=\"share-content\">";
                    $string .= "<img src=\"".image_path($diretorioArquivo)."\" alt=\"Imagem compartilhada\" class=\"thumbnail\">";
                    $string .= "</div>";
                    
                }else if($this->getIdVideo()!=null && $this->getIdVideo()!=""){
                    $video = Doctrine::getTable('Videos')->find(array($this->getIdVideo(),$this->getIdUsuario(),$this->getIdPasta()));
                    preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $video->getLinkVideo(), $matches);
                    if(isset($matches[2]) && $matches[2] != ''){
                        $YoutubeCode = $matches[2];
                    }		
                    
                    
                    $string .= "<div class=\"share-content\">";
                        $string .= "<a href=\"".  url_for("publicacao/exibir?u=".$this->getIdPublicacao())."\" class=\"shared-item\"><img src=\"http://img.youtube.com/vi/$YoutubeCode/0.jpg\" alt=\"Imagem do video compartilhado\" class=\"thumbnail\"><div class=\"btn-play\"></div></a>";
                        $string .= "<div class=\"video-embed\">";
                            $string .= "<iframe width=\"480\" height=\"360\" src=\"http://www.youtube.com/embed/$YoutubeCode\" frameborder=\"0\" allowfullscreen></iframe>";
                        $string .= "</div>";
                    $string .= "</div>";
                }
            }
            
            $string .= "<p>".Util::getTextoFormatado($this->getComentario())."</p>";
            $string .= "<ul class=\"meta\">";
            
            if($this->getPrivacidadePublicacao() == self::PRIVACIDADE_PUBLICA){
                $string .= "<li class=\"visivel-para\"><i class=\"icon-eye-open\" title=\"Público\"></i></li>";
            }else if($this->getPrivacidadePublicacao() == self::PRIVACIDADE_SOMENTE_AMIGOS){
                $string .= "<li class=\"visivel-para\"><i class=\"icon-user\" title=\"Só para amigos\"></i></li>";
                $comPermaLink = false;
                $comMenuDropDown = true;
            }else if($this->getPrivacidadePublicacao() == self::PRIVACIDADE_PRIVADA){
                $string .= "<li class=\"visivel-para\"><i class=\"icon-lock\" title=\"Privado\"></i></li>";
                $comPermaLink = false;
                $comMenuDropDown = true;
            }
            
            if($comPermaLink){
             $time = "<a href=\"".  url_for("publicacao/exibir?u=".$this->getIdPublicacao())."\">".Util::getDataSimplificada($this->getDataPublicacao())."</a>";
            }else{
                $time = Util::getDataSimplificada($this->getDataPublicacao());
            }
            $string .= "<li class=\"time\" title=\"" . Util::getDataFormatada($this->getDataPublicacao()) . "\">$time</li>";
            if($this->getPrivacidadePublicacao() == self::PRIVACIDADE_PUBLICA){
                $string .= "<li class=\"share-now\">";
                $string .= "<div class=\"btn-group\">";
                $string .= "        <a class=\"btn btn-mini dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Compartilhar\">";
                $string .= "    <span class=\"icon-share icon-gray\"></span>";
                $string .= "        </a>";
                $string .= "        <ul class=\"dropdown-menu\">";
                $string .= "        <li class=\"go-twitter\">";
                $string .= "                <a href=\"https://twitter.com/share?url=".url_for("publicacao/exibir?u=".$this->getIdPublicacao(),true)."&text=Olha+o+que+encontrei+na+rede+%40robolivre%3A&related=robolivre\">Compartilhar no <strong>Twitter</strong></a>";
                $string .= "        </li>";
                $string .= "        <li class=\"go-fb\">";
                $string .= "        <a href=\"https://www.facebook.com/sharer.php?u=".url_for("publicacao/exibir?u=".$this->getIdPublicacao(),true)."&t=Publicação na rede Robô livre\">Compartilhar no <strong>Facebook</strong></a>";
                $string .= "        </li>";
                $string .= "        </ul>";
                $string .= "</div><!-- btn-group -->";
                $string .= "</li>";
            }
            $string .= "</ul>";
            
            
            $string .= "<ul class=\"comments\">";
            if(count($this->getGrupoComentarios())>0){
                
                foreach ($this->getGrupoComentarios() as $comentario) {
                    $string .= "<li><a href=\"" . url_for('perfil/exibir?u=' . $comentario->getIdUsuario()) . "\" class=\"photo\"><img src=\"" . image_path($this->getImagemPerfilUsuario()) . "\" alt=\"".$comentario->getNomeUsuario()."\" title=\"".$comentario->getNomeUsuario()."\"></a>";
                    $string .= Util::getTagUsuario($comentario->getNomeUsuario(), $comentario->getIdUsuario());
                    $string .= "<div class=\"comment\">";
                    $string .= "<p>".Util::getTextoFormatado($comentario->getComentario())."</p>";
                    $string .= "</div>";
                    $string .= "<a class=\"close\" title=\"Excluir seu comentário\">&times;</a>";
                    $string .= "</li>";
                    
                    
                }
                
                
            }

            //se tem formulário de comentário
            if($nomeForm!=null && $arrayParametrosInclude != null){
                include_partial($nomeForm, $arrayParametrosInclude);
            }

            $string .= "</ul>";
            
            $string .= "</div><!-- entry -->";
            
         /** ATIVIDADES **/   
            
        //CRIACAO DE CONTEUDO OU COMUNIODADE    
        } else if ($this->getTipoPublicacao() == self::CRIACAO_CONJUNTO) {
            $comMenuDropDown = false;
            $string .= "<li class=\"vcard activity\">";
            $string .= "<a href=\"" . url_for('perfil/exibir?u=' . $this->getIdUsuario()) . "\" class=\"photo\"><img src=\"" . image_path($this->getImagemPerfilUsuario(Util::IMAGEM_MINIATURA)) . "\" alt=\"".$this->getNomeUsuario()."\" title=\"".$this->getNomeUsuario()."\"></a>";
            $string .= Util::getTagUsuario($this->getNomeUsuario(), $this->getIdUsuario());
            $string .= " criou ";
            $string .= Util::getTagConteudo($this->getNomeConjunto(),"fn",true);
            $string .= ". <span class=\"time\" title=\"" . Util::getDataFormatada($this->getDataPublicacao()) . "\">" . Util::getDataSimplificada($this->getDataPublicacao()) . "</span>";
           
        //SEGUINDO CONTEÚDO
        } else if ($this->getTipoPublicacao() == self::SEGUIR_CONTEUDO) {
            $comMenuDropDown = false;
            $string .= "<li class=\"vcard activity\">";
            $string .= "<a href=\"" . url_for('perfil/exibir?u=' . $this->getIdUsuario()) . "\" class=\"photo\"><img src=\"" . image_path($this->getImagemPerfilUsuario(Util::IMAGEM_MINIATURA)) . "\" alt=\"".$this->getNomeUsuario()."\" title=\"".$this->getNomeUsuario()."\"></a>";
            $string .= Util::getTagUsuario($this->getNomeUsuario(), $this->getIdUsuario());

            $string .= " está seguindo ";
            $string .= Util::getTagConteudo($this->getNomeConjunto(),"fn",true);
            $string .= ". <span class=\"time\" title=\"" . Util::getDataFormatada($this->getDataPublicacao()) . "\">" . Util::getDataSimplificada($this->getDataPublicacao()) . "</span>";
        }else{
            return "";
        }

        if($comMenuDropDown){
            $string .= "<div class=\"btn-group drop-options\">";
                $string .= "<a class=\"btn btn-mini dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" title=\"Opções\">";
                $string .= "                <span class=\"icon-cog icon-gray\"></span>";
                $string .= "            </a>";
                $string .= "            <ul class=\"dropdown-menu\">";
                if(UsuarioLogado::getInstancia()->getIdUsuario() == $this->getIdUsuario()){
                    $string .= "                <li class=\"action-delete\">";
                    $string .= "                    <a data-toggle=\"modal\" href=\"#modalDelete\"><i class=\"icon-remove-circle icon-gray\"></i> Excluir atualização</a>";
                    $string .= "                </li>";
                }else{
                    $string .= "                <li>";
                    $string .= "                    <a data-toggle=\"modal\" href=\"".  url_for("contato/reportarErro?mensagem_sistema=publicacao-exibir-u=".$this->getIdPublicacao())."\"><i class=\"icon-flag\"></i> Reportar abuso ou spam</a>";
                    $string .= "                </li>";
                }

                $string .= "            </ul>";
                $string .= "</div>";
        }
        $string .= "<input type='hidden' name='id_ultima_publicacao' class='input-id-ultima-publicacao' value='".$this->getIdPublicacao()."' >";
        $string .= "</li>";
        return $string;
    }

}

