<?php
//pegando a data de nascimento do formulario
$data = $_POST['dtNasc'];


$mes = substr($data, 5, 2);
$dia = substr($data, 8, 2);
$ano = substr($data, 0, 4);
$dtNasc = str_replace("-", "", $dia . '/' . $mes . '/' . $ano);


$xml = simplexml_load_file('C:\wamp64\www\Forum_Signo\signos.xml');


foreach ($xml->signo as $registro) {
    $dataInicialXml = $registro->dataInicio;
    $dataFinalXml = $registro->dataFim;
    $mesInicialXml = substr($dataInicialXml, 3, 2);
    $diaInicialXml = substr($dataInicialXml, 0, 2);
    $mesFinalXml = substr($dataFinalXml, 3, 2);
    $diaFinalXml = substr($dataFinalXml, 0, 2);


    if (($mes == $mesInicialXml && $dia >= $diaInicialXml) || 
        ($mes == $mesFinalXml && $dia <= $diaFinalXml)) {

        echo '
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="./signo.css" />
            </head>
            <body>
                <header>
                    <h1>Seu Signo é ' . $registro->signoNome . '</h1>
                    <p>Sua data de Nascimento: ' . $dtNasc . '</p> 
                    <img src="./imagens/' . $registro->signoNome . '.jpg" id="imgSigno" />
                    <h3> Período de : ' . $registro->dataInicio . ' até ' . $registro->dataFim . '</h3>                                       
                    <div id="descricao"><p> ' . $registro->descricao . '</p></div>  
                </header>             
                <footer id="rodape">Copyright &copy; 2022 - by Francisco Magalhães</footer>            
            </body>';
    }
}
