<style>

    .float{
        position:fixed;
        /* width:60px;
        height:60px; */
        bottom:40px;
        left:40px;
        background-color:#0C9;
        color:#FFF;
        border-radius:50px;
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }


    .my-float{
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
            setting.style.opacity = "0.0";
    }

</script>

<a href="#" class="float" onclick="showCookie()"
    onmouseover="onCookiePopup()"
    onmouseout="offCookiePopup()"
id="cookie_popup" >
    <div class="my-float{" >
        <h1>🍪</h1>
    </div>
</a>
