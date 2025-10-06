<?php
class Calculator {
    public function calc(...$args) {
        // Validate number of arguments
        if (count($args) !== 3) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }

        list($operator, $num1, $num2) = $args;

        // Validate operator
        if (!in_array($operator, ['+', '-', '*', '/'])) {
            return "<p>Cannot perform operation. Invalid operator. Use one of (+,-,*,/).</p>";
        }

        // Validate numbers
        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }

        // Convert to float for precision
        $num1 = (float)$num1;
        $num2 = (float)$num2;

        // Handle division by zero
        if ($operator === '/' && $num2 == 0) {
            return "<p>The calculation is $num1 / $num2. The answer is cannot divide a number by zero.</p>";
        }

        // Perform calculation
        switch ($operator) {
            case '+':
                $answer = $num1 + $num2;
                break;
            case '-':
                $answer = $num1 - $num2;
                break;
            case '*':
                $answer = $num1 * $num2;
                break;
            case '/':
                $answer = $num1 / $num2;
                break;
        }

        return "<p>The calculation is $num1 $operator $num2. The answer is $answer.</p>";
    }
}
?>
