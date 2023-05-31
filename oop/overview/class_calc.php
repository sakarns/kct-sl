<?php
class Calculator
{
    private $num1, $num2, $calc;

    public function __construct($num1, $num2, $calc)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->calc = $calc;
    }

    public function calcMethod()
    {
        switch ($this->calc) {
            case 'add':
                $result = $this->num1 + $this->num2;
                break;
            case 'sub':
                $result = $this->num1 - $this->num2;
                break;
            case 'mul':
                $result = $this->num1 * $this->num2;
                break;
            default:
                break;
        }
        return $result;

    }
}
?>