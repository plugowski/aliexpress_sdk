<?php
namespace AliExpressSDK;

use AliExpressSDK\PromotionLink\PromotionLink;
use AliExpressSDK\PromotionLink\PromotionLinkCollection;
use AliExpressSDK\PromotionLink\PromotionLinksRequest;
use AliExpressSDK\PromotionProduct\PromotionProductRequest;

/**
 * Class AliExpressSDK
 * @package AliExpressSDK
 */
class AliExpress
{
    /**
     * @var AliExpressClient
     */
    private $aliExpressClient;

    /**
     * AliExpressSDK constructor.
     * @param AliExpressClient $aliExpressClient
     */
    public function __construct(AliExpressClient $aliExpressClient)
    {
        $this->aliExpressClient = $aliExpressClient;
    }

    /**
     * @param string $trackingId
     * @param array $urls
     * @return PromotionLinkCollection
     */
    public function getPromotionLinkCollection($trackingId, array $urls)
    {
        $request = (new PromotionLinksRequest())->setTrackingId($trackingId)->setUrls($urls);
        $response = $this->aliExpressClient->receive($request);

        $linkCollection = new PromotionLinkCollection();
        foreach ($response['promotionUrls'] as $urls) {
            $linkCollection->add(new PromotionLink($urls[0], $urls[1]));
        }

        return $linkCollection;
    }

    /**
     * @param string $trackingId
     * @param string $url
     * @return string
     */
    public function getPromotionLink($trackingId, $url)
    {
        return $this->getPromotionLinkCollection($trackingId, [$url])->getIterator()->current()->getPromotionUrl();
    }

    /**
     * @param int| string $keywordOrCategory
     * @param array $options
     */
    public function listPromotionProduct($keywordOrCategory, array $options = [])
    {
        $request = (new PromotionProductRequest());
        if (is_int($keywordOrCategory)) {
            $request->setCategoryId($keywordOrCategory);
        } else {
            $request->setKeywords($keywordOrCategory);
        }
        $request->setParams($options);

        $response = $this->aliExpressClient->receive($request);
    }
}