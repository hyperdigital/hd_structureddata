<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;

class MerchantReturnPolicy extends AbstractData
{
    public function returnData()
    {
        // No @context here: this object is always emitted as a nested node of a
        // parent object, which already carries the context.
        $return = [];

        $return['@type'] = 'MerchantReturnPolicy';

        if (!empty($this->originalRow['return_policy_category'])) {
            $return['returnPolicyCategory'] = 'https://schema.org/' . $this->originalRow['return_policy_category'];
        }
        if (!is_null($this->originalRow['merchant_return_days'] ?? null)) {
            $return['merchantReturnDays'] = (int)$this->originalRow['merchant_return_days'];
        }
        if (!empty($this->originalRow['return_method'])) {
            $return['returnMethod'] = 'https://schema.org/' . $this->originalRow['return_method'];
        }
        if (!empty($this->originalRow['return_fees'])) {
            $return['returnFees'] = 'https://schema.org/' . $this->originalRow['return_fees'];
        }
        if (!empty($this->originalRow['return_country'])) {
            $return['applicableCountry'] = strtoupper($this->originalRow['return_country']);
        }

        return $return;
    }
}
