<?php

/**
 * @file
 * Contains \Drupal\my_module\EventSubscriber\MyModuleRedirectSubscriber
 */

namespace Drupal\my_module\EventSubscriber;

use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MyModuleRedirectSubscriber implements EventSubscriberInterface {

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
        //Сообщает, на какие события вы хотите подписаться.
        // Нам нужен только запрос для этого примера. Pass
        // this
        return([
            KernelEvents::REQUEST => [
                ['redirectMyContentTypeNode'],
            ]
        ]);
    }

    /**
     *  Перенаправление запросов для подробных страниц узла my_content_type в node / 123.
     *
     * @param GetResponseEvent $event
     * @return void
     */
    public function redirectMyContentTypeNode(GetResponseEvent $event) {
        $request = $event->getRequest();

        if($request->getRequestUri() === '/'){
            $url = Url::fromRoute('entity.node.canonical', ['node' => 2], []);
            $response = new RedirectResponse($url->toString(), 301);
//            $event->setResponse($response);
//            kint($url->toString());
        }


        // This is necessary because this also gets called on
        // node sub-tabs such as "edit", "revisions", etc.  This
        // prevents those pages from redirected.
        if ($request->attributes->get('_route') !== 'entity.node.canonical') {
            return;
        }

        // Only redirect a certain content type.
        if ($request->attributes->get('node')->getType() !== 'my_content_type') {
            return;
        }

//        $url = Url::fromRoute('entity.node.canonical', ['node' => 2], []);
//        $response = new RedirectResponse($url->toString(), 301);
//        $event->setResponse($response);

//         This is where you set the destination.
        $redirect_url = Url::fromUri('entity:node/123');
        $response = new RedirectResponse($redirect_url->toString(), 301);
        $event->setResponse($response);
    }

}