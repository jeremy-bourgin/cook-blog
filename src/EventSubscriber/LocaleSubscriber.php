<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use Twig\Environment;

class LocaleSubscriber implements EventSubscriberInterface
{
	const LANG_PARAM = 'lang';

	private $session;
	private $twig;
	
	public function __construct(SessionInterface $session, Environment $twig)
	{
		$this->session = $session;
		$this->twig = $twig;
	}
	
	public function onKernelRequest(RequestEvent $event)
	{
        $request = $event->getRequest();
        $lang_selected = $request->getLocale();
		$query = $request->query;
		
		$langs = array(
			'fr',
			'en'
		);
        
		if ($query->has(self::LANG_PARAM))
		{
			$temp_lang = $query->get(self::LANG_PARAM);

			if (in_array($temp_lang, $langs))
			{
				$lang_selected = $temp_lang;
				$this->session->set('_locale', $lang_selected);
			}
		}
		else if ($this->session->has('_locale'))
		{
			$lang_selected = $this->session->get('_locale');
		}

		$request->setLocale($lang_selected);

		$this->twig->addGlobal("global_langs", $langs);
	}
	
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => [['onKernelRequest', 20]]
        );
    }

}
