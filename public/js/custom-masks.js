!function(e,t,a){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports&&"undefined"==typeof Meteor?module.exports=e(require("jquery")):e(t||a)}(function(e){"use strict";var t=function(t,a,n){var r={invalid:[],getCaret:function(){try{var e,a=0,n=t.get(0),s=document.selection,o=n.selectionStart;return s&&-1===navigator.appVersion.indexOf("MSIE 10")?((e=s.createRange()).moveStart("character",-r.val().length),a=e.text.length):(o||"0"===o)&&(a=o),a}catch(e){}},setCaret:function(e){try{if(t.is(":focus")){var a,n=t.get(0);n.setSelectionRange?n.setSelectionRange(e,e):((a=n.createTextRange()).collapse(!0),a.moveEnd("character",e),a.moveStart("character",e),a.select())}}catch(e){}},events:function(){t.on("keydown.mask",function(e){t.data("mask-keycode",e.keyCode||e.which),t.data("mask-previus-value",t.val()),t.data("mask-previus-caret-pos",r.getCaret()),r.maskDigitPosMapOld=r.maskDigitPosMap}).on(e.jMaskGlobals.useInput?"input.mask":"keyup.mask",r.behaviour).on("paste.mask drop.mask",function(){setTimeout(function(){t.keydown().keyup()},100)}).on("change.mask",function(){t.data("changed",!0)}).on("blur.mask",function(){i===r.val()||t.data("changed")||t.trigger("change"),t.data("changed",!1)}).on("blur.mask",function(){i=r.val()}).on("focus.mask",function(t){!0===n.selectOnFocus&&e(t.target).select()}).on("focusout.mask",function(){n.clearIfNotMatch&&!s.test(r.val())&&r.val("")})},getRegexMask:function(){for(var e,t,n,r,s,i,l=[],c=0;c<a.length;c++)(e=o.translation[a.charAt(c)])?(t=e.pattern.toString().replace(/.{1}$|^.{1}/g,""),n=e.optional,(r=e.recursive)?(l.push(a.charAt(c)),s={digit:a.charAt(c),pattern:t}):l.push(n||r?t+"?":t)):l.push(a.charAt(c).replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"));return i=l.join(""),s&&(i=i.replace(new RegExp("("+s.digit+"(.*"+s.digit+")?)"),"($1)?").replace(new RegExp(s.digit,"g"),s.pattern)),new RegExp(i)},destroyEvents:function(){t.off(["input","keydown","keyup","paste","drop","blur","focusout",""].join(".mask "))},val:function(e){var a,n=t.is("input")?"val":"text";return arguments.length>0?(t[n]()!==e&&t[n](e),a=t):a=t[n](),a},calculateCaretPosition:function(e){var a=r.getMasked(),n=r.getCaret();if(e!==a){var s=t.data("mask-previus-caret-pos")||0,o=a.length,i=e.length,l=0,c=0,u=0,d=0,v=0;for(v=n;v<o&&r.maskDigitPosMap[v];v++)c++;for(v=n-1;v>=0&&r.maskDigitPosMap[v];v--)l++;for(v=n-1;v>=0;v--)r.maskDigitPosMap[v]&&u++;for(v=s-1;v>=0;v--)r.maskDigitPosMapOld[v]&&d++;if(n>i)n=10*o;else if(s>=n&&s!==i){if(!r.maskDigitPosMapOld[n]){var p=n;n-=d-u,n-=l,r.maskDigitPosMap[n]&&(n=p)}}else n>s&&(n+=u-d,n+=c)}return n},behaviour:function(a){a=a||window.event,r.invalid=[];var n=t.data("mask-keycode");if(-1===e.inArray(n,o.byPassKeys)){var s=r.getMasked(),i=r.getCaret(),l=t.data("mask-previus-value")||"";return setTimeout(function(){r.setCaret(r.calculateCaretPosition(l))},e.jMaskGlobals.keyStrokeCompensation),r.val(s),r.setCaret(i),r.callbacks(a)}},getMasked:function(e,t){var s,i,l,c=[],u=void 0===t?r.val():t+"",d=0,v=a.length,p=0,f=u.length,m=1,h="push",k=-1,g=0,y=[];for(n.reverse?(h="unshift",m=-1,s=0,d=v-1,p=f-1,i=function(){return d>-1&&p>-1}):(s=v-1,i=function(){return d<v&&p<f});i();){var M=a.charAt(d),w=u.charAt(p),b=o.translation[M];b?(w.match(b.pattern)?(c[h](w),b.recursive&&(-1===k?k=d:d===s&&d!==k&&(d=k-m),s===k&&(d-=m)),d+=m):w===l?(g--,l=void 0):b.optional?(d+=m,p-=m):b.fallback?(c[h](b.fallback),d+=m,p-=m):r.invalid.push({p:p,v:w,e:b.pattern}),p+=m):(e||c[h](M),w===M?(y.push(p),p+=m):(l=M,y.push(p+g),g++),d+=m)}var _=a.charAt(s);v!==f+1||o.translation[_]||c.push(_);var x=c.join("");return r.mapMaskdigitPositions(x,y,f),x},mapMaskdigitPositions:function(e,t,a){var s=n.reverse?e.length-a:0;r.maskDigitPosMap={};for(var o=0;o<t.length;o++)r.maskDigitPosMap[t[o]+s]=1},callbacks:function(e){var s=r.val(),o=s!==i,l=[s,e,t,n],c=function(e,t,a){"function"==typeof n[e]&&t&&n[e].apply(this,a)};c("onChange",!0===o,l),c("onKeyPress",!0===o,l),c("onComplete",s.length===a.length,l),c("onInvalid",r.invalid.length>0,[s,e,t,r.invalid,n])}};t=e(t);var s,o=this,i=r.val();a="function"==typeof a?a(r.val(),void 0,t,n):a,o.mask=a,o.options=n,o.remove=function(){var e=r.getCaret();return o.options.placeholder&&t.removeAttr("placeholder"),t.data("mask-maxlength")&&t.removeAttr("maxlength"),r.destroyEvents(),r.val(o.getCleanVal()),r.setCaret(e),t},o.getCleanVal=function(){return r.getMasked(!0)},o.getMaskedVal=function(e){return r.getMasked(!1,e)},o.init=function(i){if(i=i||!1,n=n||{},o.clearIfNotMatch=e.jMaskGlobals.clearIfNotMatch,o.byPassKeys=e.jMaskGlobals.byPassKeys,o.translation=e.extend({},e.jMaskGlobals.translation,n.translation),o=e.extend(!0,{},o,n),s=r.getRegexMask(),i)r.events(),r.val(r.getMasked());else{n.placeholder&&t.attr("placeholder",n.placeholder),t.data("mask")&&t.attr("autocomplete","off");for(var l=0,c=!0;l<a.length;l++){var u=o.translation[a.charAt(l)];if(u&&u.recursive){c=!1;break}}c&&t.attr("maxlength",a.length).data("mask-maxlength",!0),r.destroyEvents(),r.events();var d=r.getCaret();r.val(r.getMasked()),r.setCaret(d)}},o.init(!t.is("input"))};e.maskWatchers={};var a=function(){var a=e(this),r={},s=a.attr("data-mask");if(a.attr("data-mask-reverse")&&(r.reverse=!0),a.attr("data-mask-clearifnotmatch")&&(r.clearIfNotMatch=!0),"true"===a.attr("data-mask-selectonfocus")&&(r.selectOnFocus=!0),n(a,s,r))return a.data("mask",new t(this,s,r))},n=function(t,a,n){n=n||{};var r=e(t).data("mask"),s=JSON.stringify,o=e(t).val()||e(t).text();try{return"function"==typeof a&&(a=a(o)),"object"!=typeof r||s(r.options)!==s(n)||r.mask!==a}catch(e){}};e.fn.mask=function(a,r){r=r||{};var s=this.selector,o=e.jMaskGlobals,i=o.watchInterval,l=r.watchInputs||o.watchInputs,c=function(){if(n(this,a,r))return e(this).data("mask",new t(this,a,r))};return e(this).each(c),s&&""!==s&&l&&(clearInterval(e.maskWatchers[s]),e.maskWatchers[s]=setInterval(function(){e(document).find(s).each(c)},i)),this},e.fn.masked=function(e){return this.data("mask").getMaskedVal(e)},e.fn.unmask=function(){return clearInterval(e.maskWatchers[this.selector]),delete e.maskWatchers[this.selector],this.each(function(){var t=e(this).data("mask");t&&t.remove().removeData("mask")})},e.fn.cleanVal=function(){return this.data("mask").getCleanVal()},e.applyDataMask=function(t){((t=t||e.jMaskGlobals.maskElements)instanceof e?t:e(t)).filter(e.jMaskGlobals.dataMaskAttr).each(a)};var r,s,o,i={maskElements:"input,td,span,div",dataMaskAttr:"*[data-mask]",dataMask:!0,watchInterval:300,watchInputs:!0,keyStrokeCompensation:10,useInput:!/Chrome\/[2-4][0-9]|SamsungBrowser/.test(window.navigator.userAgent)&&(r="input",o=document.createElement("div"),(s=(r="on"+r)in o)||(o.setAttribute(r,"return;"),s="function"==typeof o[r]),o=null,s),watchDataMask:!1,byPassKeys:[9,16,17,18,36,37,38,39,40,91],translation:{0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},S:{pattern:/[a-zA-Z]/}}};e.jMaskGlobals=e.jMaskGlobals||{},(i=e.jMaskGlobals=e.extend(!0,{},i,e.jMaskGlobals)).dataMask&&e.applyDataMask(),setInterval(function(){e.jMaskGlobals.watchDataMask&&e.applyDataMask()},i.watchInterval)},window.jQuery,window.Zepto),function(e){"use strict";e.browser||(e.browser={},e.browser.mozilla=/mozilla/.test(navigator.userAgent.toLowerCase())&&!/webkit/.test(navigator.userAgent.toLowerCase()),e.browser.webkit=/webkit/.test(navigator.userAgent.toLowerCase()),e.browser.opera=/opera/.test(navigator.userAgent.toLowerCase()),e.browser.msie=/msie/.test(navigator.userAgent.toLowerCase()));var t={destroy:function(){return e(this).unbind(".maskMoney"),e.browser.msie&&(this.onpaste=null),this},mask:function(t){return this.each(function(){var a,n=e(this);return"number"==typeof t&&(n.trigger("mask"),a=e(n.val().split(/\D/)).last()[0].length,t=t.toFixed(a),n.val(t)),n.trigger("mask")})},unmasked:function(){return this.map(function(){var t,a=e(this).val()||"0",n=-1!==a.indexOf("-");return e(a.split(/\D/).reverse()).each(function(e,a){return a?(t=a,!1):void 0}),a=(a=a.replace(/\D/g,"")).replace(new RegExp(t+"$"),"."+t),n&&(a="-"+a),parseFloat(a)})},init:function(t){return t=e.extend({prefix:"",suffix:"",affixesStay:!0,thousands:",",decimal:".",precision:2,allowZero:!1,allowNegative:!1},t),this.each(function(){function a(){var e,t,a,n,r,s=v.get(0),o=0,i=0;return"number"==typeof s.selectionStart&&"number"==typeof s.selectionEnd?(o=s.selectionStart,i=s.selectionEnd):(t=document.selection.createRange())&&t.parentElement()===s&&(n=s.value.length,e=s.value.replace(/\r\n/g,"\n"),(a=s.createTextRange()).moveToBookmark(t.getBookmark()),(r=s.createTextRange()).collapse(!1),a.compareEndPoints("StartToEnd",r)>-1?o=i=n:(o=-a.moveStart("character",-n),o+=e.slice(0,o).split("\n").length-1,a.compareEndPoints("EndToEnd",r)>-1?i=n:(i=-a.moveEnd("character",-n),i+=e.slice(0,i).split("\n").length-1))),{start:o,end:i}}function n(e){var a="";return e.indexOf("-")>-1&&(e=e.replace("-",""),a="-"),a+t.prefix+e+t.suffix}function r(e){var a,r,s,o=e.indexOf("-")>-1?"-":"",i=e.replace(/[^0-9]/g,""),l=i.slice(0,i.length-t.precision);return""===(l=(l=l.replace(/^0/g,"")).replace(/\B(?=(\d{3})+(?!\d))/g,t.thousands))&&(l="0"),a=o+l,t.precision>0&&(r=i.slice(i.length-t.precision),s=new Array(t.precision+1-r.length).join(0),a+=t.decimal+s+r),n(a)}function s(e){var t=v.val().length;v.val(r(v.val())),function(e){v.each(function(t,a){if(a.setSelectionRange)a.focus(),a.setSelectionRange(e,e);else if(a.createTextRange){var n=a.createTextRange();n.collapse(!0),n.moveEnd("character",e),n.moveStart("character",e),n.select()}})}(e-=t-v.val().length)}function o(){var e=v.val();v.val(r(e))}function i(){var e=v.val();return t.allowNegative?""!==e&&"-"===e.charAt(0)?e.replace("-",""):"-"+e:e}function l(e){e.preventDefault?e.preventDefault():e.returnValue=!1}function c(t){var n,r,o,c,u,d=(t=t||window.event).which||t.charCode||t.keyCode;return void 0!==d&&(48>d||d>57?45===d?(v.val(i()),!1):43===d?(v.val(v.val().replace("-","")),!1):13===d||9===d||(!(!e.browser.mozilla||37!==d&&39!==d||0!==t.charCode)||(l(t),!0)):!!function(){var e=!(v.val().length>=v.attr("maxlength")&&v.attr("maxlength")>=0),t=a(),n=t.start,r=t.end,s=!(t.start===t.end||!v.val().substring(n,r).match(/\d/)),o="0"===v.val().substring(0,1);return e||s||o}()&&(l(t),n=String.fromCharCode(d),o=(r=a()).start,c=r.end,u=v.val(),v.val(u.substring(0,o)+n+u.substring(c,u.length)),s(o+1),!1))}function u(){return(parseFloat("0")/Math.pow(10,t.precision)).toFixed(t.precision).replace(new RegExp("\\.","g"),t.decimal)}var d,v=e(this);t=e.extend(t,v.data()),v.unbind(".maskMoney"),v.bind("keypress.maskMoney",c),v.bind("keydown.maskMoney",function(e){var n,r,o,i,c,u=(e=e||window.event).which||e.charCode||e.keyCode;return void 0!==u&&(r=(n=a()).start,o=n.end,8!==u&&46!==u&&63272!==u||(l(e),i=v.val(),r===o&&(8===u?""===t.suffix?r-=1:(c=i.split("").reverse().join("").search(/\d/),o=1+(r=i.length-c-1)):o+=1),v.val(i.substring(0,r)+i.substring(o,i.length)),s(r),!1))}),v.bind("blur.maskMoney",function(a){if(e.browser.msie&&c(a),""===v.val()||v.val()===n(u()))t.allowZero?t.affixesStay?v.val(n(u())):v.val(u()):v.val("");else if(!t.affixesStay){var r=v.val().replace(t.prefix,"").replace(t.suffix,"");v.val(r)}v.val()!==d&&v.change()}),v.bind("focus.maskMoney",function(){d=v.val(),o();var e,t=v.get(0);t.createTextRange&&((e=t.createTextRange()).collapse(!1),e.select())}),v.bind("click.maskMoney",function(){var e,t=v.get(0);t.setSelectionRange?(e=v.val().length,t.setSelectionRange(e,e)):v.val(v.val())}),v.bind("mask.maskMoney",o)})}};e.fn.maskMoney=function(a){return t[a]?t[a].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof a&&a?void e.error("Method "+a+" does not exist on jQuery.maskMoney"):t.init.apply(this,arguments)}}(window.jQuery||window.Zepto);try{$(function(){$(".mask_date_usa").mask("0000/00/00",{clearIfNotMatch:!0,placeholder:"____/__/__"}),$(".mask_date").mask("00/00/0000",{clearIfNotMatch:!0,placeholder:"__/__/____"}),$(".mask_time").mask("00:00:00",{clearIfNotMatch:!0}),$(".mask_hour").mask("#0:00",{clearIfNotMatch:!0,reverse:!0,placeholder:"__:__"}),$(".mask_date_time").mask("00/00/0000 00:00:00",{clearIfNotMatch:!0}),$(".mask_phone").mask("0000-0000",{clearIfNotMatch:!0});let e=function(e){return 11===e.replace(/\D/g,"").length?"(00) 00000-0000":"(00) 0000-00009"},t={onKeyPress:function(t,a,n,r){n.mask(e.apply({},arguments),r)}};$(".mask_phone_with_ddd_usa").mask("(999) 999-9999"),$(".mask_phone_with_ddd").mask(e,t),$(".mask_ip_address").mask("099.099.099.099",{clearIfNotMatch:!0}),$(".mask_percent").mask("##0,00%",{reverse:!0}),$(".mask_cep").mask("00000-000",{clearIfNotMatch:!0}),$(".mask_cep_api").mask("00000-000",{clearIfNotMatch:!0,placeholder:"__/__/____",onComplete:function(e){console.log("Mask is done!:",e)},onKeyPress:function(e,t,a,n){console.log("An key was pressed!:",e," event: ",t,"currentField: ",a.attr("class")," options: ",n)},onInvalid:function(e,t,a,n,r){var s=n[0];console.log("Digit: ",s.v," is invalid for the position: ",s.p,". We expect something like: ",s.e)}}),$(".mask_cnpj").mask("00.000.000/0000-00",{reverse:!0}),$(".mask_cpf").mask("000.000.000-00",{reverse:!0}),$(".mask_money").mask("#.##0,00",{reverse:!0}),$(".maskmoney_money").maskMoney({showSymbol:!1,precision:2,allowZero:!0,allowNegative:!1,defaultZero:!0}),$(".maskmoney_percent").maskMoney({showSymbol:!1,decimal:",",thousands:"",precision:2,allowZero:!0,allowNegative:!1,defaultZero:!0})})}catch(e){}
