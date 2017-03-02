<?php

class NumberHelper
{

	public function morph($n, $f1, $f2, $f5) {

		$n = abs(intval($n)) % 100;

		if ($n > 10 && $n < 20)
			return $f5;

		$n = $n % 10;

		if ($n > 1 && $n < 5)
			return $f2;

		if ($n == 1)
			return $f1;

		return $f5;

	}

    public function num2str($num) {

		$nul='ноль';

		$ten = [
			['','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'],
			['','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'],
		];

		$a20 = ['десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'];
		$tens = [ 2 => 'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто'];
		$hundred = ['','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот'];

		$unit = [

			['копейка' ,'копейки' ,'копеек',	 1],
			['рубль'   ,'рубля'   ,'рублей'     ,0],
			['тысяча'  ,'тысячи'  ,'тысяч'      ,1],
			['миллион' ,'миллиона','миллионов'  ,0],
			['миллиард','милиарда','миллиардов' ,0],

		];

		list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));

		$out = [];

		if (intval($rub) > 0) {

			foreach(str_split($rub, 3) as $uk => $v) {

				if (!intval($v))
					continue;

				$uk = sizeof($unit) - $uk - 1;
				$gender = $unit[$uk][3];

				list($i1, $i2, $i3) = array_map('intval',str_split($v,1));

				$out[] = $hundred[$i1];

				if ($i2 > 1)
					$out[]= $tens[$i2]. ' ' .$ten[$gender][$i3];
				else
					$out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3];

				if ($uk > 1)
					$out[]= $this->morph(
						$v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]
					);

			}
		}
		else
			$out[] = $nul;

		$out[] = $this->morph(
			intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]
		);

		$allrubles = trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
		
		$rubles = mb_substr( $allrubles, 0, -6, 'UTF-8' );
		$rubles = rtrim($rubles);
		
		return $rubles;

	}

}