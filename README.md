#Captcha for Kohana 3.3

This is the Captcha library ported from Kohana 3.0.x to 3.3. Very little has changed API-wise, although there have been a few changes.

One significant change is that filenames are now Title Case to conform with the PSR-0 standard adopted in Kohana 3.3.

##Getting Started

Instantiate a captcha:

> $captcha = Captcha::instance();

Instantiate using your own config group (other than 'default'):

> $captcha = Captcha::instance('myconfig');

Render a captcha to Response object (somewhere in the controller action):

> $captcha->render($this->response);

or render captcha to HTML tag or plain text string (for 'math' and 'riddle' styles):

> $captcha->html();

Validate the captcha:

> Captcha::valid($_POST['captcha']);

##Captcha Styles

* alpha - Image based
* basic - Image based
* black - Image based
* math - Text based
* riddle - Text based
* word - Image based
