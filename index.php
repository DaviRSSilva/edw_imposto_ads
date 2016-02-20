<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/resources/css/style.css">
	<title>Calculador de Impostos CLT</title>
    <style type="text/css">
        #inputTable{
            margin: 0 auto;
        }

        input{
            text-align: right;
        }
    </style>
</head>
<body>
    <div id="inputTable" class="centered"> 
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td>Insira seu salário:</td>
                    <td><input type="text" name="salary"   value="<?php echo $_POST['salary'];?>" placeholder="1000" align="right"></input></td>
                </tr>
                <tfoot>
                    <tr>
                        <td colspan="2"><input type="submit" style="float: right" value="Calcular"/></td>
                    </tr>
                </tfoot>
            </table>
        </form>
        <?php
            //Recupera o salario como dado de input pelo usuario
            $salary =  $_POST['salary'];
            if($salary!='') {        
                require_once('calculate.php');
            };  
        ?>
    </div>
   

</body>
</html>