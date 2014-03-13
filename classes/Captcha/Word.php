<?php defined('SYSPATH') OR die('No direct access.');
/**
 * Word captcha class.
 *
 * @package		Captcha
 * @subpackage	Captcha_Word
 * @author		Michael Lavers
 * @author		Kohana Team
 * @copyright	(c) 2008-2010 Kohana Team
 * @license		http://kohanaphp.com/license.html
 */
class Captcha_Word extends Captcha_Basic
{
	/**
	 * Generates a new Captcha challenge.
	 *
	 * @return string The challenge answer
	 */
	public function generate_challenge()
	{
		// Load words from the current config
		$words = self::_get_config(Captcha::$config['group'].'.words');

		if (empty($words))
		{
			// Load words from the captcha config
			$words = self::_get_config('words');
		}

		if (empty($words))
		{
			throw new Kohana_Exception('Captcha words not found');
		}

		// Randomize words
		shuffle($words);

		$challenge = NULL;

		// Loop over each word...
		foreach ($words as $word)
		{
			// ...until we find one of the desired length
			if (abs(Captcha::$config['complexity'] - strlen($word)) < 2)
			{
				$challenge = $word;
				break;
			}
		}

		if ($challenge === NULL)
		{
			// Use any random word as final fallback
			$challenge = $words[array_rand($words)];
		}

		$this->challenge = $this->answer = UTF8::strtoupper($challenge);

		return $this->answer;
	}

} // End Captcha Word Driver Class