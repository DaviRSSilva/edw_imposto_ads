<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="resources/css/style.css">
	<title>Calculador de Impostos CLT</title>
    
</head>
<body>
    
    <div id="inputTable" class="centered"> 
        <div class="title">
            <h2>CALCULADOR DE SALÁRIO LIQUIDO</h2>      
        </div>
        <form action="index.php" method="post">
           <div class="salaryInput">

                <p>
                    Salário bruto:
                    <input type="number"  class="shadowedDiv salary"name="salary" value="<?php echo $_POST['salary'];?>" placeholder="1000" align="right"></input>
                </p>
            </div>
        </form>
        <div class="shadowedDiv">
        <?php
            //Recupera o salario como dado de input pelo usuario
            if(isset($_POST['salary'])){
                 $salary = $_POST['salary'];
                 if($salary!='') {        
                    require_once('calculate.php');
                }
            };  
        ?>
        </div>
    </div>
   

</body>
</html>