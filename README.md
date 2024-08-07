# HD Structured data
TYPO3 extension for handling Google structured data into your page.
## Initialization
- install the extension
- include static typoscript file (HD Structured data)
- go to edit page properties
- open tab "Structured data"
- add a new structured data item

## Existing structured data

### Article
Source: https://developers.google.com/search/docs/appearance/structured-data/article

### Course
Source: https://developers.google.com/search/docs/appearance/structured-data/course-info

### FAQ
Source: https://developers.google.com/search/docs/appearance/structured-data/faqpage

### Organization
Source: https://developers.google.com/search/docs/appearance/structured-data/organization

### Video
Source: https://developers.google.com/search/docs/appearance/structured-data/video

### Review
Source: https://developers.google.com/search/docs/appearance/structured-data/review-snippet

### Products
Source: https://developers.google.com/search/docs/appearance/structured-data/product

### Events
Source: https://developers.google.com/search/docs/appearance/structured-data/event

### Image
Source: https://developers.google.com/search/docs/appearance/structured-data/image-license-metadata
After installing this extension, a new ViewHelper with empty output is available for use in your Fluid templates: `{f:imageStructuredData(image: image, uri: 'https:\\www.web.com\fileadmin\img.jpg')}`. This ViewHelper integrates structured data for images across your TYPO3 website. The `image` parameter is used to pass the image object. If you need to provide an alternative URL instead of publicUrl, use the `uri` parameter (of type string).

#### Usage

To use the `imageStructuredData` ViewHelper, include it in your Fluid templates as follows:

```html
<f:image image="{image}" ...  />
<f:imageStructuredData(image: image) />
```

#### Possibility to attach already used Organization as organizer
Events should contain organizer. It's possible to attach already exiting organization over field "Pointer to already existing organizers" where is possible to choose different structured data entries, but only Organization type would be used in Frontend output.

## Possibility to use it on detail pages (news, products, etc.)

First add a field into database and TCA

_ext_tables.sql_
```sql
CREATE TABLE tx_news_domain_model_news (
    structured_data INT(11) DEFAULT 0 NOT NULL,
);
```

_Configuration/TCA/Overrides/tx_news_domain_model_news.php_
```php
$tempColumns = [
    'structured_data' => [
        'label' => 'Structured data',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_hdstructureddata_domain_model_structureddata',
            'foreign_field' => 'foreign_uid',
            'foreign_sortby' => 'sorting',
            'foreign_table_field' => 'tablename',
            'foreign_match_fields' => [
                'fieldname' => 'structured_data',
            ],
        ],
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns("tx_news_domain_model_news", $tempColumns, 1);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    '--div--;Structured Data, structured_data',
);
```

Then integrate the typoscript code.

_TypoScript_
```typo3_typoscript
[request && traverse(request.getQueryParams(), 'tx_news_pi1/news') > 0]
    # this part is not needed if default typoscript is used
    # page.headerData.90 = USER
    # page.headerData.90.userFunc = Hyperdigital\HdStructureddata\UserFunctions\StructuredDataPrint->printTags
    page.headerData.90 {
        tableName = tx_news_domain_model_news
        fieldName = structured_data
        parentUid = GP:tx_news_pi1|news
    }
[end]
```
