<style>
    :root {
        --light-bg: #ffffff;
        --light-text: #1f2937;
        --light-secondary: #6b7280;
        --light-border: #e5e7eb;
        --light-hover: #f3f4f6;
        --dark-bg: #1f2937;
        --dark-text: #f3f4f6;
        --dark-secondary: #9ca3af;
        --dark-border: #374151;
        --dark-hover: #374151;
    }

    @media (prefers-color-scheme: light) {
        .cookie-container {
            background-color: var(--light-bg);
            color: var(--light-text);
        }

        .cookie-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid var(--light-border);
        }

        .cookie-description {
            color: var(--light-secondary);
        }

        .cookie-btn {
            background-color: var(--light-bg);
            color: var(--light-text);
            border: 1px solid var(--light-border);
        }

        .cookie-btn:hover {
            background-color: var(--light-hover);
        }

        .cookie-btn.primary {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
        }

        .cookie-btn.primary:hover {
            background-color: #1d4ed8;
        }

        .switch-slider {
            background-color: var(--light-border);
        }
    }

    @media (prefers-color-scheme: dark) {
        .cookie-container {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }

        .cookie-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.18);
            border: 1px solid var(--dark-border);
        }

        .cookie-description {
            color: var(--dark-secondary);
        }

        .cookie-btn {
            background-color: var(--dark-bg);
            color: var(--dark-text);
            border: 1px solid var(--dark-border);
        }

        .cookie-btn:hover {
            background-color: var(--dark-hover);
        }

        .cookie-btn.primary {
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
        }

        .cookie-btn.primary:hover {
            background-color: #2563eb;
        }

        .switch-slider {
            background-color: var(--dark-border);
        }
    }

    .cookie-container {
        position: fixed;
        bottom: 1rem;
        left: 1rem;
        right: 1rem;
        max-width: 42rem;
        margin: 0 auto;
        z-index: 50;
        transition: all 0.3s ease;
    }

    .cookie-card {
        border-radius: 0.75rem;
        padding: 1.5rem;
    }

    .cookie-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .cookie-description {
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

    .cookie-buttons {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .cookie-btn {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .settings-container {
        margin-top: 1.5rem;
    }

    .settings-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .settings-content {
        display: grid;
        gap: 1rem;
    }

    .cookie-option {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: background-color 0.2s ease;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 3rem;
        height: 1.5rem;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 1rem;
        transition: 0.2s;
    }

    .switch-slider:before {
        position: absolute;
        content: "";
        height: 1.25rem;
        width: 1.25rem;
        left: 0.125rem;
        bottom: 0.125rem;
        background-color: white;
        border-radius: 50%;
        transition: 0.2s;
    }

    input:checked+.switch-slider {
        background-color: #2563eb;
    }

    input:checked+.switch-slider:before {
        transform: translateX(1.5rem);
    }
</style>


<script>
    // Required varaibles
    let cookieStorageName = 'cookie_status';

    // Display the cookie settings
    function showCookieSettings() {
        let setting = document.querySelector('#cookie-settings');
        if (setting.style.display === "none") {
            setting.style.display = "block";
        } else {
            setting.style.display = "none";
        }
    }
    /**
     * Userfull Storage fuctions BEGIN 🍪🍪🍪🍪🍪
     * */

    /**
     * Add the item to the browser storage
     * @param mixed key
     * @param mixed data
     *
     */
    function addItemStorage(key, data) {
        window.localStorage.setItem(key, data);
    }

    /**
     * Retrive item from the storage
     *
     * @param mixed key
     *
     */
    function getItemStorage(key) {
        return window.localStorage.getItem(key)
    }

    /**
     * Remove the key from the storage
     *
     * @param mixed key
     *
     */
    function revomeItemStorage(key) {
        window.localStorage.removeItem(key);
    }

    /**
     * Clear all the storage data
     * @param mixed key
     *
     */
    function killStorage(key) {
        window.localStorage.clear();
    }
    /**
     * Userfull Storage fuctions END 🍪🍪🍪🍪🍪
     * */


    /**
     * Return all available cookies for the website
     *
     * @return object [cookies]
     */
    function getPageCookies() {

        // cookie is a string containing a semicolon-separated list, this split puts it into an array
        var cookieArr = document.cookie.split(";");

        // This object will hold all of the key value pairs
        var cookieObj = {};

        // Iterate the array of flat cookies to get their key value pair
        for (var i = 0; i < cookieArr.length; i++) {

            // Remove the standardized whitespace
            var cookieSeg = cookieArr[i].trim();

            // Index of the split between key and value
            var firstEq = cookieSeg.indexOf("=");

            // Assignments
            var name = cookieSeg.substr(0, firstEq);
            var value = cookieSeg.substr(firstEq + 1);
            cookieObj[name] = value;
        }
        return cookieObj;
    }


    /**
     * Delete cookie based on the name
     *
     * @param mixed name // cookie to delete
     *
     */
    function deleteCookie(name) {
        document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }


    /**
     * Display or hide the cookie settings
     *
     */
    function showCookie() {
        let setting = document.querySelector('#cookie-plugin');

        if (setting.style.display === "none") {
            setting.style.display = "block";
        } else {
            setting.style.display = "none";
        }
    }


    /**
     * When the user accepts the cookie settings
     *
     * @param bool enableAll // if true all the cookies are enable
     *
     */
    function acceptCookie(enableAll = false) {
        let setting = document.querySelector('#cookie-plugin');
        setting.style.display = "none";

        // Check witch item the user wants to enable or disable
        let functional = document.querySelector('#cookie-functional');
        let statstics = document.querySelector('#cookie-statstics');
        let marketing = document.querySelector('#cookie-marketing');

        // Object that use the options the customer select
        var cookieOptions = [{
            'necessary': true
        }];

        // Functional
        if (enableAll) {
            cookieOptions.push({
                'functional': true
            });
            cookieOptions.push({
                'statstics': true
            });
            cookieOptions.push({
                'marketing': true
            });
        } else {
            if (functional.checked) {
                cookieOptions.push({
                    'functional': true
                });
            } else {
                cookieOptions.push({
                    'functional': false
                });
            }

            // Statstics
            if (statstics.checked) {
                cookieOptions.push({
                    'statstics': true
                });
            } else {
                cookieOptions.push({
                    'statstics': false
                });
            }

            // Marketing
            if (marketing.checked) {
                cookieOptions.push({
                    'marketing': true
                });
            } else {
                cookieOptions.push({
                    'marketing': false
                });
            }
        }

        // The storage varaible that will make the user save the option if the cookie is enable
        addItemStorage(cookieStorageName, true);
        // The varaible tha will store the user options
        addItemStorage('cookieOptions', JSON.stringify(cookieOptions));
        // Run the script to enable or disable the cookies
        scriptEnableDisable();
        // Delete all the cookies based in the customer actions
        cookieKill();
    }

    // This fuction is all once the user acpper the cookie policy and on load if is accpted
    const cookieStatstics = JSON.parse('@json(config('biscotto.cookie_statstics'))');
    const cookieMarketing = JSON.parse('@json(config('biscotto.cookie_marketing'))');
    const cookieFunctional = JSON.parse('@json(config('biscotto.cookie_functional'))');

    /**
     * This fuction will loop all the cookie options and disable the cookies based in the config file
     */
    function cookieKill() {
        // Get all the cookie conserned by the user
        for (const [key, value] of Object.entries(JSON.parse(getItemStorage('cookieOptions')))) {
            for (const [cookieKey, cookie] of Object.entries(value)) {
                switch (cookieKey) {
                    case 'functional':
                        cookieKillLoop(cookie, cookieFunctional);
                        break;
                    case 'statstics':
                        cookieKillLoop(cookie, cookieStatstics);
                        break;
                    case 'marketing':
                        cookieKillLoop(cookie, cookieMarketing);
                        break;
                    default:
                        //console.log('normalasdasd');
                        break;
                }
            }
        }
    }

    /**
     * @param mixed cookie // true or false is the one the user has allowed or not
     * @param mixed array // the cookie array list we goin to make expire
     *
     */
    function cookieKillLoop(cookie, array) {
        if (cookie == false) {
            // Loop the config varaible to remove the cookies
            array.forEach(element => {
                deleteCookie(element);
            });
        }
    }

    // This fuction is all once the user acpper the cookie policy and on load if is accpted
    const cookieIdStatstics = '{{ config('biscotto.script_cookie_statstics') }}';
    const cookieIdMarketing = '{{ config('biscotto.script_cookie_marketing') }}';
    const cookieIdFunctional = '{{ config('biscotto.script_cookie_functional') }}';

    // This function will loop true the dom and based in the biscotto config file will disable or enable scripts
    function scriptEnableDisable() {
        // Loop the user selected options stored in the local storage
        for (const [key, value] of Object.entries(JSON.parse(getItemStorage('cookieOptions')))) {
            // Get all the cookie conserned options
            for (const [cookieKey, cookie] of Object.entries(value)) {

                // Now check the option we try to check
                // Note that you need to the add id in the script or iframe you want to enable or disable
                switch (cookieKey) {
                    // If is functional will disable or enable the scripts
                    case 'functional':
                        enableOrDisableScripts(cookieIdFunctional, cookie);
                        break;
                        // If is statstics will disable or enable the scripts
                    case 'statstics':
                        enableOrDisableScripts(cookieIdStatstics, cookie);
                        break;
                        // If is marketing will disable or enable the scripts
                    case 'marketing':
                        enableOrDisableScripts(cookieIdMarketing, cookie);
                        break;
                    default:
                        //console.log('normalasdasd');
                        break;
                }
            }
        }
    }

    /**
     * Find on the page the cookies with the tag that need to be disabled or enabled
     * @param mixed cookieId
     * @param mixed enable
     *
     */
    function enableOrDisableScripts(cookieId, enable) {
        // List scripts to enable or disable
        const scriptList = document.querySelectorAll("#" + cookieId);
        // If the user option is true means that will enable the script
        if (enable == true) {
            scriptList.forEach(element => {
                if (element.getAttribute('data-src')) {
                    element.setAttribute('src', element.getAttribute('data-src'));
                    element.removeAttribute('data-src');
                }
            });
        } else {
            // Disable the scripts case use change his mind
            scriptList.forEach(element => {
                if (element.getAttribute('src')) {
                    element.setAttribute('data-src', element.getAttribute('src'));
                    element.removeAttribute('src');
                }
            });
        }
    }


    // If debug is enable will displat all the avaliable cookies in the site
    const biscottoDebug = '{{ config('biscotto.biscotto_debug') }}';
    if (biscottoDebug == 'true') {
        // On page fuly loaded
        window.addEventListener('load', function() {
            console.log('Site Avaliable Cookies', getPageCookies());
            // console.log(showActiveScripts());
        });
    }
</script>


{{ $slot }}

<div class="cookie-container" id="cookie-plugin" style="display: none;">
    <div class="cookie-card main">
        <h3 class="cookie-title">Cookie Preferences</h3>
        <p class="cookie-description">
            We use cookies to enhance your browsing experience, serve personalized content, and analyze our traffic. By
            clicking "Accept All", you consent to our use of cookies.
        </p>
        <div class="cookie-buttons">
            <button class="cookie-btn" onclick="showCookieSettings()">Customize</button>
            <button class="cookie-btn primary" onclick="acceptCookie(true)">Accept All</button>
        </div>
    </div>

    <div class="cookie-card settings-container" style="display:none" id="cookie-settings">
        <div class="settings-header">
            <button class="cookie-btn" onclick="showCookieSettings()">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </button>
            <h3 class="cookie-title">Cookie Settings</h3>
        </div>

        <div class="settings-content">
            <div class="cookie-option">
                <span>Necessary (Required)</span>
                <label class="switch">
                    <input type="checkbox" disabled checked>
                    <span class="switch-slider"></span>
                </label>
            </div>

            <div class="cookie-option">
                <span>Functional</span>
                <label class="switch">
                    <input type="checkbox" checked id="cookie-functional">
                    <span class="switch-slider"></span>
                </label>
            </div>

            <div class="cookie-option">
                <span>Analytics</span>
                <label class="switch">
                    <input type="checkbox" id="cookie-statstics">
                    <span class="switch-slider"></span>
                </label>
            </div>

            <div class="cookie-option">
                <span>Marketing</span>
                <label class="switch">
                    <input type="checkbox" id="cookie-marketing">
                    <span class="switch-slider"></span>
                </label>
            </div>
        </div>

        <div class="cookie-buttons">
            <a href="#" class="cookie-btn">Privacy Policy</a>
            <button class="cookie-btn primary" onclick="acceptCookie()">Save Preferences</button>
        </div>
    </div>
</div>

{{-- Add the cookie floater --}}
@if (config('biscotto.show_cookie_button_popup'))
    <x-biscotto::cookie_floater />
@endif

<script>
    // On page fuly loaded
    window.addEventListener('load', function() {
        // If the cookie is aceepted will hide on load
        if (getItemStorage(cookieStorageName)) {
            if (getItemStorage(cookieStorageName)) {
                let setting = document.querySelector('#cookie-plugin');
                setting.style.display = "none";
                scriptEnableDisable();
                cookieKill();
            }
        } else {
            // If the cookie is not aceepted will show on load
            let setting = document.querySelector('#cookie-plugin');
            setting.style.display = "block";
        }
    });
</script>
