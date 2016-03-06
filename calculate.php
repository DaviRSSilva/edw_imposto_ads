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
					<td><p style="text-align: left;"><font style="font-size: 140%;text-align: left;">Descontos</font></p></td>
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
						<td><font color="#595959"><b><?php echo $value->getName();?></font><b></td>
						<td><?php echo $value->getPercentage()."%";?></td>
						<td>
							<font color="#FF4B4B"><?php echo "R$".number_format($value->getDiscountValue(), 2, ',', '');?></font>
						</td>
					</tr>					
			<?php }?>
			</table>
		<table class='totalTable'>
			<tr>
				<td colspan="2">	
					Total de descontos
				</td>
				<td><font color="#FF4B4B"><?php echo "R$".number_format($totalDiscount, 2, ',', '');?></font></td>
				
			</tr>
			<tr>
				<td colspan="2">
				<b>
					Salário Liquido
					</b>
				</td>
				<td><font color="#558ED5" ><b><?php echo "R$".number_format($totalSalary, 2, ',', '');?></b></font></td>
				
			</tr>
		</table>
		<br>
</div>