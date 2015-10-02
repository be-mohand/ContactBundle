Installation
============

Prerequisites
-------------

Before you're able to use this bundle you must sign up with Mandrill.

http://mandrill.com

Mandrill is a great way to send your transactional emails and provides detailed advances reports.

Mandrill is free for limited number of email per day, please read through pricing section on the website for more information:

http://mandrill.com/pricing/

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
            new Hip\MandrillBundle\HipMandrillBundle(),
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

# Mandrill configuration
hip_mandrill:
    api_key: xxxxxxxxxxx
    disable_delivery: false
    default:
        sender: Application Name
        sender_name: your Email

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