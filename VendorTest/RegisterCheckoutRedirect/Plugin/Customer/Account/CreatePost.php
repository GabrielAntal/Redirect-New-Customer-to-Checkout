<?php

declare(strict_types=1);

namespace VendorTest\RegisterCheckoutRedirect\Plugin\Customer\Account;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\UrlInterface;

class CreatePost
{
    /**
     * @var UrlInterface
     */
    protected $url;
    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;

    /**
     * @param UrlInterface $url
     * @param CheckoutSession $checkoutSession
     */
    public function __construct(
        UrlInterface    $url,
        CheckoutSession $checkoutSession
    )
    {
        $this->url = $url;
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * @param \Magento\Customer\Controller\Account\CreatePost $subject
     * @param $resultRedirect
     * @return mixed
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function afterExecute(
        \Magento\Customer\Controller\Account\CreatePost $subject,
                                                        $resultRedirect
    )
    {
        $quoteItems = $this->checkoutSession->getQuote()->getItems();
        if ($quoteItems > 0) {
            $resultRedirect->setUrl($this->url->getUrl('checkout/cart/index'));
        }
        return $resultRedirect;
    }
}
