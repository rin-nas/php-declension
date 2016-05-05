<?php
/**
 * Склонение существительных и прилагательных с числительными
 *
 * @license  http://creativecommons.org/licenses/by-sa/3.0/
 * @author   https://github.com/rin-nas
 * @charset  UTF-8
 * @version  1.1.1
 */
class Declension
{
	#запрещаем создание экземпляра класса, вызов методов этого класса только статически!
	private function __construct() {}

	/**
	 * Склонение существительных с числительными.
	 * Метод умеет работать со словами, у которых только 2 формы склонения (например, в английском языке).
	 * В русском языке существительные с числительными могут быть в единственном,
	 * двойственном и множественном числе: один арбуз, два арбуза, пять арбузов.
	 * Двойственное число — это почти исчезнувшая в русском языке грамматическая конструкция, встречающаяся только в этом случае.
	 *
	 * Пример использования:
	 * echo 'В Вашем почтовом ящике <b>$n</b> ' . Declension::noun($n, 'письмо', 'письма', 'писем');
	 *
	 * @param   int|digit|null    $n      число
	 * @param   string            $form1
	 * @param   string            $form2
	 * @param   string|null       $form5
	 * @return  string|bool|null          Returns FALSE if error occurred
	 */
	public static function noun($n, $form1, $form2, $form5 = null)
	{
		if (! ReflectionTypeHint::isValid()) return false;
		if ($n === null) return null;

		$n = abs($n) % 100;
		if ($n > 4 && $n < 21) return $form5 ? $form5 : $form2;
		$n = $n % 10;
		if ($n > 1 && $n < 5) return $form2;
		if ($n == 1) return $form1;
		return $form5 ? $form5 : $form2;
	}

	/**
	 * Склонение прилагательных с числительными.
	 *
	 * @param   int|digit|null    $n      число
	 * @param   string            $form1  например: 'свежее'
	 * @param   string            $form2  например: 'свежих'
	 * @return  string|bool|null          Returns FALSE if error occurred
	 */
	public static function adjective($n, $form1, $form2) {
		if (! ReflectionTypeHint::isValid()) return false;
		if ($n === null) return null;

		$n = abs($n) % 100;
		if ($n == 11) return $form2;
		$n %= 10;
		if ($n == 1) return $form1;
		return $form2;
	}

}
