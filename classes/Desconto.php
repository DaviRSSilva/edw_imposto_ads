<?php

/**
	Classe genenrica de desconto
**/
class Desconto{

	public $name;
	public $currentValue;
	public $currentDiscount;
	public $currentPecentage = NULL;

	public  static $discountsAndValues;

	public function __construct($name){
		//define o nome do imposto a partir do construtor
		$this->name = $name;
	}

	public function calculate($value){
		$this->currentValue = $value;
		//Encontra o intervalo que corresponde ao valor atual
		foreach ($this->discountsAndValues as $key => $discountAndValue) {
			if($value <= $discountAndValue->getMaxValue()){
				$this->currentDiscount = $discountAndValue->calculateValue($value);
				$this->currentPecentage = $discountAndValue->getAssociatedPercentage();
				return $this->currentDiscount;
			}
		}

	}

	public function getPercentage(){
		return $this->currentPecentage;
	}

	public function getDiscountName(){
		return $this->$name;
	}

	public function getDiscountValue(){
		return $this->currentDiscount;
	}

	public function getName(){
		return $this->name;
	}
}
/**
	Classe do INSS com seus limites e porcentagens
**/
class INSS extends Desconto{


	public function __construct($salaryValue){		
		parent::__construct("INSS");
		$this->discountsAndValues[0] = new DiscountAndValue(8, 1556.94, 0);
		$this->discountsAndValues[1] = new DiscountAndValue(9, 2594.92, 0);
		$this->discountsAndValues[2] = new DiscountAndValue(11, PHP_INT_MAX, 0);
		parent::calculate($salaryValue);
	}

}
/**
	Classe do IR com seus limites e porcentagens e Deducao
**/
class IR extends Desconto{


	public function __construct($salaryValue){		
		parent::__construct("IR");
		define('IR_DEDUCAO_A', 0);
		define('IR_DEDUCAO_B', 142.8);
		define('IR_DEDUCAO_C', 354.8);
		define('IR_DEDUCAO_D', 636.13);
		define('IR_DEDUCAO_E', 869.36);
		$this->discountsAndValues[0] = new DiscountAndValue(0, 1903.98, IR_DEDUCAO_A);
		$this->discountsAndValues[1] = new DiscountAndValue(7.5, 2826.65, IR_DEDUCAO_B);
		$this->discountsAndValues[2] = new DiscountAndValue(15, 3751.05, IR_DEDUCAO_C);
		$this->discountsAndValues[3] = new DiscountAndValue(22.5, 4664.68, IR_DEDUCAO_D);
		$this->discountsAndValues[4] = new DiscountAndValue(27.5, PHP_INT_MAX, IR_DEDUCAO_E);
		$this->calculate($salaryValue);
	}	
}

class DiscountAndValue{

		public $percentage;
		public $salaryValue;
		public $deduction;

		public function __construct($percentage, $maxSalaryValue, $deduction){
			$this->percentage = $percentage;
			$this->salaryValue = $maxSalaryValue;
			$this->deduction = $deduction;
		}

		public function getMaxValue(){
			return $this->salaryValue;
		}

		public function getAssociatedPercentage(){
			return $this->percentage;
		}

		public function calculateValue($value){
			return ($value * ($this->percentage/100) - $this->deduction);
		}

}


?>