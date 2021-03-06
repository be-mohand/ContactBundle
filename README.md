Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require n-sens/contact-bundle "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new NS\ContactBundle\NSContactBundle(),
        );

        // ...
    }

    // ...
}
```

```bash
$ php app/console doctrine:schema:update --force
```

Step 3: Configuration
---------------------

```yaml
# config.yml

# NSContactBundle Configuration
ns_contact:
    subject: Message de contact
    emailto: mohand@n-sens.com
    sender_name: Application
    template: NSContactBundle:Emails:template.html.twig
    disable_delivery: false
    success_url: ns_contact
```

```yaml
# routing.yml

# NSContactBundle Routes
ns_contact:
    resource: "@NSContactBundle/Resources/config/routing.yml"
    prefix:   /
```