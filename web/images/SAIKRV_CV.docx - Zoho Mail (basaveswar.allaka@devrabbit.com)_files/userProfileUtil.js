!function(){"use strict";var a=zmail.Core.Namespaces,b=a.create("zmail.userProfile"),c=function(a){var b=zmail.userProfile.core(a);return b};b.init=c}(),function(){"use strict";var a=zmail.Core.Namespaces,b=a.get("zmail.userProfile"),c=$.Deferred(),d=$.Deferred(),e=function(a){c.resolve({curUsage:a.curUsage,allotedUsage:a.allotedSpace})},f=function(a){d.resolve({expiryDate:a.info.expiryDate,planName:a.info.planName,superAdmin:a.info.superAdmin,upgrade:a.links[0],controlPanel:a.links[1],referFriend:a.links[2]})},g=function(){var a={};return a.mode="getUserProfile",zmAjq.XHR({u:"/biz/bizApi.do",t:"post",p:a,fn:f,csr:"s"}),d},h=function(){var a={};return a.mode="userUsageStatsVO",zmAjq.XHR({u:"/zm/userSettings.do",t:"POST",fn:e,p:a,csr:"s"}),c.promise()},i=function(){return $.when(h(),g()).done(function(a,b){})},j=function(){return i()};b.getProfileInfo=j}(),function(){"use strict";var a=zmail.Core.Namespaces,b=a.get("zmail.userProfile"),c=zmText.get("userProfileUtil").userProfile,d=function(a){var d=a,e=(d.usage.curUsage/1073741824).toFixed(2),f=(d.usage.allotedUsage/1073741824).toFixed(2),g=a.biz.expiryDate,h=(new Date).getTime(),i=864e5,j=location.protocol+"//"+zmail.zohoUrl+"/mail/",k="ios-android-apps.html",l="admin-mobile-app.html",m="streams-app.html",n="inbox-insight-app.html";g=Math.round(Math.abs(g-h)/i);var o=function(a,b){return Math.round(a/b*100)},p=e+" GB "+c.of+" "+f+" GB "+c.used,q=['<div ref = "userInfo" class = "zmUserData"><div><div class = "zmUserImg" ref = "userImage"><a rel = "noreferrer" target = "_blank" ref = "changeProfileImage">'+c.change+"</a><img src ="+d.basicInfo.photo+"></img></div><strong>"+d.basicInfo.name+'</strong><div class = "zmUserDtl"><p>'+d.basicInfo.emailId+"</p><p>"+c.userId+" "+d.basicInfo.userId+'<i ref = "help" class = "msi-help"> </i> </p><p ref = "superAdmin">'+c.superAdmin+" "+d.biz.superAdmin+'</p><p class = "zmPadTop10" ref = "accountLink"><a rel = "noreferrer" target = "_blank" class = "zmLink" href = "'+d.basicInfo.myAccount+'">'+c.myAccount+'</a><a ref = "signOut" class = "zmLink zmFR">'+c.signOut+"</a></p></div></div></div>"].join(""),r=['<div class = "zmUPscroll" ref = "userPlan"><div class = "zmRowSDot"></div><div class = "zmBdrBtn" ref = "additional"><a rel = "noreferrer" target = "_blank" ref = "subscription">'+c.subscription+'</a><a rel = "noreferrer" target = "_blank" ref = "controlPanel">'+c.controlPanel+'</a></div><div class = "zmUPBox zmModeBG">'+c.plan+"<h3>"+d.biz.planName+" "+c.planType+'</h3><div ref = "expires" class = "zmErrClr">'+c.planExpires+" "+g+" "+c.days+'</div><div class = "zmRowSDot"></div><div class = "zmSCWrapper" ref = "storage"><div><p ref = "storageUsed">'+p+'</p><div ref = "upgradepar"><a rel = "noreferrer" target = "_blank" ref = "upgrade" class = "zmRedButton">'+c.upgrade+'</a></div></div></div></div><div class = "zmUPBox zmModeBG" ref = "mobileApps"><h4>'+c.forMobile+"</h4></div></div>"].join(""),s=['<ul class = "zmUPmApp" ref = "mobileAppIcons"><li><a target = "_blank" rel = "noreferrer" href="'+j+k+'"><span class = "zmMobApp mail"></span><span>MAIL </span></a></li><li><a target = "_blank" rel = "noreferrer" href="'+j+l+'"><span class = "zmMobApp mailAdmin"></span><span>Mail Admin </span></a></li><li><a target = "_blank" rel = "noreferrer" href="'+j+m+'"><span class = "zmMobApp streams"></span><span>Streams </span></a></li><li><a  target = "_blank" rel = "noreferrer" href="'+j+n+'"><span class = "zmMobApp inboxInsight"></span><span>Inbox Insight </span></a></li></ul>'].join(""),t=['<div class = "SCmb puClose" ref = "closeIcon"><ul><li><b><span><i class = "msi-close"></i></span></b></li></ul></div>'].join(""),u=$('<li><div style = "width:350px;"><p>'+c.unique+"</p><p>"+c.identify+"</p></div></li>"),v=_zm.getDOMReferenceMap(s,!0),w=_zm.getDOMReferenceMap(q,!0),x=o(e,f),y=b.storageTemp(x,c.used),z=_zm.getDOMReferenceMap(r,!0);w.changeProfileImage.setAttribute("href",d.basicInfo.myAccount),$(z.storage).prepend(y),z.mobileApps.appendChild(v.mobileAppIcons);var A=_zm.getDOMReferenceMap(t,!0),B=$('<div class = "zmUserProfile"></div>');$(B).append(z.userPlan),$(B).append(w.userInfo),$(B).append(A.closeIcon);var C=new zmDropDownMenu,D=function(){C.hide()},E=function(){var a={liDom:u,showArrow:!0,par:w.help,defaultclass:!1};C.setDropObj(a),C.paintArrowDrop(),$(w.help).on("mouseleave",D)};$(w.help).on("mousemove",E);var F=function(){$(B).removeClass("shw"),setTimeout(function(){$(B).remove(),$(document.body).off("click",F)},5e3)};$(w.userImage).on("click",F),$(w.accountLink).on("click",F),$(z.additional).on("click",F),$(z.upgradepar).on("click",F),$(v.mobileAppIcons).on("click",F),$(A.closeIcon).on("click",F);var G=d.biz;return G.upgrade&&Object.keys(G.upgrade).length>0?"Upgrade"===G.upgrade.label?(z.upgrade.setAttribute("href",G.upgrade.link),$(z.subscription).remove()):"Subscription"===G.upgrade.label&&(z.subscription.setAttribute("href",G.upgrade.link),$(z.upgradepar).remove()):($(z.subscription).remove(),$(z.upgradepar).remove()),G.controlPanel&&Object.keys(G.controlPanel).length>0?z.controlPanel.setAttribute("href",G.controlPanel.link):$(z.controlPanel).remove(),G.referFriend&&Object.keys(G.referFriend).length>0?w.referFriend.setAttribute("href",G.referFriend.link):$(w.referFriend).remove(),w.signOut.setAttribute("href",d.basicInfo.signOut),"undefined"==typeof G.superAdmin&&$(w.superAdmin).remove(),"undefined"==typeof G.expiryDate&&($(z.expires)[0].innerText=""),$(B).on("click",function(a){a.stopPropagation()}),$(document.body).on("click",F),B},e=function(a){return d(a)};b.core=e}(),function(){"use strict";var a,b=zmail.Core.Namespaces,c=b.get("zmail.userProfile"),d={};d.getStorageTemplate=function(b,c){var e="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z";a=['<div class="zmStroageChart" ref = "dataPercent" data-percent="0%" data-used= '+c+">",'<svg viewBox="-10 -10 220 220">','<g class="zmStroageChartBack" fill="none" stroke-width="19" transform="translate(100,100)">','<path d="M 0,-100 A 100,100 0 0,1 86.6,-50"></path>','<path d="M 86.6,-50 A 100,100 0 0,1 86.6,50"></path>','<path d="M 86.6,50 A 100,100 0 0,1 0,100"></path>','<path d="M 0,100 A 100,100 0 0,1 -86.6,50"></path>','<path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50"></path>','<path d="M -86.6,-50 A 100,100 0 0,1 0,-100"></path>',"</g>","</svg>",'<svg viewBox="-10 -10 220 220">','<path ref="strokeInput" d="'+e+'" stroke-dashoffset="0">',"</path>","</svg>","</div>"].join("");var f=d.update(b);return f},d.update=function(b){parseInt(b)<10&&(b="0"+b);var c=_zm.getDOMReferenceMap(a,!0);return c.dataPercent.setAttribute("data-percent",b+"%"),c.strokeInput.setAttribute("stroke-dashoffset",6.29*Number(b)),c.dataPercent},c.storageTemp=d.getStorageTemplate}();