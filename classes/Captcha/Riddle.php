<?php defined('SYSPATH') OR die('No direct access.');
/**
 * Riddle captcha class.
 *
 * @package		Captcha
 * @subpackage	Captcha_Riddle
 * @author		Michael Lavers
 * @author		Kohana Team
 * @copyright	(c) 2008-2010 Kohana Team
 * @license		http://kohanaphp.com/license.html
 */
class Captcha_Riddle extends Captcha
{
	/**
	 * Generates a new Captcha challenge.
	 *
	 * @return string The challenge answer
	 */
	public function generate_challenge()
	{
		// Load riddles from the current config
		$riddles = self::_get_config(Captcha::$config['group'].'.riddles');

		if (empty($riddles))
		{
			// Load riddles from the captcha config
			$riddles = self::_get_config('riddles');
		}

		if (empty($riddles))
		{
			throw new Kohana_Exception('Captcha riddles not found');
		}

		// Pick a random riddle
		$riddle = $riddles[array_rand($riddles)];

		// Store the question for output
		$this->challenge = $riddle[0];
		// Store answer
		$this->answer = (string) $riddle[1];

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

} // End Captcha Riddle Driver Class