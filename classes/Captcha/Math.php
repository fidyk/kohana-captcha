<?php defined('SYSPATH') OR die('No direct access.');
/**
 * Math captcha class.
 *
 * @package		Captcha
 * @subpackage	Captcha_Math
 * @author		Michael Lavers
 * @author		Kohana Team
 * @copyright  (c) 2008-2010 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Captcha_Math extends Captcha
{
	/**
	 * Generates a new Captcha challenge.
	 *
	 * @return string The challenge answer
	 */
	public function generate_challenge()
	{
		// Easy
		if (Captcha::$config['complexity'] < 4)
		{
			$numbers[] = mt_rand(1, 5);
			$numbers[] = mt_rand(1, 4);
		}
		// Normal
		elseif (Captcha::$config['complexity'] < 7)
		{
			$numbers[] = mt_rand(10, 20);
			$numbers[] = mt_rand(1, 10);
		}
		// Difficult, well, not really ;)
		else
		{
			$numbers[] = mt_rand(100, 200);
			$numbers[] = mt_rand(10, 20);
			$numbers[] = mt_rand(1, 10);
		}

		// Store the question for output
		$this->challenge = implode(' + ', $numbers).' = ';

		// Calc sum for answer
		$this->answer = array_sum($numbers);

		// Return the answer
		return $this->answer;
	}

	/**
	 * Returns the HTML element.
	 *
	 * @return string
	 */
	public function html()
	{
		// Output challenge
		return $this->challenge;
	}

	/**
	 * Outputs the Captcha.
	 *
	 * @param Response
	 * @return void
	 */
	public function fill_response(Response $response)
	{
		$this->text_response($response);
	}

} // End Captcha Math Driver Class