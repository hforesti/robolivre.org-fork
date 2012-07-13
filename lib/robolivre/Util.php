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
            return "há " . $valor . (($valor <= 1) ? " segundo" : " segundos");
            //entre minutos de publicação
        } else if ($valor < 3600) {
            $valor = round($valor / 60);
            return "há " . $valor . (($valor <= 1) ? " minuto" : " minutos");
            //entre horas de publicação
        } else if ($valor < 3600) {
            $valor = round($valor / 60);
            return "há " . $valor . (($valor <= 1) ? " hora" : " horas");
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

    public static function getDiretorioArquivosPublicacoesCientificas() {
        $v = sfProjectConfiguration::getActive();
        return $v->getRootDir() . "/web/arquivosPublicacoesCientificas";
    }

    public static function getDiretorioArquivosDownloadImprensa() {
        $v = sfProjectConfiguration::getActive();
        return $v->getRootDir() . "/web/arquivosDownloadImprensa";
    }

    public static function functionBubbleSortArquivos($items) {
        $temp = "";
        $size = count($items);

        for ($i = 1; $i < $size; $i++) {
            for ($j = 1; $j < $size - $i; $j++) {

                if ($items[$j + 1]['tempo'] < $items[$j]['tempo']) {

                    $temp = $items[$j];
                    $items[$j] = $items[$j + 1];
                    $items[$j + 1] = $temp;
                }
            }
        }

        return array_reverse($items);
    }

    private static function getArrayArquivosDiretorio($diretorio) {
        $itens = array();
        // abre o diretório
        $ponteiro = opendir($diretorio);
        // monta os vetores com os itens encontrados na pasta
        while ($nome_itens = readdir($ponteiro)) {
            if ($nome_itens != "." && $nome_itens != "..") {

                $tempo = filemtime($diretorio . "/" . $nome_itens);
                $path_parts = pathinfo($diretorio . "/" . $nome_itens);
                $array['tamanho'] = Util::getTamanhoArquivo($diretorio . "/" . $nome_itens);
                $array['nome'] = $path_parts['filename'];
                $array['extensao'] = $path_parts['extension'];
                $array['arquivo'] = $path_parts['basename'];
                $array['tempo'] = $tempo;
                //2592000 = 1 mes
                if ((microtime(true) - $tempo) <= 2592000) {
                    $array['novo'] = false;
                } else {
                    $array['novo'] = false;
                }
                $itens[] = $array;
            }
        }

        if (count($itens) > 1) {
            $itens = self::functionBubbleSortArquivos($itens);
        }


        return $itens;
    }

    public static function getNomeReduzido($nome, $quantidadeMaxima) {
        if (strlen($nome) > $quantidadeMaxima) {
            return substr($nome, 0, $quantidadeMaxima) . "&hellip;";
        } else {
            return $nome;
        }
    }

    public static function imprimeListaArquivos($pasta, $quantidadeArquivos = null) {
        if ($pasta[0] == '/') {
            $pasta = substr($pasta, 1);
        }
        $v = sfProjectConfiguration::getActive();
        $diretorio = $v->getRootDir() . "/web/" . $pasta;

        $lista = self::getArrayArquivosDiretorio($diretorio);

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
        $string = "";

        $arrayLista = array();

        if ($quantidadeArquivos == null) {
            $arrayLista = $lista;
        } else {
            $arrayLista = array_splice($lista, 0, $quantidadeArquivos);
        }

        foreach ($arrayLista as $item) {

            $nomeArquivo = self::getNomeReduzido($item['nome'], 40);
            $string .= "<tr>";
            $string .= "    <td>" . ($item['novo'] ? "<span class=\"label label-info\">Novo</span> " : "") . "<a target='_blank' href=\"/$pasta/" . $item['arquivo'] . "\">" . $nomeArquivo . "</a></td>";
            $string .= "    <td>" . strtoupper($item['extensao']) . "</td>";
            $string .= "    <td>" . strtoupper($item['tamanho']) . "</td>";
            $string .= "</tr>";
        }

        echo $string;
    }

    public static function getDiretorioFotosPublicacoes($idUsuario = null) {
        $v = sfProjectConfiguration::getActive();
        $dir = $v->getRootDir() . "/web/assets/img/publicacoes";

        if ($idUsuario == null) {
            return $dir;
        }

        return $dir . "/" . md5("usu_$idUsuario");
    }

    public static function getLinkFotosPublicacoes($idUsuario = null) {
        $v = sfProjectConfiguration::getActive();
        $dir = "/assets/img/publicacoes";

        if ($idUsuario == null) {
            return $dir;
        }

        return $dir . "/" . md5("usu_$idUsuario");
    }

    public static function removeAcento($str) {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return str_replace($a, $b, $str);
    }

    public static function criaSlug($str) {
        //echo "$str </br>";
        return (strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), self::removeAcento($str))));
    }

//    public static function criaSlug($slug) {
//        $slug = trim($slug);
//        $slug = strtolower($slug);
//
//        $slug = str_replace(" ", "-", $slug);
//
//        $slug = str_replace(" ", "-", $slug);
//
//        $retorno = "";
//
//        foreach (explode(" ", $slug) as $parte) {
//            if ($retorno == "") {
//                $retorno = $parte;
//            } else {
//                $retorno .= "-" . $parte;
//            }
//        }
//
//        return $retorno;
//    }

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
                        return "/assets/img/rl/_conteudo-default-large.png";
                    case Util::IMAGEM_MEDIA:
                        return "/assets/img/rl/_conteudo-default-60.png";
                    case Util::IMAGEM_MINIATURA:
                        return "/assets/img/rl/_conteudo-default-20.png";
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

    public static function formataLink($url) {
        if (strstr(substr($url, 0, 4), "http")) {
            return $url;
        } else {
            return "http://" . $url;
        }
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

        if ($start == 7) {
            return $url;
        }

        $len = strpos($str2, "</title>") - $start;
        return substr($str, $start, $len);
    }

    public static function getIdadeUsuario($data) {

        if (($data = strtotime($data)) === false) {
            return false;
        }
        for ($i = 0; strtotime("-$i year") > $data; ++$i)
            ;
        return $i - 1;
    }

    public static function getDataInformacao($data) {
        //22/01/2012 às 08h00
        $dataHora = self::dataBrHora($data);
        return $dataHora[0] . " às " . str_replace(":", "h", $dataHora[1]);
    }

    public static function getCheckboxesTemaAula($id = "") {
        $arrayRetorno = array();
        //<input type="checkbox" id="inlineCheckbox1" value="option1"> Robótica Definições e História - Robô na Ficção
        $ta = Doctrine::getTable("Conteudos")->getTemasAula($id);

        foreach ($ta as $c) {
            $arrayRetorno[] = "<input type=\"checkbox\" " . ($c->getTag() ? "checked=\"checked\"" : "") . " name=\"tema_aula[" . $c->getIdConjunto() . "]\" id=\"inlineCheckbox" . $c->getIdConjunto() . "\" value=\"" . $c->getIdConjunto() . Util::SEPARADOR_PARAMETRO . $c->getIdConteudo() . "\">" . $c->getNome();
        }

        return $arrayRetorno;
    }

    public static function getNuvemTags($max = 48, $min = 10) {
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
        foreach ($cs as $c) {
            $total += $c->getPontos();
        }


        shuffle($cs);
        foreach ($cs as $c) {
            $string.= "<a href=\"" . url_for("conteudo/" . self::criaSlug($c->getNome())) . "\" title=\"" . $c->getPontos() . " " . (($c->getPontos() > 0) ? "itens" : "item") . "\" style=\"font-size: " . ((($c->getPontos() / $total) * ($diff)) + $min) . "px;\">" . $c->getNome() . "</a>&nbsp;&nbsp;";
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

    public static function getAbsoluteUrl($url) {
        $dir = url_for($url, true);
        return _compute_public_path($dir, sfConfig::get('sf_web_dir_name', 'web'), 'png', true);
    }

    public static function getHtmlPurificado($entrada) {
        return strip_tags($entrada);
    }

    public static function getHtmlPurificadoDescricao($entrada) {

        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url', 'Tag'));

        $config = HTMLPurifier_Config::createDefault();

        $config->set('Core.Encoding', 'UTF-8');
        $config->set('HTML.Doctype', 'HTML 4.01 Transitional');
        $config->set('HTML.Allowed', 'p,b,a[href],i,strike,sup,sub,span[style],ul,ol,li,blockquote,br');
        $config->set('URI.Base', url_for(""));
        $config->set('URI.MakeAbsolute', true);
        $config->set('AutoFormat.AutoParagraph', true);
        $config->set('AutoFormat.Linkify', true);
        $config->set('AutoFormat.Linkify', true);
        $config->set('CSS.AllowedProperties', array('background-color'));
        $config->set('AutoFormat.RemoveSpansWithoutAttributes', true);
        $config->set('Cache.SerializerPath', '/home/maxguenes/GitHub/robolivre.org/lib/robolivre/htmlpurifier-4.4.0/library/HTMLPurifier/DefinitionCache/Serializer');

        $purifier = new HTMLPurifier($config);
        return $purifier->purify($entrada);
    }

    public static function getTextoEmailEsqueciSenha($urlComToken, $nomeUsuario) {
        return
                "   <div><br></div><div>Alguém solicitou que a sua senha fosse redefinida na seguinte conta:</div>
            <div><br></div>
            <div>Nome de usuário: $nomeUsuario</div>
            <div><br></div>
            <div>Se for um mal entendido, apenas ignore este email e nada será alterado.</div>
            <div><br></div>
            <div>Para seguir em frente e redefinir a senha, visite o seguinte endereço:</div>
            <div>$urlComToken</div>
            <div><br></div>
            <div>Obrigado,</div>
            <div>Ethnos - O robô de perfil e cadastro</div>";
    }
    
    public static function getTextoEmailMigracao($urlComToken, $nomeUsuario) {
        return
                "   <div><br></div><div>Olá $nomeUsuario,</div>
            <div>A robolivre.org está com uma nova versão mais simples e fácil de usar. 
                    Para que você possa compartilhar e acompanhar temas da robótica livre, 
                    sem necessidade da criação de um novo cadastro, precisamos que você 
                    redefina a sua senha acessando o link a seguir:</div>
            <div>$urlComToken</div>
            <div><br></div>
            <div>Com dois passos simples, você irá migrar seu perfil da nossa rede antiga para a nova em folha.</div>
            <div>Tem dúvidas? Entre em contato: http://robolivre.org/contato</div>
            <div><br></div>
            <div>Muito obrigada,</div>
            <div>Equipe Robô Livre</div>";
    }

    public static function getTextoEmailReportarErro($mensagem, $nomeUsuario, $email, $mensagemSisetma = null) {
        $string =
                "   <div><br></div>
            <div>Reportaram um erro:</div>
            <div>Nome: $nomeUsuario</div>
            <div>Email: $email</div>
            <div><br></div>
            <div>Mensagem: $mensagem</div>
            <div><br></div>";

        if ($mensagemSisetma != null) {
            $string.="<div>Mensagem do Sistema: $mensagemSisetma</div>
                <div><br></div>
                ";
        }

        return $string;
    }

    public static function getEmailContato() {
        return "cisneiros.work@gmail.com";
    }

    public static function getTempoDocumento($documento) {
        $criacao = date("Y-m-d H:i:s", filemtime($documento));
        return Util::getDataSimplificada($criacao);
    }

    public static function getTamanhoArquivo($arquivo) {
        $tamanho = filesize($arquivo); //number_format($tamanho/pow(1024,2),2)." MB";
        if ($tamanho < 1024) {
            $tamanho = $tamanho . ' B';
        } elseif ($tamanho < 1048576) {
            $tamanho = round($tamanho / 1024, 2) . ' KB';
        } elseif ($tamanho < 1073741824) {
            $tamanho = round($tamanho / 1048576, 2) . ' MB';
        } else {
            $tamanho = round($tamanho / 1073741824, 2) . ' GB';
        }
        return $tamanho;
    }
    
    public static function trataNomeDocumento($documento){
        $partes = explode(".", $documento);
        $extensao = array_pop($partes);
        $partes = explode("_".UsuarioLogado::getInstancia()->getIdUsuario()."_", $partes[0]);
        return $partes[0].".".$extensao;
    }

}

?>
