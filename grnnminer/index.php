

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en-US" xml:lang="en-US">
    <head>
        <meta charset="UTF-8">


        <link href="./estilos.css" rel="stylesheet" type="text/css" /> <!-- AGREGO ARCHIVO CSS -->
        <title>GRNNminer</title>

        <script type="text/javascript" src="./library/dist/vis.js"></script> <!--AGREGO LIBRERIA PARA GRAFICAR NODOS --> 
        <link href="./library/dist/vis.css" rel="stylesheet" type="text/css" />

        
        <script type="text/javascript" src="./Jquery/jquery.min.js"></script>
        <script type="text/javascript" src="./Jquery/html2canvas.js"></script>
        <script type="text/javascript" src="./Jquery/cambiarPestanna.js"></script>
        
        <script type="text/javascript" src="./libFlot/jquery.js"></script><!--AGREGO LIBRERIA PARA GRAFICO LINEAL -->
        <script type="text/javascript" src="./libFlot/jquery.flot.js"></script>

        <!-- Importación de la librería de jquery. -->

        <script type="text/javascript">
            function resultadoOkData() {
                $("#respuestaData").html('<img src="./images/TildeBlanco.png" style="width:6%;height:18%;position: absolute;left:93%;top:21%;">');
            }
            function resultadoErroneoData() {
                $("#respuestaData").html('<img src="./images/CruzBlanca.png" style="width:6%;height:18%;position: absolute;left:93%;top:21%;">');
            }
            function resultadoOkTarget() {
                $("#respuestaTarget").html('<img src="./images/TildeBlanco.png" style="width:6%;height:20%;position: absolute;left:93%;top:20%; ">');
            }
            function resultadoErroneoTarget() {
                $("#respuestaTarget").html('<img src="./images/CruzBlanca.png" style="width:6%;height:20%;position: absolute;left:93%;top:20%; ">');
            }
            function resultadoOkGeneSim() {
                $("#respuestaGeneSim").html('<img src="./images/TildeBlanco.png" style="width:6%;height:19%;position: absolute;left:35%;top:0%; ">');
                $("#espera").hide();
            }
            function resultadoErroneoGeneSim() {
                $("#respuestaGeneSim").html('<img src="./images/CruzBlanca.png" style="width:6%;height:25%;position: absolute;left:33%;top:0%; ">');
            }
            function resultadoOkLabel() {
                $("#respuestaLabel").html('<img src="./images/TildeBlanco.png" style="width:6%;height:45%;position: absolute;left:93%;top:50%; ">');
            }
            function resultadoErroneoLabel() {
                $("#respuestaLabel").html('<img src="./images/CruzBlanca.png" style="width:6%;height:45%;position: absolute;left:93%;top:50%; ">');
            }
            function resultadoImportarParametros() {
                /*$("#respuestaExportParametros").html('<img src="./images/TildeBlanco.png" style="width:5.5%;height:5.5%;position: absolute;left:90%;top:72%; ">');*/
                $("#respuestaExportParametros").html('<img src="./images/TildeBlanco.png" style="width:5.5%;height:5.5%;position: absolute;left:25%;top:0%; ">');
            }
            function resultadoExportarParametros() {
                $("#respuestaExportParametros").html('<img src="./images/TildeBlanco.png" style="width:5.5%;height:5.5%;position: absolute;left:25%;top:0%; ">');
            }
            function resultadoNOExportarParametros() {
                $("#respuestaExportParametros").html();
            }
	    
            $(document).ready(function () {
                document.getElementById("pholder").innerHTML = "";
            });
            $(document).ready(function () {
		document.getElementById("espera2").innerHTML = '<img src="./images/wait.png"; style="position: absolute;top:33%; left: 43%;">';
                document.getElementById("espera2").innerHTML = "";
            });
        </script>
    </head>

    <body>
       <?php
        session_start();//Comienzo una sesion que me va a servir para identificar los archivos.?>
        <div id="mynetwork">
        <?php
            if (isset($_POST['botonSubmit'])) {
                echo '<img src="./images/wait.png"; style="position: absolute;top:20%; left: 35%;">';
                 
            }
        ?>
        </div>
        <div id="pholder">
        <?php
            if (isset($_POST['botonSubmit'])) {
                echo '<img src="./images/wait.png"; style="position: absolute;top:20%; left: 35%;">';
            }
        ?>
        
        </div>
        <div id="espera">
            
        </div>
	<div id="espera2">
            
        </div>
	<div id="respuestaData"></div>
	<div id="respuestaTarget"></div>
        <div id="respuestaGeneSim"></div> 
        <!-- Coloco el título de la página -->
        <div>
            <h1 align="center">GRNNminer</h1>

        </div>
        <form action="./ManualDeUsuario/Manual.pdf" style="position: absolute;left:1.5%;top:0.5%;">
            <input align="right" type="submit" name="botonManual" value="User Manual"/>
        </form>
        <form action="http://fich.unl.edu.ar/sinc/" style="position: absolute;right:1.8%;top:0.5%;">
            <input align="right" type="submit" name="botonAdmin" value="Administrator"/>
        </form>

        <?php
        $_SESSION['sesionId'] = session_id(); /* Guardo en esa variable global el id de session */
        $_SESSION['nameArchParameters'] = "./ParametrosExportados/" . $_SESSION['sesionId'] . "Parameters.txt";
        $_SESSION['nameArchGeneSim'] = "./DatosSimulados/" . $_SESSION['sesionId'] . "_Datos_Simulados.csv";
        $_SESSION['nameArchResults'] = "./Results/" . $_SESSION['sesionId'] . "Results.csv";
        $_SESSION['dataExample']="./Example/TrainExample.csv";
        ?>
        

    <?php                
        if (!isset($_POST['botonSubmit'])) {
            require_once('./RedEjemplo.php');
            $_SESSION['nameArchResults']="./Example/Example.csv";
	    $_SESSION['nameArchParameters']="./Example/Parameters.txt";
	    $_SESSION['nameArchGeneSim']="./Example/DatosSimulados.csv";
                        
        }
    ?>
    <?php                
        if (!isset($_POST['botonSubmit'])) {
            require_once('./LinealEjemplo.php');
        }
    ?>
    

        
        <!-- Coloco el título de la primer seccion -->
        <div class="contenedor">
            <form action=" " method="POST" enctype="multipart/form-data" target="contenedor_subir_archivo_data" style="margin-left: 1.8%;margin-top: -1%;">
            <div id="pestanas">
                <ul id=lista>
                    <li id="pestana1"><a href='javascript:cambiarPestanna(pestanas,pestana1);'>LOAD DATA</a></li>
                    <li id="pestana2"><a href='javascript:cambiarPestanna(pestanas,pestana2);'>SIMULATE AND LOAD</a></li>
                </ul>
            </div>
         <iframe width="1" height="1" frameborder="0" name="contenedor_subir_archivo_data" style="display: none"></iframe>
            </form>
         
                       
        <div id="contenidopestanas">
        <div class="optionData" id="optionData">
            <h4  align="left">Data </h4>
            <!-- Contenido de la primera seccion -->
            <form  action="" method="POST" enctype="multipart/form-data" target="contenedor_subir_archivo_data" style="margin-left: 1.8%;margin-top: -1%;">
                <input type="file" name="uploadData" id="uploadData" accept=".csv" lang="en-US" xml:lang="en-US" style="width:65.8%;"/> <!-- aca tmb valido el tipo de archivo-->
                <input type="submit" name="boton" value="Load Data" class="boton"/>
                <p></p>
                <a id="downloadDataExample" href="<?php echo $_SESSION['dataExample'] ?>" download="DataExample.csv">
                    Download Example DataSet
                </a>
                
                <iframe width="1" height="1" frameborder="0" name="contenedor_subir_archivo_data" style="display: none"></iframe>
            </form>
        <?php 
                require_once('./Data.php');
        ?>
        </div>


        <!-- Coloco el título de la cuarta seccion --> <!-- ESTO HAY Q VERLO BIEN LO DEL SIMULADOR-->
        <h3></h3><!--Espacio entre cuadro y cuadro-->
        <div class="optionSimulated" id="optionSimulated">
            <h4 align="left">Simulate Data </h4>
           
            <?php $_SESSION['nameArchTarget'] = $_SESSION['sesionId'] . "_Target.csv"; //guardo el nombre del archivo que cargo para luego poder usarlo, tengo que hacerlo aca para que no de error 
            ?>
            <!-- Contenido de la segunda seccion -->
            <form action=" " method="POST" enctype="multipart/form-data" target="contenedor_subir_archivo_data" style="margin-left: 1.8%;margin-top: -1%;">  <!-- Acá tendria q ver de llamar al simulador jeje o abajo en el submit -->
                <p></p>
                <p><input type="file" name="uploadTarget" id="uploadTarget" accept=".csv" style="width:63.8%;"/>
                    <input type="submit" name="botontarget" value="Load Target" /></p>
                 
                <p2>Time Stamps: <input type="text" name="instime" value="10" id="instime" size="7" required/> 
                    <img src="./images/iconopregunta.png" height=5% width=5%  align="top" style="margin-top:1%;" alt="texto alternativo" title="Timing of each gene." /></p2>
                <h2></h2>
                <input type="submit" name="botonGen" id="botonGen" value="Generate and Load" class="botonGen"/>
                <a id="downloadGenerados" href="<?php echo $_SESSION['nameArchGeneSim'] ?>" download="DatosGenerados.csv">
                    Download DataSet
                </a>
                
                
                <iframe width="1" height="1" frameborder="0" name="contenedor_subir_archivo_GeneSim" style="display: none"></iframe>
            </form>
          
        <?php    
            require_once('./Target.php'); 
        ?>
        <?php    
            require_once('./Simulated.php'); 
        ?> 
        </div>
        </div>
        
    </div>
        
    
            
        <!-- Coloco el título de la tercera seccion -->
        <h3></h3><!--Espacio entre cuadro y cuadro-->
        <div class="optionLabel" id="optionLabel">
            <h4 align="left">Label</h4>
            <!-- Componentes de la tercera seccion -->
            <form  action="" method="POST" enctype="multipart/form-data" target="contenedor_subir_archivo_data" style="margin-left: 1.8%;margin-top: -1.9%;line-height: 1em; font-size: 8pt">
                <input type="file" name="uploadLabel" id="uploadLabel" accept=".csv" style="width:64.8%;" />
                <input type="submit" name="botonlabel" value="Load Label" />
                <div id="respuestaLabel"></div>
                <iframe width="1" height="1" frameborder="0" name="contenedor_subir_archivo_label" style="display: none"></iframe>
            </form> 
        <?php    
            require_once('./Label.php'); 
        ?>   
        </div>
        
        <?php
        if (!isset($_POST['botonSubmit'])) {/* Con este if seteo los parámetros, ya sea de entrada o luego de cargar un archivo*/
            $_SESSION['Delta'] = 2;
            $_SESSION['Rep'] = 10;
            $_SESSION['HU'] = 5;
            $_SESSION['Epcs'] = 50;
            $_SESSION['NN'] = 'MLP';
            $_SESSION['threshold'] = 'on';
            $_SESSION['theta'] = 5;
            $_SESSION['simetric']='on';
            $_SESSION['unchained']='on';
        }
        else{
            $_SESSION['Delta'] = $_SESSION['DeltaT'];
            $_SESSION['Rep'] = $_SESSION['Repetitions'];
            $_SESSION['HU'] = $_SESSION['HiddenUnits'];
            $_SESSION['Epcs'] = $_SESSION['Epochs'];
            $_SESSION['NN'] = $_SESSION['NeuralNetwork']; 
        }
        ?>

        <!-- Coloco el título de la quinta seccion -->
        <h3></h3><!--Espacio entre cuadro y cuadro-->
        <div class="optionParameters" id="optionParameters">
            <h4 align="left">Parameters</h4><p></p>
            <!-- Contenido de la cuarta seccion -->
            <form action="" method="POST" enctype="multipart/form-data" target="contenedor_subir_archivo_data" style="margin-left: 1.8%;">
                <p2>Delta T: <input type="number" min="0" max="1000000" id="delta" name="delta"  value="<?php echo $_SESSION['Delta']; ?>" size="10"  required />
                    <img src="./images/iconopregunta.png" height=5% width=5%  align="top" alt="texto alternativo" style="margin-top:1%;" title="Temporal window to be considered" /></p2><p></p>
                <p2>Repetitions: <input type="number" min="0" max="1000000" name="rep" value="<?php echo $_SESSION['Rep']; ?>" size="10" required/>
                    <img src="./images/iconopregunta.png" height=5% width=5%  align="top" alt="texto alternativo" style="margin-top:1%;" title="Repetitions of each experiment." /></p2><p></p>
                
                <p2>NN Type:
                <select name="NN" id="NN">
                    <?php 
                    if($_SESSION['NN']==='MLP'){ 	 ?> <!-- if necesario para poder cambiar el select cuando cargo un archivo con parámetros-->
                    <option value="MLP" selected="selected">MLP</option>
                    <option value="ELM" >ELM</option></select>
                    <?php }
                    else{?>
                    <option value="MLP" >MLP</option>
                    <option value="ELM" selected="selected">ELM</option></select>           
                    <?php } ?>
                <img src="./images/iconopregunta.png" height=5% width=5%  align="top" alt="texto alternativo" style="margin-top:1%;" title="Neuronal network type for GRNNMiner." /></p2><p></p>
                <p2>Hidden Units: <input type="number" name="hu" min="0" max="1000000" value="<?php echo $_SESSION['HU']; ?>" size="10" required style="line-height: 0.2"/>
                    <img src="./images/iconopregunta.png" height=5% width=5%  align="top" alt="texto alternativo" style="margin-top:1%;" title="Percentage of inputs considered as number of hidden units." /></p2><p></p>
                <p2>Epochs: <input type="number" name="epcs" min="0" max="1000000" value="<?php echo $_SESSION['Epcs']; ?>" size="10" required style="line-height: 0.2"/>
                    <img src="./images/iconopregunta.png" height=5% width=5%  align="top" alt="texto alternativo" style="margin-top:1%;" title="Number of epochs used for training the neural networks." /></p2><p style="margin-top:7%"></p>

                    <h4 align="left">Rules</h4><p></p>
                <!-- if necesario para poder cambiar la rules THRESHOLD cuando cargo un archivo con parámetros-->
                <?php if($_SESSION['threshold']==='on'){ ?>
                    <p2><input name="thres"  type="checkbox" checked="checked"/><!-- con el campo checked lo tildo por defecto -->
                   Threshold &rarr; Theta: <input type="number" min="0" max="1000000" name="tita" value=<?php echo $_SESSION['theta'];?> size="10"/>
                <?php }
                    else{?>
                    <p2><input name="thres"  type="checkbox" /><!-- con el campo checked lo tildo por defecto -->
                   Threshold &rarr; Theta: <input type="number" min="0" max="1000000" name="tita" value="0" size="10"/>
                <?php } ?>
                    <img src="./images/iconopregunta.png" height=5% width=5%  align="top" style="margin-top:1%;" alt="texto alternativo" title="Threshold parameter for mining rules." /></p2><p></p>
                
                <!-- if necesario para poder cambiar la rules SIMETRIC cuando cargo un archivo con parámetros-->    
                <?php if($_SESSION['simetric']==='on'){ ?>
                    <p><input name="sim" type="checkbox" checked="checked" style="margin-top: -0.8%;"/> Simetric</p>
                <?php }
                    else{?>
                    <p><input name="sim" type="checkbox" style="margin-top: -0.8%;"/> Simetric</p>
                <?php } ?>
                
                <!-- if necesario para poder cambiar la rules UNCHAINED cuando cargo un archivo con parámetros-->    
                <?php if($_SESSION['unchained']==='on'){ ?>    
                   <p><input name="unch" type="checkbox" checked="checked" /> Unchained</p>
                <?php }
                    else{?>
                   <p><input name="unch" type="checkbox" /> Unchained</p>
                 <?php } ?>   
                    
                
                <input type="file" name="uploadParameters" id="uploadParameters" accept=".txt" style="width:66%;"/>
                <input type="submit" name="botonLoadParameters" id="botonLoadParameters" value="Load" />
                <h2></h2>
                <input type="submit" name="botonParameters" id="botonParameters" value="Save Parameters" />
                <a href="<?php echo $_SESSION['nameArchParameters'] ?>" download="Parametros.txt">
                    Download Parameters
                </a> 
               
            <?php    
                require_once('./Parameters.php'); 
            ?> 
            <?php    
                require_once('./ArchivosParam.php'); 
            ?>  
                <div id="respuestaExportParametros"></div>
                <iframe width="1" height="1" frameborder="0" name="contenedor_subir_archivo_param" style="display: none"></iframe>
            </form>
        </div>

        <!-- Coloco el título de la sexta seccion -->
        <h3></h3><!--Espacio entre cuadro y cuadro-->
        <div class="optionRules" id="optionRules">
            <form  action=""method="POST" enctype="multipart/form-data">
                <input type="submit" id="botonSubmit" name="botonSubmit" value="Go!" style="font-size: 100%; font-weight: bold;"/>
            </form>
        </div>
        

        <!--- COMIENZA LA PARTE DE LOS GRAFICOS -->
	<script type="text/javascript">
		$(document).ready(function () {
		    $("#botonSubmit").click(function () {
		        document.getElementById("mynetwork").innerHTML = '<img src="./images/wait.png"; style="position: absolute;top:20%; left: 35%;">';
			document.getElementById("pholder").innerHTML = '<img src="./images/wait.png"; style="position: absolute;top:20%; left: 35%;">';
		    });    
		});
        </script> 
        <?php
        if (isset($_POST['botonSubmit'])) {
                if (isset($_POST['botonSubmit'])): ?>
                    <?php if ($_SESSION['FlagParameters']): ?>
                        <script type="text/javascript">
                            parent.resultadoNOExportarParametros();
                        </script>
                    <?php else: ?>
                        <script type="text/javascript">
                           parent.location = "GuardeParametros.php";
                        </script>
                    <?php endif; ?>
                <?php else: ?>
                <?php endif;?> 
                        
            <?php if ($_SESSION['FlagSimu']): ?>                                       
            <script type="text/javascript">
                $("#optionData").hide();
            </script>
            <?php else: ?>
            <script type="text/javascript">
                $("#optionSimulated").hide();
            </script>
            <?php  endif;?> 
                        
                        
        <?php
            require_once('./Validaciones.php'); 
        ?>   
            <?php    
                require_once('./GraficoNodos.php'); 
            ?> 
            <?php    
                require_once('./GraficoLineal.php'); 
            ?> 
        
<?php } ?>
                        
    <?php if (isset($_POST['botonSubmit'])): ?>    
        <?php if ($_SESSION['FlagSimu']): ?>
            <body onload="javascript:cambiarPestanna(pestanas,pestana2);">
        <?php else: ?>
            <body onload="javascript:cambiarPestanna(pestanas,pestana1);">    
        <?php  endif;?> 
    <?php else: ?>
        <body onload="javascript:cambiarPestanna(pestanas,pestana1);">            
    <?php endif;?>
            
    </body>
</html>
