<?php

declare(strict_types=1);

namespace SedTestPlugin\Storefront\Controller;

use SedTestPlugin\Storefront\Page\Example\ExamplePageLoader;
use Shopware\Core\Framework\Routing\Annotation\RouteScope;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Storefront\Controller\StorefrontController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @RouteScope(scopes={"storefront"})
 */
class ExampleController extends StorefrontController
{

    /**
     * @var ExamplePageLoader
     */
    private ExamplePageLoader $examplePageLoader;

    public function __construct(ExamplePageLoader $examplePageLoader)
    {
        $this->examplePageLoader = $examplePageLoader;
    }

    /**
     * @Route("/example", name="frontend.example.page", methods={"GET"})
     */
    public function examplePage(Request $request, SalesChannelContext $context): Response
    {
        $page = $this->examplePageLoader->load($request, $context);
        return $this->renderStorefront('@SedTestPlugin/storefront/page/example.html.twig', [
            'example' => 'Hello world',
            'page' => $page,
        ]);
    }

}
