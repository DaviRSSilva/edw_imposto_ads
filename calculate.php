<div>
	<?php 


		require_once('classes/Desconto.php');


		/**
			Definicoes das deduções segundo a tabela
		**/			
		//Retorna um array de chave e valor correspondendo a um item e se respectivo valor e porcentagem
		function valueAndDiscountsArray($salaryValue){
			$INSS = new INSS($salaryValue);
			$IR = new IR($salaryValue - $INSS->getDiscountValue());
			$discountsAndName[0] = $INSS;
			$discountsAndName[1] = $IR;


			return $discountsAndName;
		};

	?>
		<table style="margin-top: 10px; width: 100%" id="resultTable">
			<?php
				$salaryArray = valueAndDiscountsArray($salary);
				//Pega a array retornada e monta uma tabela;
				for($index = 0; $index < count($salaryArray); $index++){
						$value = $salaryArray[$index]; ?>
					<tr>
						<td><?php echo $value->getName();?></td>
						<td><?php echo $value->getPercentage()."%";?></td>
						<td><?php echo $value->getDiscountValue();?></td>
					</tr>						
			<?php }?>
		</table>
</div>