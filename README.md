# Biscotto, GDPR cookie managerfor Laravel

### features

- Cookie list to disable
- Scripts and iframes or anything with src can be disable using this package
- All define using config variables
- Lightweight pure vanilia javascript

### How  to use ?

Note that in this exemple you need to first load your Analytics instead of using src add data-src this will prevent you script to call google from example after you next step you need to add a id so in the cookie package now what to enable or disable those id can be change in the config variable biscotto.php.

Example 1

```php
<x-biscotto::biscotto>
<!-- Global site tag (gtag.js) - Google Analytics -->
 <script async
  id="script_cookie_statstics" // The id that comes from the config file
  data-src="https://www.googletagmanager.com/gtag/js?id=UA-152696431-2"
 ></script>
  <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());
     gtag('config', 'UA-152696431-2');
 </script>
</x-biscotto::biscotto>
```

Example 2

```
<x-biscotto::biscotto>
</x-biscotto::biscotto>

// Iframe example Note the dara-src and the id they are required
<iframe width="560" height="315" id="script_cookie_functional" data-src="https://www.youtube.com/embed/zckH4xalOns" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
```



### Scripts Info

Note that scripts and iframes don,t need to go inside the <x-biscotto::biscotto> component you can add in any where in the site because we use the dom so if you have the right tag it will find and enable the script same works for iframe example, note the dara-src and the id.

```html
<iframe width="560" height="315" id="script_cookie_statstics" data-src="https://www.youtube.com/embed/zckH4xalOns" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
```

### How disable unwanted cookies

There is no way to make this process automatic and effective but you can enable the debug mode in the config variable with that enable it will display for you all the website cookies in you console them based in the names you change the biscotto.php config file and add the cookie you wish to disable if the customer disable the option see the example.

```php
    /*
    |--------------------------------------------------------------------------
    | Cookie you wish to remove if the user don't allow them
    |--------------------------------------------------------------------------
    |
    | If you know the cookies name you wish to remove
    | Once the user don't allow, if you don't know the cookie you can setup
    | The varaible test mode to true it will show all the cookie inf you browser
    |
    */
    // Example
    'cookie_functional' => [
		'example','another'
    ],
    'cookie_statstics' => [
        '_ga','_gid','_gat_gtag_UA_124396431_2'
    ],
    'cookie_marketing' => [
		'example','another'
    ],
```

### Custom message

You can also customize the message and the link for the cookie popup inside the config files.

## Notice

The legislation is pretty very vague on how to display the warning,  which texts are necessary, and what options you need to provide. This  package will go a long way towards compliance, but if you want to be  100% sure that your website is ok, you should consult a legal expert.
