<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class OfferShippingDetails extends AbstractData
{
    public function returnData()
    {
        // No @context here: this object is always emitted as a nested node of a
        // parent object, which already carries the context.
        $return = [];

        $return['@type'] = 'OfferShippingDetails';

        if (!empty($this->originalRow['shipping_destination'])) {
            $countries = GeneralUtility::trimExplode(',', $this->originalRow['shipping_destination'], true);
            $return['shippingDestination'] = [];
            foreach ($countries as $country) {
                $return['shippingDestination'][] = [
                    '@type' => 'DefinedRegion',
                    'addressCountry' => strtoupper($country)
                ];
            }
        }

        if (!is_null($this->originalRow['shipping_rate'] ?? null)) {
            $rate = [
                '@type' => 'MonetaryAmount',
                'value' => $this->originalRow['shipping_rate']
            ];
            if (!empty($this->originalRow['shipping_currency'])) {
                $rate['currency'] = strtoupper($this->originalRow['shipping_currency']);
            }
            $return['shippingRate'] = $rate;
        }

        $deliveryTime = [];
        $handling = $this->quantitativeValue('handling_time_min', 'handling_time_max', 'DAY');
        if ($handling) {
            $deliveryTime['handlingTime'] = $handling;
        }
        $transit = $this->quantitativeValue('transit_time_min', 'transit_time_max', 'DAY');
        if ($transit) {
            $deliveryTime['transitTime'] = $transit;
        }
        if (!empty($deliveryTime)) {
            $return['deliveryTime'] = array_merge(['@type' => 'ShippingDeliveryTime'], $deliveryTime);
        }

        return $return;
    }
}
