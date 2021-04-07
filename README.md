![image info](https://raw.githubusercontent.com/mariojgt/biscotto/master/Publish/Public/image/biscotto.png)

# Biscotto
This Laravel packages contain a very simple structure for any kind of packages development for Laravel.

# Features

- [ ] Clean and basic start point in Laravel package development.
- [ ] Webpack setup with tailwind css ,sweetalert2 and vue3 basic setup.
- [ ] Simple out of the box Laravel Authentication.
- [ ] Example Laravel components, and layout structure.
- [ ] Tailwind with npm presetup for runing with packages.
- [ ] Republish command
- [ ] Reusable laravel layout
- [ ] Dynamic form
- [ ] Lightweight
- [ ] Dark|light mode out of the box

# Installation

You have 2 options.

### First option via composer

1. composer require mariojgt/biscotto
2. php artsain vendor:publish --force  (select the package number)

### Second Option gitclone (Recommended if you like to change and make to your own)

1. git clone https://github.com/mariojgt/biscotto

2. Setup you composer to use local VCS

3. ```javascript
   <x-biscotto::biscotto>

    <x-slot name="cookie_necessary">
        necessary
    </x-slot>

    <x-slot name="cookie_functional">
        functional
    </x-slot>

    <x-slot name="cookie_statstics">
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152696431-2"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-152696431-2');
        </script>

    </x-slot>

    <x-slot name="cookie_marketing">
        marketing
    </x-slot>

</x-biscotto::biscotto>
   ```

4. php artsain vendor:publish --force  (select the package number)

## Command Republish

The following commands

```php
php artisan republish:biscotto
```

Will move you changes in your resources like the js or css back to the packages useful to speed up development.

# Packages info

This package purpose is to give a fresh start for a new package so you can use those premade tools or just delete and use the package biscotto.
# Easy way to install

```php
php artisan install:biscotto
```
