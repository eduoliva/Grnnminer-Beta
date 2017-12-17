<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <script type="text/javascript">
        $(document).ready(function () {
            $("#botonGen").click(function () {
                $("#espera").show();
                document.getElementById("espera").innerHTML = '<img src="./images/loader.gif"; style="position: absolute;width:80%;height:100%;">';
		$('#NN > option[value="ELM"]').attr('selected', 'selected');
		$('#NN > option[value="MLP"]').attr('disabled', 'disabled');
            });    
        });
        </script>
        
        <?php
            if (isset($_POST['botonGen'])) {
                if (file_exists('./TargetCargadas/' . $_SESSION['nameArchTarget'])) {
                /* creo el archivo simulado con GeneSim */
                $flagTargetArchiLoad=true;
                $_SESSION['FlagSimu']=true;
                $MATLAB_Gene = "error_txt='';" . PHP_EOL;
                $MATLAB_Gene.="try" . PHP_EOL;
                $MATLAB_Gene.="input1='" . $_SESSION['nameArchTarget'] . "';" . PHP_EOL;
                $MATLAB_Gene.="input2=" . $_POST['instime'] . ";" . PHP_EOL;
                $MATLAB_Gene.="input3=1;" . PHP_EOL;
                $MATLAB_Gene.="input4='" . $_SESSION['sesionId'] . "';" . PHP_EOL;   /* paso la session_id para diferenciar el archivo */
                $MATLAB_Gene.="addpath('TargetCargadas')" . PHP_EOL;
                $MATLAB_Gene.="addpath('GeneSim')" . PHP_EOL;
                $MATLAB_Gene.="[output1]=fGeneSim(input1,input2,input3,input4);" . PHP_EOL;
                $MATLAB_Gene.="quit;" . PHP_EOL;
                $MATLAB_Gene.="end" . PHP_EOL;

                $filenameGene = "temp_gene.m";
                $fileGene = fopen($filenameGene, "w+");
                fwrite($fileGene, $MATLAB_Gene . PHP_EOL);
                fclose($fileGene);

                $origenPath2 = './run.sh temp_gene';
                exec($origenPath2, $res, $status);
                $_SESSION['nameArchData'] = $_SESSION['sesionId'] . "_Datos_Simulados.csv";
                
                }
                else{
                   $flagTargetArchiLoad=false;                    
                }
                
                ?>
                <?php if ($flagTargetArchiLoad): ?>

                <?php else: ?>
                    <script type="text/javascript">
                        parent.location = "./Validaciones/CargueArchivoTarget.php";
                    </script>
                <?php
                   endif;
                ?>    
    
    <?php if ($status == 127): ?>
                    <script type="text/javascript">
                        parent.resultadoErroneoGeneSim();
                    </script> 
    <?php else: ?>
                    <script type="text/javascript">
                        parent.resultadoOkGeneSim();
                        parent.resultadoOkData();
                    </script>
                    
    <?php
            endif;}
    ?>
    </body>
</html>
