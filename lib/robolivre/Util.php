<?php

//include_once "tipografia/php-typography.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Util
 *
 * @author maxguenes
 */
class Util {
    
    //1296000 = 15 dias
    const TEMPO_COOKIE = 1296000;
    const QUANTIDADE_PAGINACAO = 10;
    const SEPARADOR_PARAMETRO = '[[*]]';
    const IMAGEM_GRANDE = 1;
    const IMAGEM_MEDIA = 2;
    const IMAGEM_MINIATURA = 3;
    const TIPO_IMAGEM_CONTEUDO = 1;
    const TIPO_IMAGEM_USUARIO = 2;

    public static function getTagUsuario($nomeUsuario, $idUsuario) {
        return "<a href=\"" . url_for('perfil/exibir?u=' . $idUsuario) . "\">$nomeUsuario</a>";
    }

    public static function getTagConteudo($nomeConteudo, $class = "", $comImagemReferencia = false) {

        $url = url_for('conteudo/' . self::criaSlug($nomeConteudo));

        return (($comImagemReferencia) ? "<i class=\"icon-file icon-gray\"></i>" : "") . "<a href=\"$url\" class=\"$class\">$nomeConteudo</a>";
    }

    public static function getTagConteudoSlug($innerHTML, $slug, $class = "") {

        $url = url_for('conteudo/' . self::criaSlug($slug));

        return "<a href=\"$url\" class=\"$class\">$innerHTML</a>";
    }

    public static function getTextoFormatado($texto) {
        $typo = new phpTypography();
        return $typo->process($texto);
    }

    public static function pre($string, $stop = false) {
        echo "<pre>";
        print_r($string);
        echo "</pre>";

        if ($stop) {
            die();
        }
    }

    public static function validaNullInserBanco($valor) {
        return ($valor == "" || $valor == null) ? 'null' : "'$valor'";
    }

    public static function dataIng($data) {

        $vetorData = explode("/", $data);

        return $vetorData[2] . "-" . $vetorData[1] . "-" . $vetorData[0];
    }

    public static function dataBr($data) {

        $vetorData = explode("-", $data);

        return $vetorData[2] . "/" . $vetorData[1] . "/" . $vetorData[0];
    }

    public static function dataBrHora($data) {

        $vetorData = explode(" ", $data);

        $vetorData[0] = Util::dataBr($vetorData[0]);
        $vetorData[1] = substr($vetorData[1], 0, 5);

        return $vetorData;
    }

    public static function dataIngHora($data) {

        $vetorData = explode(" ", $data);

        $vetorData[0] = Util::dataIng($vetorData[0]);

        return $vetorData[0] . " " . $vetorData[1];
    }

    public static function getNomeSimplificado($nome) {
        $array = explode(" ", $nome);
        return $array[0];
    }

    public static function getDataFormatada($data) {
        $dataRetorno = self::dataBrHora($data);
        return self::getDiaSemana($dataRetorno[0]) . ", " . $dataRetorno[0] . " " . $dataRetorno[1];
    }

    public static function getDataSimplificada($data) {

        $valor = self::getDiffData($data); //getDiaSemana($dataRetorno[0]).", ".$dataRetorno[0]." ".$dataRetorno[1];
        //entre segundo de publicação
        if ($valor >= 0 && $valor < 60) {
            return "hà " . $valor . (($valor <= 1) ? " segundo" : " segundos");
            //entre minutos de publicação
        } else if ($valor < 3600) {
            $valor = round($valor / 60);
            return "há " . $valor . (($valor <= 1) ? " minuto" : " minutos");
            //entre horas de publicação
        } else if ($valor < 3600) {
            $valor = round($valor / 60);
            return "hà " . $valor . (($valor <= 1) ? " hora" : " horas");
            //retorna a data completa    
        } else {
            $dataRetorno = self::dataBrHora($data);
            return self::getDiaSemana($dataRetorno[0]) . ", " . $dataRetorno[0] . " " . $dataRetorno[1];
        }
    }

    public static function getDiffData($data) {
        $dataInicio = strtotime($data);
        $dataAtual = time();
        return $dataAtual - $dataInicio;
    }

    public static function getDiaSemana($pData) {
        $data = explode("/", $pData);
        $data = getdate(mktime(0, 0, 0, $data[1], $data[0], $data[2]));
        $dias_semana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
        return $dias_semana[$data['wday']];
    }

    public static function getDiretorioThumbnail() {
        $v = sfProjectConfiguration::getActive();
        return $v->getRootDir() . "/web/assets/img/thumbnails";
    }
    
    public static function getDiretorioArquivosInstitucionais() {
        $v = sfProjectConfiguration::getActive();
        return $v->getRootDir() . "/web/arquivosInstitucionais";
    }
    
    public static function imprimeListaArquivos($lista){
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
        $string = "";
        foreach($lista as $item){
            
            
            $string .= "<tr>";
            $string .= "    <td>".($item['novo']?"<span class=\"label label-info\">Novo</span>":""). "<a href=\"/arquivosInstitucionais/".$item['arquivo']."\">".$item['nome']."</a></td>";
            $string .= "    <td>".$item['extensao']."</td>";
            $string .= "</tr>";
            
        }
        
        echo $string;
    }
    
    public static function getDiretorioFotosPublicacoes($idUsuario = null) {
        $v = sfProjectConfiguration::getActive();
        $dir = $v->getRootDir() . "/web/assets/img/publicacoes";
        
        if($idUsuario == null){
            return $dir;
        }
        
        return $dir."/".md5("usu_$idUsuario");        
    }
    
    public static function getLinkFotosPublicacoes($idUsuario = null) {
        $v = sfProjectConfiguration::getActive();
        $dir = "/assets/img/publicacoes";
        
        if($idUsuario == null){
            return $dir;
        }
        
        return $dir."/".md5("usu_$idUsuario");        
    }

    public static function criaSlug($slug) {
        $slug = trim($slug);
        $slug = strtolower($slug);
        
        $slug = str_replace(" ", "-", $slug);
        
        $retorno = "";

        foreach (explode(" ", $slug) as $parte) {
            if ($retorno == "") {
                $retorno = $parte;
            } else {
                $retorno .= "-" . $parte;
            }
        }

        return $retorno;
    }

    public static function imprimir($valor) {
        echo $valor;
    }

    public static function validaImagem($imagem, $tamanhoImagem, $tipoImagem = self::TIPO_IMAGEM_USUARIO) {
        if ($tipoImagem == self::TIPO_IMAGEM_USUARIO) {
            if (!isset($imagem) || $imagem == "") {
                switch ($tamanhoImagem) {
                    case Util::IMAGEM_GRANDE:
                        return "/assets/img/rl/_avatar-default-large.png";
                    case Util::IMAGEM_MEDIA:
                        return "/assets/img/rl/_avatar-default-60.png";
                    case Util::IMAGEM_MINIATURA:
                        return "/assets/img/rl/_avatar-default-20.png";
                }
            } else {
                switch ($tamanhoImagem) {
                    case Util::IMAGEM_GRANDE:
                        return "/assets/img/thumbnails/" . str_replace(array("#"), array("large"), $imagem);
                    case Util::IMAGEM_MEDIA:
                        return "/assets/img/thumbnails/" . str_replace(array("#"), array("60"), $imagem);
                    case Util::IMAGEM_MINIATURA:
                        return "/assets/img/thumbnails/" . str_replace(array("#"), array("20"), $imagem);
                }
            }
        } else if ($tipoImagem == self::TIPO_IMAGEM_CONTEUDO) {
            if (!isset($imagem) || $imagem == "") {
                switch ($tamanhoImagem) {
                    case Util::IMAGEM_GRANDE:
                        return "/assets/img/rl/170.gif";
                    case Util::IMAGEM_MEDIA:
                        return "/assets/img/rl/60.gif";
                    case Util::IMAGEM_MINIATURA:
                        return "/assets/img/rl/20.gif";
                }
            } else {
                switch ($tamanhoImagem) {
                    case Util::IMAGEM_GRANDE:
                        return "/assets/img/thumbnails/" . str_replace(array("#"), array("large"), $imagem);
                    case Util::IMAGEM_MEDIA:
                        return "/assets/img/thumbnails/" . str_replace(array("#"), array("60"), $imagem);
                    case Util::IMAGEM_MINIATURA:
                        return "/assets/img/thumbnails/" . str_replace(array("#"), array("20"), $imagem);
                }
            }
        }
        return $imagem;
    }

    /*
     * Get the title element from a URL
     * Author: Danny Battison
     * Contact: gabehabe@gmail.com
     */

    public static function getTitle($url) {
        // we can't treat it as an XML document because some sites aren't valid XHTML
        // so, we have to use the classic file reading functions and parse the page manually
        $fh = fopen($url, "r");
        $str = fread($fh, 7500);  // read the first 7500 characters, it's gonna be near the top
        fclose($fh);
        $str2 = strtolower($str);
        $start = strpos($str2, "<title>") + 7;
        
        if($start==7){
            return $url;
        }
        
        $len = strpos($str2, "</title>") - $start;
        return substr($str, $start, $len);
    }
    
    public static function getIdadeUsuario($data) {
    
        if (($data = strtotime($data)) === false) {return false;}
        for ($i = 0; strtotime("-$i year") > $data; ++$i);
        return $i - 1;
    }
    
    public static function getDataInformacao($data) {
        //22/01/2012 às 08h00
        $dataHora = self::dataBrHora($data);
        return $dataHora[0]." às ".str_replace(":", "h", $dataHora[1]);
    }
    
    public static function getNuvemTags($max = 48,$min = 10){
        /*
         max = 52px
         min = 10px
        <a href="conteudo.shtml" title="5 itens" style="font-size: 12.2611464968px;">LAME4</a>
         */
        $string = "";
        $cs = Doctrine::getTable("Conteudos")->getConteudosNuvemTag();
        
        
        $diff = $max - $min;
//        $maiorPts = $cs[0]->getPontos();
//        $menorPts = $cs[count($cs)-1]->getPontos();
        $total = 0;
        foreach($cs as $c){
            $total += $c->getPontos();
        }
        
        
        shuffle($cs);
        foreach($cs as $c){
           $string.= "<a href=\"".  url_for("conteudo/".self::criaSlug($c->getNome()))."\" title=\"".$c->getPontos()." ".(($c->getPontos()>0)?"itens":"item")."\" style=\"font-size: ".((($c->getPontos()/$total)*($diff))+$min)."px;\">".$c->getNome()."</a>&nbsp;&nbsp;";
        }
        
        return $string;
    }
    
    public static function enviarEmail($assunto, $texto, $email) {

        $mail = new PHPMailer();

        # send via SMTP
        $mail->IsSMTP();

        # setando o idioma
        $mail->SetLanguage("br");

        # setando a porta de smt a ser utilizada. Neste caso, a 587 que o GMail utiliza		
        $mail->SMTP_PORT = "587";

        # ajusto o tipo de comunicaÃ§Ã£o a ser utilizada, no caso, a TLS do GMail
        $mail->SMTPSecure = "false";

        # especifico o endereÃ§o do servidor smtp do GMail
        //$mail->Host = "smtp.gmail.com"; 
        $mail->Host = "smtp.mixtecnologia.com.br";
        
                
        # ativo a autenticaÃ§Ã£o SMTP, no caso do GMail, Ã© necessÃ¡rio
        $mail->SMTPAuth = true;

        # UsuÃ¡rio SMTP do GMail
        $mail->Username = "robolivre@mixtecnologia.com.br";

        # Senha do usuÃ¡rio SMTP do GMail
        $mail->Password = "r0Bm.3eFsP";

        $mail->From = "smtp@mixtecnologia.com.br";
        # coloque aqui o seu correio, para que a autenticaÃ§Ã£o nÃ£o barre a mensagem
        $mail->FromName = utf8_decode("Robolivre");

        # EndereÃ§o do destinatÃ¡rio
        $mail->AddAddress($email);

        # DefiniÃ§Ã£o de quebra de linha
        $mail->WordWrap = 50;

        # envio como HTML se 'true'
        $mail->IsHTML(true);
        $mail->Subject = $assunto;

        # "ConteÃºdo da mensagem HTML"
        $mail->Body = $texto;

        # "Para mensagens somente texto"
        $mail->AltBody = $texto;

        # Enviando
        if ($mail->Send())
            return true;
        else
            return false;
    }
    
    public static function getTokenAleatorio($l = 15) {
        $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $tmp = "";
        while (strlen($tmp) < $l) {
            $tmp .= $str{mt_rand(0, strlen($str))};
        }
        return $tmp;
    }
    
    public static function getAbsoluteUrl($url){
	$dir = url_for($url, true);
	return _compute_public_path($dir, sfConfig::get('sf_web_dir_name','web'),'png', true);

    }
}

?>
