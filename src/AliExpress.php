<?php
namespace AliExpressSDK;

use AliExpressSDK\PromotionLink\PromotionLink;
use AliExpressSDK\PromotionLink\PromotionLinkCollection;
use AliExpressSDK\PromotionLink\PromotionLinksRequest;
use AliExpressSDK\PromotionProduct\PromotionProduct;
use AliExpressSDK\PromotionProduct\PromotionProductCollection;
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
     * @return PromotionProductCollection
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

        $promotionProductCollection = new PromotionProductCollection();
        foreach ($response->products as $product) {
            $promotionProduct = new PromotionProduct(
                $product->{Request::FIELD_PRODUCT_ID},
                $product->{Request::FIELD_PRODUCT_TITLE},
                $product->{Request::FIELD_PRODUCT_URL},
                $product->{Request::FIELD_IMAGE_URL},
                $product->{Request::FIELD_VOLUME},
                $product->{Request::FIELD_PACKAGE_TYPE},
                $product->{Request::FIELD_LOT_NUM},
                $product->{Request::FIELD_VALID_TIME},
                new ProductPrice(
                    $product->{Request::FIELD_LOCAL_PRICE},
                    $product->{Request::FIELD_ORIGINAL_PRICE},
                    $product->{Request::FIELD_SALE_PRICE},
                    $product->{Request::FIELD_DISCOUNT},
                    $product->{Request::FIELD_EVALUATE_SCORE},
                    $product->{Request::FIELD_COMMISSION},
                    $product->{Request::FIELD_COMMISSION_RATE},
                    $product->{Request::FIELD_30_DAYS_COMMISSION}
                )
            );
            $promotionProductCollection->add($promotionProduct);
        }

        return $promotionProductCollection;
    }
}