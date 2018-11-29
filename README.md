PlatBox - PHP SDK
========================================

You can use SDK for generating iframe payment page and handling callbacks from Platbox. 

See [https://platbox.com/](https://platbox.com/) and [https://api.platbox.com/](https://api.platbox.com/) for more information and documentation.


Installation
--------------------
Use composer to manage your dependencies and download these libraries

```bash
composer require platbox/sdk-php
```


Examples
--------------------
- [Generate link to payment form](example/IFrame.php)
- [Handle check callback](example/CheckCallbackHandler.php)
- [Handle pay callback](example/PayCallbackHandler.php)
- [Handle cancel callback](example/CancelCallbackHandler.php)
- [Samples of handling callback with bad input parameters](example/FailureCallbackHandler.php)
