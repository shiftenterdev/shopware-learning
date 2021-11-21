<?php
declare(strict_types=1);

namespace SedTestPlugin\Storefront\Page\Example;

use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Page\GenericPageLoaderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

class ExamplePageLoader
{

    /**
     * @var GenericPageLoaderInterface
     */
    private $genericPageLoader;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(
        GenericPageLoaderInterface $genericPageLoader,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->genericPageLoader = $genericPageLoader;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function load(Request $request, SalesChannelContext $context): ExamplePage
    {
        $page = $this->genericPageLoader->load($request, $context);
        $page = ExamplePage::createFrom($page);
        // Do additional stuff, e.g. load more data from repositories and add it to page
//        $page->setExampleData(...);
        $this->eventDispatcher->dispatch(
            new ExamplePageLoadedEvent($page, $context, $request)
        );
        return $page;
    }

}
