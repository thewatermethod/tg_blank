function sizeQuotes(){var e=[],t=document.querySelectorAll(".quote");if(window.innerWidth>800){t.forEach(t=>{e.push(t.clientHeight)}),e.sort();var a=e[e.length-1];t.forEach(e=>{e.style.color="black",e.style.height=a+"px"})}else t.forEach(e=>{e.style.color="black",e.style.height="auto"})}function insertPhone(){if(null!=siteSettings.phone){var e=document.querySelector("body"),t=document.createElement("a");t.classList.add("phone"),t.setAttribute("href",siteSettings.url+"/contact");var a=document.createTextNode("Contact Us: "+siteSettings.phone);t.appendChild(a),e.appendChild(t)}}function insertSearch(e){if(!document.querySelector(e)||null==siteSettings.url)return!1;var t=document.querySelector(e),a=document.createElement("form");a.setAttribute("role","search"),a.setAttribute("method","get"),a.setAttribute("class","search-form"),a.setAttribute("action",siteSettings.url);var n=document.createElement("label"),s=document.createElement("span");s.setAttribute("class","screen-reader-text");var i=document.createTextNode("Search for:");s.appendChild(i);var r=document.createElement("input");r.setAttribute("type","search"),r.setAttribute("class","search-field"),r.setAttribute("placeholder","Search..."),r.setAttribute("value",""),r.setAttribute("name","s"),n.appendChild(s),n.appendChild(r);var o=document.createElement("submit");o.setAttribute("class","search-submit"),o.setAttribute("value","Search"),a.appendChild(n),a.appendChild(o),t.appendChild(a)}function isIE(){return!!(window.navigator.userAgent.indexOf("MSIE ")>0||navigator.userAgent.match(/Trident.*rv\:11\./))&&(document.querySelector("body").classList.add("isIE"),!0)}window.onload=function(){if(document.querySelector("body").classList.contains("page-template-tmpl-home")||document.querySelector("body").classList.contains("page-template-tmpl-full")){insertSearch("#main-menu"),sizeQuotes();var e=document.querySelector("header.site-header .hero");document.onscroll=function(){window.scrollY>48?e.style.opacity=0:e.style.opacity=1}}isIE(),insertPhone()},jQuery(document).ready(function(){!function(e){e(".tab ul.tabs").addClass("active").find("> li:eq(0)").addClass("current"),e(".tab ul.tabs li").click(function(t){var a=e(this).closest(".tab"),n=e(this).closest("li").index();a.find("ul.tabs > li").removeClass("current"),e(this).closest("li").addClass("current"),a.find(".tab_content").find("div.tabs_item").not("div.tabs_item:eq("+n+")").slideUp(),a.find(".tab_content").find("div.tabs_item:eq("+n+")").slideDown(),t.preventDefault()})}(jQuery)}),function(){function e(){for(var e=this;-1===e.className.indexOf("nav-menu");)"li"===e.tagName.toLowerCase()&&(-1!==e.className.indexOf("focus")?e.className=e.className.replace(" focus",""):e.className+=" focus"),e=e.parentElement}var t,a,n,s,i,r;if((t=document.getElementById("site-navigation"))&&void 0!==(a=t.getElementsByTagName("button")[0]))if(void 0!==(n=t.getElementsByTagName("ul")[0])){for(n.setAttribute("aria-expanded","false"),-1===n.className.indexOf("nav-menu")&&(n.className+=" nav-menu"),a.onclick=function(){-1!==t.className.indexOf("toggled")?(t.className=t.className.replace(" toggled",""),a.setAttribute("aria-expanded","false"),n.setAttribute("aria-expanded","false")):(t.className+=" toggled",a.setAttribute("aria-expanded","true"),n.setAttribute("aria-expanded","true"))},i=0,r=(s=n.getElementsByTagName("a")).length;i<r;i++)s[i].addEventListener("focus",e,!0),s[i].addEventListener("blur",e,!0);!function(e){var t,a,n=e.querySelectorAll(".menu-item-has-children > a, .page_item_has_children > a");if("ontouchstart"in window)for(t=function(e){var t,a=this.parentNode;if(a.classList.contains("focus"))a.classList.remove("focus");else{for(e.preventDefault(),t=0;t<a.parentNode.children.length;++t)a!==a.parentNode.children[t]&&a.parentNode.children[t].classList.remove("focus");a.classList.add("focus")}},a=0;a<n.length;++a)n[a].addEventListener("touchstart",t,!1)}(t)}else a.style.display="none"}(),/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var e,t=location.hash.substring(1);/^[A-z0-9_-]+$/.test(t)&&(e=document.getElementById(t))&&(/^(?:a|select|input|button|textarea)$/i.test(e.tagName)||(e.tabIndex=-1),e.focus())},!1);