<?php
namespace Hyperdigital\HdStructureddata\Domain\Model\Structureddata;


class Organization extends AbstractData
{
    /**
     * Subtypes that only narrow the schema.org @type and add no properties of their
     * own. Subtypes that do add properties get their own class in Organization/.
     */
    const ALLOWED_SUBTYPES = [
        'LocalBusiness',
        'Store',
        'OnlineStore',
        'Hotel',
        'MedicalOrganization',
        'EducationalOrganization',
        'ProfessionalService',
    ];

    public function returnData()
    {
        $return = [];
        $return['@context'] = 'https://schema.org';
        $return['@type'] = 'Organization';
        if (in_array($this->originalRow['subtype'] ?? '', self::ALLOWED_SUBTYPES, true)) {
            $return['@type'] = $this->originalRow['subtype'];
        }
        $return['name'] = $this->originalRow['title'] ?? '';
        $return['telephone'] = $this->originalRow['telephone'] ?? '';
        if (!empty($this->originalRow['email'])) {
            $return['email'] = $this->originalRow['email'];
        }
        if (!empty($this->originalRow['vat_id'])) {
            $return['vatID'] = $this->originalRow['vat_id'];
        }
        if (!empty($this->originalRow['tax_id'])) {
            $return['taxID'] = $this->originalRow['tax_id'];
        }
        if (!empty($this->originalRow['legal_name'])) {
            $return['legalName'] = $this->originalRow['legal_name'];
        }
        if (!empty($this->originalRow['description'])) {
            $return['description'] = $this->originalRow['description'];
        }
        if (!empty($this->originalRow['price_range'])) {
            $return['priceRange'] = $this->originalRow['price_range'];
        }
        // founding_date is the dedicated column; date_published is kept as a fallback
        // so records created before it existed keep working.
        $founding = $this->originalRow['founding_date'] ?? null;
        if (empty($founding)) {
            $founding = $this->originalRow['date_published'] ?? null;
        }
        if (!empty($founding)) {
            $date = new \DateTime($founding);
            $return['foundingDate'] = $date->format('Y-m-d');
        }
        if (!is_null($this->originalRow['number_of_employees'] ?? null)) {
            $return['numberOfEmployees'] = [
                '@type' => 'QuantitativeValue',
                'value' => (int)$this->originalRow['number_of_employees']
            ];
        }
        if (!empty($this->originalRow['contact_points'])) {
            $contactPoints = $this->getContactPoints($this->originalRow['uid'], 'contact_points', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($contactPoints)) {
                $return['contactPoint'] = $contactPoints;
            }
        }
        if (!empty($this->originalRow['url'])) {
            $url = $this->getUrl($this->originalRow['url']);
            $return['url'] = $url;
        }
        if (!empty($this->originalRow['images'])) {
            $images = $this->getImages($this->originalRow['uid'], 'images', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($images)) {
                $return['image'] = $images;
            }
        }
        if (!empty($this->originalRow['logo'])) {
            $image = $this->getImages($this->originalRow['uid'], 'logo', 'tx_hdstructureddata_domain_model_structureddata', true);
            if (!empty($image)) {
                $return['logo'] = $image;
            }
        }
        if (!empty($this->originalRow['addresses'])) {
            $address = $this->getAddresses($this->originalRow['uid'], 'addresses', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($address)) {
                $return['address'] = $address;
            }
        }
        if (!empty($this->originalRow['opening_hours'])) {
            $openingHours = $this->getOpeningHours($this->originalRow['uid'], 'opening_hours', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($openingHours)) {
                $return['openingHoursSpecification'] = $openingHours;
            }
        }
        if (!empty($this->originalRow['geo'])) {
            $geo = $this->getGeo($this->originalRow['uid'], 'geo', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($geo)) {
                $return['geo'] = reset($geo);
            }
        }
        if (!empty($this->originalRow['sameas'])) {
            $sameas = $this->getSameas($this->originalRow['uid'], 'sameas', 'tx_hdstructureddata_domain_model_structureddata');
            if (!empty($sameas)) {
                $return['sameAs'] = $sameas;
            }
        }

        return $return;
    }
}
