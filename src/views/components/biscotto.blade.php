<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .cookie-container {
        position: fixed;
        left: 0;
        bottom: 0;
        right: 0;
    }

    .cookie-card {
        padding: 1.2rem;
        background-color: #fff;
        text-align: center;
        box-shadow: 1px 3px 5px 1px rgba(0, 0, 0, .1);
    }

    .cookie-card h3 {
        font-size: 21px;
        padding: 20px;
    }

    .cookie-card p {
        font-size: 14px;
        color: rgba(0, 0, 0, .8);
        padding-bottom: 20px;
    }

    .cookie-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .cookie-btn {
        padding: .75rem 1.5rem;
        border-radius: 4px;
        border: 1px solid #7C4970;
        outline: none;
        background: transparent;
        font-weight: bold;
        color: #7C4970;
        cursor: pointer;
        transition: .2s ease-in-out;
    }

    .bg {
        background-color: #FC8490;
        color: #FAFBFB;
        border-color: #FC8490;
        box-shadow: 5px 5px 15px -6px #D48EA6;
    }

    .bg:hover,
    .cookie-btn:hover {
        /*   box-shadow: 6px 8px 5px -7px #FC8490; */
        color: #FAFBFB;
        border-color: #fa7885;
        background-color: #fa7885;
    }

    /* .setting{
  position:absolute;
  top:0;
  left:0;
  bottom:0;
  right:0;
} */
    .setting .header {
        display: flex;
        align-items: center;
    }

    .setting .contents {
        display: flex;
        justify-content: space-evenly;
        /* flex-wrap:wrap; */
        margin-top: 20px;
        gap: 20px;
    }

    .switch .contents .content {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    .content span {
        font-size: 14px;
        /*   margin-right:10px; */
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .switch input {
        width: 0;
        height: 0;
        opacity: 0;
    }

    .rounded {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #ccc;
        border-radius: 50px;
        transition: .2s ease-in-out;
    }

    .rounded::before {
        content: "";
        position: absolute;
        width: 25px;
        height: 25px;
        /*   margin:3px; */
        background-color: #fff;
        border-radius: 50%;
        left: 3px;
        bottom: 2.2px;
        transition: inherit;
    }

    .switch input:checked+.rounded {
        background-color: #81D9CD;
    }

    .switch input:focus+.rounded {
        box-shadow: 0 0 1px #2196F3;
    }

    .switch input:checked+.rounded:before {
        -webkit-transform: translateX(30px);
        -ms-transform: translateX(30px);
        transform: translateX(30px);
    }

    .setting .actions {
        margin-top: 20px;
        padding-top: 10px;
        padding-right: 20px;
        background: #FAFBFB;
        display: flex;
        gap: 20px;
        justify-content: flex-end;
    }
</style>


<script>
    // Required varaibles
    let cookieStorageName = 'cookie_status';

    function showCookieSettings () {
        let setting = document.querySelector('#cookie-settings');
        if (setting.style.display === "none") {
            setting.style.display = "block";
        } else {
            setting.style.display = "none";
        }
    }

    function addItemStorage(key, data) {
        window.localStorage.setItem(key, data);
    }

    function getItemStorage(key) {
        return window.localStorage.getItem(key)
    }

    function revomeItemStorage(key) {
        window.localStorage.removeItem(key);
    }

    function killStorage(key) {
        window.localStorage.clear();
    }

    // Returns an object of key value pairs for this page's cookies
    function getPageCookies () {

        // cookie is a string containing a semicolon-separated list, this split puts it into an array
        var cookieArr = document.cookie.split(";");

        // This object will hold all of the key value pairs
        var cookieObj = {};

        // Iterate the array of flat cookies to get their key value pair
        for(var i = 0; i < cookieArr.length; i++){

            // Remove the standardized whitespace
            var cookieSeg = cookieArr[i].trim();

            // Index of the split between key and value
            var firstEq = cookieSeg.indexOf("=");

            // Assignments
            var name = cookieSeg.substr(0,firstEq);
            var value = cookieSeg.substr(firstEq+1);
            cookieObj[name] = value;
        }
        return cookieObj;
    }
    // Delete cookie
    function eraseCookie(name) {
        document.cookie = name + '=; Max-Age=0'
    }

    // To toogle the cookie case user need to select option usable in the cookie popup
    function showCookie () {
        let setting = document.querySelector('#cookie-plugin');

        if (setting.style.display === "none") {
            setting.style.display = "block";
        } else {
            setting.style.display = "none";
        }
    }

    // Function the accept the cookie
    function acceptCookie(enableAll = false) {
        let setting = document.querySelector('#cookie-plugin');
        setting.style.display = "none";

        // Check witch item the user wants to enable or disable
        let functional = document.querySelector('#cookie-functional');
        let statstics  = document.querySelector('#cookie-statstics');
        let marketing  = document.querySelector('#cookie-marketing');

        // Object that use the options the customer select
        var cookieOptions = [{
            'necessary':true
        }];

        // Functional
        if (enableAll) {
            cookieOptions.push({'functional':true});
            cookieOptions.push({'statstics':true});
            cookieOptions.push({'marketing':true});
        } else {
            if (functional.checked) {
                cookieOptions.push({'functional':true});
            } else {
                cookieOptions.push({'functional':false});
            }

            // Statstics
            if (statstics.checked) {
                cookieOptions.push({'statstics':true});
            } else {
                cookieOptions.push({'statstics':false});
            }

            // Marketing
            if (marketing.checked) {
                cookieOptions.push({'marketing':true});
            } else {
                cookieOptions.push({'marketing':false});
            }
        }

        // The storage varaible that will make the user save the option if the cookie is enable
        addItemStorage(cookieStorageName, true);
        // The varaible tha will store the user options
        addItemStorage('cookieOptions', JSON.stringify(cookieOptions));
        // Run the script to enable or disable the cookies
        scriptEnableDisable();
        // Delete all teh cookie based in the customer actions
        cookieKill();
    }

    // This fuction is all once the user acpper the cookie policy and on load if is accpted
    const cookieStatstics = JSON.parse('@json(config('biscotto.cookie_statstics'))');
    const cookieMarketing = JSON.parse('@json(config('biscotto.cookie_marketing'))');
    const cookieFunctional =JSON.parse('@json(config('biscotto.cookie_functional'))');

    function cookieKill() {
        console.log(cookieFunctional);
        for (const [key, value] of Object.entries(JSON.parse(getItemStorage('cookieOptions')))) {
            for (const [cookieKey, cookie] of Object.entries(value)) {
                switch (cookieKey) {
                    case 'functional':
                        if (cookie == false) {
                            // Loop the config varaible to remove the cookies
                            cookieFunctional.forEach(element => {
                                eraseCookie(element);
                            });
                        }
                    break;
                    case 'statstics':
                        if (cookie == false) {
                            // Loop the config varaible to remove the cookies
                            cookieStatstics.forEach(element => {
                                eraseCookie(element);
                            });
                        }
                    break;
                    case 'marketing':
                        if (cookie == false) {
                            // Loop the config varaible to remove the cookies
                            cookieMarketing.forEach(element => {
                                eraseCookie(element);
                            });
                        }
                    break;
                    default:
                        //console.log('normalasdasd');
                        break;
                }
            }
        }
    }

    // This fuction is all once the user acpper the cookie policy and on load if is accpted
    const cookieIdStatstics  = '{{ config('biscotto.script_cookie_statstics') }}';
    const cookieIdMarketing  = '{{ config('biscotto.script_cookie_marketing') }}';
    const cookieIdFunctional = '{{ config('biscotto.script_cookie_functional') }}';
    // This function will loop true the dom and based in the biscotto config file will disable or enable scripts
    function scriptEnableDisable() {
        // Loop the user selected options stored in the local storage
        for (const [key, value] of Object.entries(JSON.parse(getItemStorage('cookieOptions')))) {
            for (const [cookieKey, cookie] of Object.entries(value)) {
                // Now check the option we try to check
                // Note that you need to the add id in the script or iframe you want to enable or disable
                switch (cookieKey) {
                    // If is functional will disable or enable the scripts
                    case 'functional':
                        // List scripts to enable or disable
                        var scriptList = document.querySelectorAll("#"+cookieIdFunctional);
                        // If the user option is true means that will enable the script
                        if (cookie == true) {
                            scriptList.forEach(element => {
                                if(element.getAttribute('data-src')) {
                                    element.setAttribute('src',element.getAttribute('data-src'));
                                    element.removeAttribute('data-src');
                                }
                            });
                        } else {
                            // Disable the scripts case use change his mind
                            scriptList.forEach(element => {
                                if(element.getAttribute('src')) {
                                    element.setAttribute('data-src',element.getAttribute('src'));
                                    element.removeAttribute('src');
                                }
                            });
                        }
                    break;
                    // If is statstics will disable or enable the scripts
                    case 'statstics':
                        // List scripts to enable or disable
                        var scriptList = document.querySelectorAll("#"+cookieIdStatstics);
                        // If the user option is true means that will enable the script
                        if (cookie == true) {
                            scriptList.forEach(element => {
                                if(element.getAttribute('data-src')) {
                                    element.setAttribute('src',element.getAttribute('data-src'));
                                    element.removeAttribute('data-src');
                                }
                            });
                        } else {
                            // Disable the scripts case use change his mind
                            scriptList.forEach(element => {
                                if(element.getAttribute('src')) {
                                    element.setAttribute('data-src',element.getAttribute('src'));
                                    element.removeAttribute('src');
                                }
                            });
                        }
                    break;
                    // If is marketing will disable or enable the scripts
                    case 'marketing':
                        // List scripts to enable or disable
                        var scriptList = document.querySelectorAll("#"+cookieIdMarketing);
                        // If the user option is true means that will enable the script
                        if (cookie == true) {
                            scriptList.forEach(element => {
                                if(element.getAttribute('data-src')) {
                                    element.setAttribute('src',element.getAttribute('data-src'));
                                    element.removeAttribute('data-src');
                                }
                            });
                        } else {
                            // Disable the scripts case use change his mind
                            scriptList.forEach(element => {
                                if(element.getAttribute('src')) {
                                    element.setAttribute('data-src',element.getAttribute('src'));
                                    element.removeAttribute('src');
                                }
                            });
                        }
                    break;
                    default:
                        //console.log('normalasdasd');
                        break;
                }
            }
        }
    }


    // If debug is enable will displat all the avaliable cookies in the site
    const biscottoDebug ='{{ config('biscotto.biscotto_debug') }}';
    if (biscottoDebug == true) {
        // On page fuly loaded
        window.addEventListener('load', function () {
            console.log('Site Avaliable Cookies', getPageCookies());
            console.log(showActiveScripts());
        });
    }

</script>


{{ $slot }}

<div class="cookie-container" id="cookie-plugin">
    <div class="cookie-card main">
        <h3>Do you allow us to use cookies? </h3>
        <p>
            {{ config('biscotto.biscotto_message') ?? 'Missing config' }}
        </p>
        <div class="cookie-buttons">
            <button class="cookie-btn" onclick="showCookieSettings()">Customize</button>
            <button class="cookie-btn bg" onclick="acceptCookie(true)">Allow All</button>
        </div>
    </div>
    <div class="cookie-card setting" style="display:none" id="cookie-settings">
        <div class="header">
            <img src="https://s2.svgbox.net/octicons.svg?ic=arrow-left&color=000" width="32" height="32">
            <h3>Customize your preference</h3>
        </div>
        <div class="contents">
            <div class="content">
                <span>Nesassary</span>
                <label class="switch">
                    <input type="checkbox" disabled checked>
                    <span class="rounded"></span>
                </label>
            </div>
            <div class="content">
                <span>Functional</span>
                <label class="switch">
                    <input type="checkbox" checked id="cookie-functional">
                    <span class="rounded"></span>
                </label>
            </div>
            <div class="content">
                <span>Statstics</span>
                <label class="switch">
                    <input type="checkbox" id="cookie-statstics">
                    <span class="rounded"></span>
                </label>
            </div>
            <div class="content">
                <span>Marketing</span>
                <label class="switch">
                    <input type="checkbox" id="cookie-marketing">
                    <span class="rounded"></span>
                </label>
            </div>
        </div>
        <div class="actions">
            <a href="{{ config('biscotto.biscotto_link') ?? 'Missing config' }}" class="cookie-btn bg">Cookie policy</a>
            <button class="cookie-btn bg" onclick="acceptCookie()">Save and Submit</button>
        </div>
    </div>
</div>

{{-- Add the cookie floater --}}
<x-biscotto::cookie_floater />

<script>
    // On page fuly loaded
    window.addEventListener('load', function () {
        // If the cookie is aceepted will hide on load
        if (getItemStorage(cookieStorageName)) {
                if (getItemStorage(cookieStorageName)) {
                    let setting = document.querySelector('#cookie-plugin');
                    setting.style.display = "none";
                    scriptEnableDisable();
                    cookieKill();
                }
            }
    });
</script>
