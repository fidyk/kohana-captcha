<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Outputs the dynamic Captcha resource.
 * Usage: Call the Captcha controller from a view, e.g.
 *        <img src="<?php echo URL::site('captcha') ?>" />
 *        <?php echo Captcha::html() ?>
 *
 *
 * @package		Captcha
 * @subpackage	Controller_Captcha
 * @author		Sergey Fidyk
 * @author		Michael Lavers
 * @author		Kohana Team
 * @copyright	(c) 2008-2010 Kohana Team
 * @license		http://kohanaphp.com/license.html
 */
class Controller_Captcha extends Controller {

	/**
	 * Output the captcha challenge
	 *
	 * @param string $group Config group name
	 */
	public function action_index()
	{
		// Output the Captcha challenge resource (no html)
		// Pull the config group name from the URL
		$group = $this->request->param('group');
		try
		{
			$captcha = Captcha::instance($group);
		}
		catch (Kohana_Exception $e)
		{
			$this->response->status(404);
			$this->response->headers('Content-Type', 'text/plain');
			$this->response->body($e->text($e));
			return;
		}
		$captcha->render($this->response);
	}

} // End Captcha_Controller
