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
		
		<table class='discountsTable'>
			<thead>
				<tr>
					<td>Descontos</td>
					<td/>
					<td>Valor</td>
				</tr>
			</thead>
			<?php
				$salaryArray = valueAndDiscountsArray($salary);
				$totalSalary = $salary;
				$totalDiscount = 0;
				//Pega a array retornada e monta uma tabela;
				for($index = 0; $index < count($salaryArray); $index++){
						$value = $salaryArray[$index]; 
						$totalSalary -= $value->getDiscountValue(); 
						$totalDiscount += $value->getDiscountValue()?>
					<tr>
						<td><?php echo $value->getName();?></td>
						<td><?php echo $value->getPercentage()."%";?></td>
						<td><?php echo "R$".number_format($value->getDiscountValue(), 2, ',', '');?></td>
					</tr>					
			<?php }?>
			</table>
			<table class='totalTable'>
			<tr>

				<td>
					Total de descontos
				</td>
				<td/>
				<td><?php echo "R$".number_format($totalDiscount, 2, ',', '');?></td>
				
			</tr>
			<tr>

				<td>
					Salário Liquido
				</td>
				<td/>
				<td><?php echo "R$".number_format($totalSalary, 2, ',', '');?></td>
				
			</tr>
			</tfoot>
		</table>
</div>