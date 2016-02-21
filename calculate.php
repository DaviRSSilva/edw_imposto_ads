<div>
	<?php 

		/**
			Definicoes das deduções segundo a tabela
		**/	
		define('IR_DEDUCAO_A', 0);
		define('IR_DEDUCAO_B', 142.8);
		define('IR_DEDUCAO_C', 354.8);
		define('IR_DEDUCAO_D', 636.13);
		define('IR_DEDUCAO_E', 869.36);

		define('INSS_TETO', 5189.82);
		//Retorna um array de chave e valor correspondendo a um item e se respectivo valor e porcentagem
		function valueAndDiscountsArray($salaryValue){

			$discountsAndName['INSS'] = calculateInss($salaryValue);
			$discountsAndName['IR'] = calculateIr($salaryValue-$discountsAndName['INSS']['value']);
			$discountsAndName['Salário Liquido']['value'] = $salaryValue - $discountsAndName['INSS']['value'] - $discountsAndName['IR']['value'];

			return $discountsAndName;
		};

		//Calcula quanto é o valor do INSS e qual a porcentagem
		function calculateInss($salaryValue){

			if($salaryValue<=1556.94){
				$percentage = 8;
			}elseif ($salaryValue<=2594.92) {
				$percentage = 9;
			}elseif ($salaryValue<=4663.75) {
				$percentage = 11;
			}else{
				//TODO ta pendente isso, esperar o professor definir.
				$percentage = 'TETO';
			}			

			if($percentage=='TETO'){
				$value = INSS_TETO * 11/100;
			}else{
				$value = $salaryValue * ($percentage/100);
			}

			$valueAndPercentage['value']  = $value;
			$valueAndPercentage['percentage']  = $percentage;

			return $valueAndPercentage; 
		};

		//Calcula quanto é o valor do Imposto de renda e qual a porcentagem
		function calculateIr($salaryValue){

			if($salaryValue<=1903.98){
				$percentage = 0;
				$value = $salaryValue * ($percentage/100) - IR_DEDUCAO_A;
			}elseif($salaryValue<=2826.65){
				$percentage = 7.5;
				$value = $salaryValue * ($percentage/100) - IR_DEDUCAO_B;
			}elseif($salaryValue<=3751.05){
				$percentage = 15;
				$value = $salaryValue * ($percentage/100) - IR_DEDUCAO_C;
			}elseif ($salaryValue<=4664.68) {
				$percentage = 22.5;
				$value = $salaryValue * ($percentage/100) - IR_DEDUCAO_D;
			}else{
				$percentage = 27.5;
				$value = $salaryValue * ($percentage/100) - IR_DEDUCAO_E;
			}
			

			$valueAndPercentage['value']  = $value;
			$valueAndPercentage['percentage']  = $percentage;

			return $valueAndPercentage;
		};
	?>
		<table style="margin-top: 10px; width: 100%" id="resultTable">
			<?php
				$salaryArray = valueAndDiscountsArray($salary);
				//Pega a array retornada e monta uma tabela;
				foreach ($salaryArray as $key => $value) { ?>
					<tr>
						<td><?php echo $key;?></td>						
						<td><?php 
							if(array_key_exists('percentage', $value)){										
								if($value['percentage']=='0'){
									echo 'Isento';
								}elseif($value['percentage'] == 'TETO'){
									echo $value['percentage'];
								}else{
									echo $value['percentage'].'%';	
								}										
							}?>
						</td>
						<td><?php echo number_format((float)$value['value'], 2, '.', '');?></td>
					</tr>						
			<?php }?>
		</table>
</div>