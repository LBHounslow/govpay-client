## Hounslow GOV.UK Pay Client

This is a client for the [GOV.UK Payments API](https://www.payments.service.gov.uk) used by [London Borough of Hounslow](https://www.hounslow.gov.uk).

`composer require lb-hounslow/govpay-client`

Create your own [API key](https://docs.payments.service.gov.uk/quick_start_guide/#test-the-api) with [GOV.UK Pay](https://www.payments.service.gov.uk) and use this key in the [client](src/Client/Client.php). Their technical documentation is [here](https://docs.payments.service.gov.uk). You can also load their [OpenAPI JSON](https://raw.githubusercontent.com/alphagov/pay-publicapi/master/openapi/publicapi_spec.json) into [swagger editor](https://editor.swagger.io) to interact with their API.

For more on how to use this client, see [usage documentation](docs/USAGE.md)

### Releases

- These are covered in [the Changelog](docs/CHANGELOG.md)

### Requirements

- [PHP 7.4.2+](https://www.php.net/downloads.php)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org)

### Tests

Run `composer test`

```
Code Coverage Report:      
  2021-12-09 13:43:46      
                           
 Summary:                  
  Classes: 65.38% (17/26)  
  Methods: 87.61% (191/218)
  Lines:   90.76% (501/552)
```

### Contributing

This repository is currently closed for contribution. Please [report an an issue](https://github.com/LBHounslow/govpay-client/issues) if you come across one.
