<style>
    .float {
        position: fixed;
        /* width:60px;
        height:60px; */
        bottom: 40px;
        left: 40px;
        background-color: black;
        color: #FFF;
        border: 2px solid white;
        padding: 1px;
        border-radius: 9px;
        text-align: center;
    }

    .my-float {
        margin-left: auto;
        margin-right: auto;
    }

</style>

<script>
    function onCookiePopup(params) {
        let setting = document.querySelector('#cookie_popup');
        setting.style.opacity = "1";
    }

    function offCookiePopup(params) {
        let setting = document.querySelector('#cookie_popup');
        setting.style.opacity = "{{ config('biscotto.biscotto_opacity') }}";
    }

    function enableCookie() {
        // Find the cookie
        let cookie = document.querySelector('#cookie_popup');
        // Make the cookie visible
        cookie.style.display = "block";
        cookie.style.opacity = "0.2";
    }

    setTimeout(() => {
        enableCookie();
    }, 1000);
</script>

<a href="#" class="float" onclick="showCookie()" onmouseover="onCookiePopup()" onmouseout="offCookiePopup()"
    id="cookie_popup" style="display: none;">
    <div class="my-float">
        <h1>🍪</h1>
    </div>
</a>
