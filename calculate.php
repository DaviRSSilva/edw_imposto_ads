<div>
	<?php 
		//Retorna um array de chave e valor correspondendo a um item e se respectivo valor e porcentagem
		function valueAndDiscountsArray($salaryValue){

			$discountsAndName['INSS'] = calculateInss($salaryValue);
			$discountsAndName['IR'] = calculateIr($salaryValue);
			$discountsAndName['Salário Liquido']['value'] = $salaryValue - $discountsAndName['INSS']['value'] - $discountsAndName['IR']['value'];

			return $discountsAndName;
		};

		//Calcula quanto é o valor do INSS e qual a porcentagem
		function calculateInss($salaryValue){
			$valueAndPercentage['value']  = 10;
			$valueAndPercentage['percentage']  = '10%';

			return $valueAndPercentage; 
		};

		//Calcula quanto é o valor do Imposto de renda e qual a porcentagem
		function calculateIr($salaryValue){
			$valueAndPercentage['value']  = 10;
			$valueAndPercentage['percentage']  = '10%';

			return $valueAndPercentage;
		};
	?>
	<table>
		<table>
			<?php
				$salaryArray = valueAndDiscountsArray($salary);
				//Pega a array retornada e monta uma tabela;
				foreach ($salaryArray as $key => $value) { ?>
					<tr>
						<td><?php echo $key;?></td>
						<td><?php echo $value['value'];?></td>
						<td><?php if(array_key_exists('percentage', $value)){
										echo $value['percentage'];
								  }?>
						</td>
					</tr>						
			<?php }?>
		</table>
	</table>
</div>