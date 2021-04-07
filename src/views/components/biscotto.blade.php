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
  flex-wrap:wrap;
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

    function showCookieSettings () {
        let setting = document.querySelector('#cookie-settings');
        if (setting.style.display === "none") {
            setting.style.display = "block";
        } else {
            setting.style.display = "none";
        }
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

    console.log(getPageCookies());

</script>


<div class="cookie-container">
    <div class="cookie-card main">
        <h3>Do you allow us to use cookies? </h3>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, repellendus maxime! Vitae consequatur atque possimus, maxime quos aperiam tenetur voluptatibus ullam facere alias, nulla totam.
        </p>
        <div class="cookie-buttons">
            <button class="cookie-btn" onclick="showCookieSettings()" >Customize</button>
            <button class="cookie-btn bg">Allow All</button>
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
                <input type="checkbox" >
                <span class="rounded"></span>
                </label>
            </div>
            <div class="content">
                <span>Statstics</span>
                <label class="switch">
                <input type="checkbox">
                <span class="rounded"></span>
                </label>
            </div>
            <div class="content">
                <span>Marketing</span>
                <label class="switch">
                <input type="checkbox">
                <span class="rounded"></span>
                </label>
            </div>
        </div>
        <div class="actions">
            <button class="cookie-btn bg">Save and Submit</button>
        </div>
    </div>
</div>


