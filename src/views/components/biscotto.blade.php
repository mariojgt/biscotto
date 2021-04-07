<style>
    *{
  margin:0;
  padding:0;
  box-sizing:border-box;
}
.cookie-container{

  top: 50%;
  left: 50%;
  margin-top: -50px;
  margin-left: -100px;
}

.cookie-card {
  padding:1.2rem;
  background-color:#fff;
  text-align:center;
  box-shadow: 1px 3px 5px 1px rgba(0,0,0,.1);
}
.cookie-card h3 {
  font-size:21px;
  padding:20px;
}
.cookie-card p{
  font-size: 14px;
  color: rgba(0,0,0,.8);
  padding-bottom:20px;
}
.cookie-buttons{
  display:flex;
  justify-content:center;
  align-items:center;
  gap:20px;
}
.cookie-btn{
  padding:.75rem 1.5rem;
  border-radius:4px;
  border:1px solid #7C4970;
  outline:none;
  background:transparent;
  font-weight:bold;
  color:#7C4970;
  cursor:pointer;
  transition:.2s ease-in-out;
}
.bg{
  background-color:#FC8490;
  color:#FAFBFB;
  border-color:#FC8490;
  box-shadow: 5px 5px 15px -6px #D48EA6;
}
.bg:hover,
.cookie-btn:hover{
/*   box-shadow: 6px 8px 5px -7px #FC8490; */
  color:#FAFBFB;
  border-color: #fa7885;
  background-color:#fa7885;
}
/* .setting{
  position:absolute;
  top:0;
  left:0;
  bottom:0;
  right:0;
} */
.setting .header{
  display:flex;
  align-items:center;
}
.setting .contents {
  display:flex;
  justify-content:space-evenly;
  /* flex-wrap:wrap; */
  margin-top:20px;
  gap:20px;
}
.switch .contents .content{
  display:flex;
  justify-content:space-evenly;
  align-items:center;
}
.content span{
  font-size: 14px;
/*   margin-right:10px; */
}
.switch {
  position:relative;
  display:inline-block;
  width:60px;
  height:30px;
}
.switch input{
  width:0;
  height:0;
  opacity:0;
}
.rounded{
  position:absolute;
  top:0;
  left:0;
  right:0;
  bottom:0;
  background:#ccc;
  border-radius:50px;
  transition:.2s ease-in-out;
}
.rounded::before{
  content:"";
  position:absolute;
  width:25px;
  height:25px;
/*   margin:3px; */
  background-color:#fff;
  border-radius:50%;
  left:3px;
  bottom:2.2px;
  transition:inherit;
}
.switch input:checked + .rounded {
  background-color:#81D9CD;
}
.switch input:focus + .rounded {
  box-shadow: 0 0 1px #2196F3;
}
.switch input:checked + .rounded:before {
  -webkit-transform: translateX(30px);
  -ms-transform: translateX(30px);
  transform: translateX(30px);
}

.setting .actions {
  margin-top:20px;
  padding-top:10px;
  padding-right:20px;
  background:#FAFBFB;
  display:flex;
  justify-content:flex-end;
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
    function getPageCookies(){

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
            (async () => {
                const rawResponse = await fetch('/biscotto/savecookie', {
                    method: 'POST',
                    headers: {
                        "Content-Type"    : "application/json",
                        "Accept"          : "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token"    : '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cookie_options           : cookieOptions,
                    })
                });
                const content = await rawResponse.json();
                console.log(content);
                // Check for errors
                if (content.errors) {
                    for (const [key, value] of Object.entries(content.errors)) {
                        console.log(value);
                    }
                } else {

                }
            })();

        // Reload the page to make sure chagne has happen
        location.reload();
        // console.log(cookieOptions);
        // Dynamic way to remove script from doom
        //const scriptList = document.querySelectorAll("script[type='text/javascript']");
        //console.log(scriptList[0].src);
        //const convertedNodeList = Array.from(scriptList);
        //const testScript = convertedNodeList[0];
        //testScript.parentNode.removeChild(testScript);

        //const scriptList2 = document.querySelectorAll("script[type='text/javascript']");

        //console.log(scriptList2);

    }

    // for (const [key, value] of Object.entries(getPageCookies())) {
    //     eraseCookie(key);
    // }
    //     console.log(getPageCookies());

</script>

{{-- necessary no need to add --}}
@if (!empty(Session::get('cookie_necessary')))
    @if (Session::get('cookie_necessary'))
        {{ $cookie_necessary }}
    @endif
@endif
{{-- functional scripts slot --}}
@if (!empty(Session::get('cookie_functional')))
    @if (Session::get('cookie_functional'))
        {{ $cookie_functional }}
    @endif
@endif

{{-- Statstics script slot--}}
@if (!empty(Session::get('cookie_statstics')))
    @if (Session::get('cookie_statstics'))
        {{ $cookie_statstics }}
    @endif
@endif
{{-- marketing script slot --}}
@if (!empty(Session::get('cookie_marketing')))
    @if (Session::get('cookie_marketing'))
        {{ $cookie_marketing }}
    @endif
@endif

<div class="cookie-container" id="cookie-plugin" >
    <div class="cookie-card main">
        <h3>Do you allow us to use cookies? </h3>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, repellendus maxime! Vitae consequatur atque possimus, maxime quos aperiam tenetur voluptatibus ullam facere alias, nulla totam.
        </p>
        <div class="cookie-buttons">
            <button class="cookie-btn" onclick="showCookieSettings()" >Customize</button>
            <button class="cookie-btn bg" onclick="acceptCookie(true)" >Allow All</button>
        </div>
    </div>
    <div class="cookie-card setting" style="display:none" id="cookie-settings" >
        <div class="header">
            <img src="https://s2.svgbox.net/octicons.svg?ic=arrow-left&color=000" width="32" height="32">
            <h3>Customize your preference</h3>
        </div>
        <div class="contents">
            <div class="content">
                <span>Nesassary</span>
                <label class="switch">
                <input type="checkbox" disabled checked >
                <span class="rounded"></span>
                </label>
            </div>
            <div class="content">
                <span>Functional</span>
                <label class="switch">
                <input type="checkbox" checked  id="cookie-functional" >
                <span class="rounded"></span>
                </label>
            </div>
            <div class="content">
                <span>Statstics</span>
                <label class="switch">
                <input type="checkbox" id="cookie-statstics" >
                <span class="rounded" ></span>
                </label>
            </div>
            <div class="content">
                <span>Marketing</span>
                <label class="switch">
                <input type="checkbox" id="cookie-marketing" >
                <span class="rounded" ></span>
                </label>
            </div>
        </div>
        <div class="actions">
            <button class="cookie-btn bg" onclick="acceptCookie()" >Save and Submit</button>
        </div>
    </div>
</div>


<style>

@import url('https://fonts.googleapis.com/css?family=Roboto');

.ba-we-love-subscribers {
	width: 290px;
	height: 50px;
	background-color: #fff;
	border-radius: 15px;
	box-shadow: 0px 12px 45px rgba(0, 0, 0, .15);
	font-family: 'Roboto', sans-serif;
	text-align: center;
	margin: 0 0 10px 0;
	overflow: hidden;
	opacity: 0;
}
.ba-we-love-subscribers.open {
	height: 270px;
	opacity: 1;
}
.ba-we-love-subscribers.popup-ani {
	-webkit-transition: all .8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
	transition: all .8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.ba-we-love-subscribers h1 {
	font-size: 20px;
	color: #757575;
	padding: 25px 0;
	margin: 0;
  font-weight:400;
  font-family: 'Roboto', sans-serif;

}
.ba-we-love-subscribers .love {
	width: 20px;
	height: 20px;
	background-position: 35px 84px;
	display: inline-block;
	margin: 0 6px;
	background-size: 62px;
}
.ba-we-love-subscribers .ba-logo {
	width: 65px;
	height: 25px;
	background-position: 0px;
	margin: 0 auto;
	opacity: .5;
	cursor: pointer;
}
.ba-we-love-subscribers .ba-logo:hover {
	opacity: 1;
}
.logo-ani {
	transition: 0.5s linear;
	-webkit-transition: 0.5s linear;
}
.ba-we-love-subscribers input {
	font-size: 14px;
	padding: 12px 15px;
	border-radius: 15px;
	border: 0;
	outline: none;
	margin: 8px 0;
	width: 100%;
	box-sizing: border-box;
	line-height: normal;
	/*Bootstrap Overide*/
	font-family: sans-serif;
	/*Bootstrap Overide*/
}
.ba-we-love-subscribers form {
	padding: 5px 30px 0;
	margin-bottom: 15px;
}
.ba-we-love-subscribers input[name="email"] {
	background-color: #eee;
}
.ba-we-love-subscribers input[name="submit"] {
	background-color: #00aeef;
	cursor: pointer;
	color: #fff;
}
.ba-we-love-subscribers input[name="submit"]:hover {
	background-color: #26baf1;
}
.ba-we-love-subscribers .img {
	background-image: url("https://4.bp.blogspot.com/-1J75Et4_5vc/WAYhWRVuMiI/AAAAAAAAArE/gwa-mdtq0NIqOrlVvpLAqdPTV4VAahMsQCPcB/s1600/barrel-we-love-subscribers-img.png");
}
.ba-we-love-subscribers-fab {
	width: 65px;
	height: 65px;
	background-color: #00aeef;
	border-radius: 30px;
	float: right;
	box-shadow: 0px 12px 45px rgba(0, 0, 0, .3);
	z-index: 5;
	position: relative;
}
.ba-we-love-subscribers-fab .img-fab {
	height: 30px;
	width: 30px;
	margin: 15px auto;
	background-image: url("https://4.bp.blogspot.com/-1J75Et4_5vc/WAYhWRVuMiI/AAAAAAAAArE/gwa-mdtq0NIqOrlVvpLAqdPTV4VAahMsQCPcB/s1600/barrel-we-love-subscribers-img.png");
	background-position: -1px -53px;
}
.ba-we-love-subscribers-fab .wrap {
	transform: rotate(0deg);
	-webkit-transition: all .15s cubic-bezier(0.15, 0.87, 0.45, 1.23);
	transition: all .15s cubic-bezier(0.15, 0.87, 0.45, 1.23);
}
.ba-we-love-subscribers-fab .ani {
	transform: rotate(45deg);
	-webkit-transition: all .15s cubic-bezier(0.15, 0.87, 0.45, 1.23);
	transition: all .15s cubic-bezier(0.15, 0.87, 0.45, 1.23);
}
.ba-we-love-subscribers-fab .close {
	background-position: -2px 1px;
	transform: rotate(-45deg);
	float: none;
	/*Bootstrap Overide*/
	opacity: 1;
	/*Bootstrap Overide*/
}
.ba-we-love-subscribers-wrap {
	position: fixed;
	right: 25px;
	bottom: 25px;
	z-index: 1000;
}
.ba-settings {
	position: absolute;
	top: -25px;
	right: 0px;
	padding: 10px 20px;
	background-color: #555;
	border-radius: 5px;
	color: #fff;
}

.floater {
  display: flex;
  align-content: center;
}

</style>

<div class="ba-we-love-subscribers-wrap" onclick="showCookie()" >
	<div class="ba-we-love-subscribers-fab">
		<div class="floater">
			🍪
		</div>
	</div>
</div>

<script>

  // If the cookie is accpetd will hide on load
  if (getItemStorage(cookieStorageName)) {
        if (getItemStorage(cookieStorageName)) {
          let setting = document.querySelector('#cookie-plugin');
          setting.style.display = "none";
        }
    }

</script>
