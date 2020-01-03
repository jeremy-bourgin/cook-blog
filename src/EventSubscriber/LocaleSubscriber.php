<?php
namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
	const LANG_PARAM = 'lang';

	private $session;
	
	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}
	
	public function onKernelRequest(RequestEvent $event)
	{
        $request = $event->getRequest();
        $lang_selected = $request->getLocale();
        $query = $request->query;
        
		if ($query->has(self::LANG_PARAM))
		{
			$temp_lang = $query->get(self::LANG_PARAM);
			$langs = array(
				'fr',
				'en'
			);

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
	}
	
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => [['onKernelRequest', 20]]
        );
    }

}
