!function(){"use strict";var a=zmail.Core.Namespaces.create("dateParser"),b=zmText.get("dateParser"),c={tabs:'<div class="zm_ddTab"><ul class="SCS_tab"></ul></div>',cal:'<li data-type="event" class="">'+b.dParser.newTask+"</li>",task:'<li data-type="task" class="stSel">'+b.dParser.newCal+"</li>"},d=function(a){this.par=a.par,this.components=a.components,this.info=a.info,this.task=a.task,this.dateRef=new Date(a.info.ts)};d.prototype.hide=function(){this.popref.hide()},d.prototype.render=function(){var a=this,b=$("<div/>");b.html('<div class="zm_ddTab"><ul class="SCS_tab">'+c.task+"</ul></div>"),b.append(a.task.$el);var d={divId:"Dote",spanClass:"minwid",par:this.par,showArrow:!0,loadHTML:!0,htm:b.children(),onHide:function(){a.hide()}};a.popref=zmsuite.showMenu(d)},d.prototype.construct=function(){var a=this.dateRef.getDateBy(zmail.userDateFormat);this.task=zmtCom.createTaskSubtask({action:"addMTask",tasks:{TITLE:"",DUEDATE:a,SUMMARY:""}}),this.render()};var e=function(a,b){try{var c,d,e,f,g,h,i,j,k=function(a,b){var c='<span class = "zm_inLnk" data-index ="'+a+'">';return c=c+b+"</span>"},l="",m=new Date;for(d in b)if(c=b[d].MatchingText,j=b[d].MatchingDate[0],j=j.replace(/ /,"T"),i=new Date(j),i>m){if(e=a.indexOf(c),e===-1)continue;f=e+c.length,g=a.substring(0,f),h=k(d,c),g=g.replace(c,h),l=l.concat(g),a=a.substring(f,a.length)}return l=l.concat(a)}catch(n){return!1}},f=function(a){_zm._isPrivilegedUser()&&zmUtil.requireTaskModule().done(function(){var b=new d(a);b.construct()})};a.loadComponents=f,a.focusOnDate=e}();