!function(){"use strict";var a=zmail.Core.Namespaces,b=a.create("zmailSearch.Core");b.i18n=zmText.get("search"),b.queryParam="";var c=function(){var a;return{get:{frameworkConfig:function(){return{appId:"zm_srch1",tooltip:"Search",tabInfo:{onDelete:function(){return zmailSearch.Model.beforeSearchTabClose(),!0},appname:"Search",appId:"zm_srch1",data:{CNodes:"3"},appIcon:"msi-search",noLeftSel:!1,shortcuts:zmshCut.mail,titleProvider:b.i18n.resultsHeader},overRideDefaultConfig:function(a){return zmailSearch.Core.overRideDefaultConfig(a)},onWorkSpaceConstruction:function(){zmailSearch.Core.onWorkspaceCreation(this)},workspace:function(){return a}}}},set:{workspace:function(b){a=b}}}}();b.cookSearchQuery=function(a){var b=zmailSearch.Utils.QueryBuilder.buildQuery(a);return b&&zmailSearch.Core.setQueryParams(b),b},b.generateView=function(a,b){zmailSearch.Core.initSearchResponse(a,b)},b.getFrameworkConfig=function(){return c.get.frameworkConfig.call(this)},b.onWorkspaceCreation=function(a){b.setWorkspace(a)},b.setWorkspace=function(a){c.set.workspace(a)},b.getWorkspace=function(){return c.get.workspace()},b.setQueryParams=function(a){zmailSearch.Core.queryParam=a},b.getQueryParams=function(){return zmailSearch.Core.queryParam},b.setSaveSearchQuery=function(a){zmailSearch.Core.saveSesarchQuery=a},b.getSaveSearchQuery=function(){return zmailSearch.Core.saveSesarchQuery},b.initSearchResponse=function(a,b){if(a.paginate||zmailSearch.Model.initSearchData(a,this.getFrameworkConfig(),b),zmailSearch.Model.populateSearchData(a,b),a.paginate){var c=zmsuite.getCenter()[0].getNodes()[0].$el.find(".msi-uncheck");c.hasClass("msi-check")&&c.removeClass().addClass("msi-uncheck msi-partcheck")}else zmInit.setDisplayDensity(),zmTopMenus.util.show({type:"listing",isSearchView:!0,tabId:"zm_srch1"}),zmList.unchkAll(),zmailSearch.View.bindEvents(b)},b.hasPagination=function(){return!!zmailSearch.Model.hasPagination()},b.getPageSize=function(){return zmail.Search.Models.Contexts.mailSearchContext.pageSize},b.isWorkspaceAvailable=function(){return!!zmailSearch.Model.getSearchData()},b.setCenterListingListener=function(a){a.listingCenter.eventListeners=[{event:"click",callback:function(a,b){zmList.bindEventsMailRow(a,b)}},{event:"contextmenu",callback:function(a,b){zmList.mailUtility(a,b)}}]},b.setListingActionListener=function(a){a.listingAction.eventListeners=[{event:"click",callback:function(a,b){"msi-close"===b?zmsuite.closeWorkspace(zmailSearch.Model.getSearchData().tabInfo.appId):zmInit.bindActionHeaderIcons(a,b)}}]},b.setListingHeaderListener=function(a){a.listingHeader.eventListeners=[{event:"click",callback:function(a){zmailSearch.Core.saveSearch(a)}}]},b.setPreviewHeaderListner=function(a){a.previewHeader.eventListeners=[{event:"click",callback:function(a,b){zmList.bindAction(a,b)}}]},b.setEventListeners=function(a){zmailSearch.Core.setListingHeaderListener(a),zmailSearch.Core.setListingActionListener(a),zmailSearch.Core.setCenterListingListener(a),zmailSearch.Core.setPreviewHeaderListner(a)},b.overRideDefaultConfig=function(a){return zmailSearch.View.setHeaderActionObj(a),zmailSearch.Core.setEventListeners(a),a},b.saveSearch=function(a){"savesearch"===a&&zmailSearch.View.savedSearchName().then(zmailSearch.Utils.CommonUtils.newSavedSearch)},b.isMailListedInSearch=function(a){var b,c=zmSearchUtil.getSearchList();return b=c.indexOf(a),b!==-1}}(),function(){"use strict";var a=zmail.Core.Namespaces,b=a.create("zmailSearch.Actions");b.markAsRead=function(a,b){b.rowElem.length&&(b.rowElem.removeClass("zm_urd"),b.previewContentElem.find("#zmHdrS"+a+" .zmPT").removeClass("zm_urd"))},b.markAsUnread=function(a,b){b.rowElem.length&&(b.rowElem.addClass("zm_urd"),b.previewContentElem.find("#zmHdrS"+a+" .zmPT").addClass("zm_urd"))},b.applyFlag=function(a,b,c){if(b.rowElem.length){var d=c.flagVal,e=zmInit.flgClass(d);b.rowElem.find(".zmflg").removeClass().addClass(e),b.previewContentElem.find("#zmHdrS"+a+" .zmflg").removeClass().addClass(e)}},b.applyTag=function(){},b.markAsSpam=function(a){zmailSearch.View.removeRowElem(a),zmailSearch.Model.deleteMessageFromList(a),zmailSearch.Model.deleteMessageContent(a),zmailSearch.View.closePreview(a)},b.markAsNotSpam=function(a){zmailSearch.View.removeRowElem(a),zmailSearch.Model.deleteMessageFromList(a),zmailSearch.View.closePreview(a)},b.archiveMail=function(a,b){if(b.rowElem.length){b.rowElem.addClass("zmarch");var c=zmailSearch.Utils.CommonUtils.getFolderNameOfMsg(a);zmailSearch.View.updateFolderName(a,b,c)}},b.unarchiveMail=function(a,b){if(b.rowElem.length){b.rowElem.removeClass("zmarch");var c=zmailSearch.Utils.CommonUtils.getFolderNameOfMsg(a);zmailSearch.View.updateFolderName(a,b,c)}},b.deleteMail=function(a){zmailSearch.View.removeRowElem(a),zmailSearch.Model.deleteMessageFromList(a),zmailSearch.View.closePreview(a)},b.moveMail=function(a,b,c){if(b.rowElem.length){var d=zmailSearch.Utils.CommonUtils.getFolderName(c);zmailSearch.View.updateFolderName(a,b,d);var e=zmailSearch.Model.getSearchData().requestParams.folId||[];e.length&&e[0]!==c&&(zmailSearch.View.removeRowElem(a),zmailSearch.Model.deleteMessageFromList(a),zmailSearch.View.closePreview(a))}}}(),function(){"use strict";var a=zmail.Core.Namespaces,b=a.create("zmailSearch.Utils.QueryBuilder"),c="FolderFilter",d="MailTagFilter",e="MailReminderFilter",f={Subject:{lhs:"Subject"},Sender:{lhs:"Sender"},ToOrCc:{lhs:"to/cc"},To:{lhs:"to"},Cc:{lhs:"cc"},EmailContent:{lhs:"Content"},AttachmentName:{lhs:"Attachment Name"},AttachmentContent:{lhs:"Attachment Content"},AttachmentType:{lhs:"formatType"},EntireMessage:{lhs:"entire message"},Has:{lhs:"entire message"}},g={SubjectExclude:{lhs:"Subject"},SenderExclude:{lhs:"Sender"},ToOrCcExclude:{lhs:"to/cc"},ToExclude:{lhs:"to"},CcExclude:{lhs:"cc"},EmailContentExclude:{lhs:"Content"},AttachmentNameExclude:{lhs:"Attachment Name"},AttachmentContentExclude:{lhs:"Attachment Content"},EntireMessageExclude:{lhs:"entire message"},HasExclude:{lhs:"entire message"}},h={HasAttachmentFilter:{flagName:"hasAtt",value:"1"},HasNoAttachmentFilter:{flagName:"hasAtt",value:"0"},HasFlagFilter:{flagName:"hasFlg",value:"1"},HasNoFlagFilter:{flagName:"hasFlg",value:"0"},HasReplyFilter:{flagName:"resp",value:"1"},HasNoReplyFilter:{flagName:"resp",value:"0"},ConversationFilter:{flagName:"thd",value:"1"},NoConversationFilter:{flagName:"thd",value:"0"},HasMailReminderFilter:{flagName:"hasRem",value:"1"},unread:{flagName:"unread",value:"1/0"}},i=function(a){var b,c,d,e,f="",g="",h="";for(c=a.length,b=0;b<c;b++)d=a[b],g=zmailSearch.Utils.CommonUtils.escapeSpecialChars(d.value),e=d.lhs,h=d.contains?" = ":" != ","to/cc"===e.toLowerCase()?" = "===h?f+="( To"+h+g+" ||Cc"+h+g+" )":" != "===h&&(f+="To"+h+g+" && Cc"+h+g):f+="entire message"===e.toLowerCase()?"Entire"+h+g:e+h+g,b!==c-1&&(f+=" && ");return f},j=function(a){var b={0:"-Jan-",1:"-Feb-",2:"-Mar-",3:"-Apr-",4:"-May-",5:"-Jun-",6:"-Jul-",7:"-Aug-",8:"-Sep-",9:"-Oct-",10:"-Nov-",11:"-Dec-"},c=a.getDate()+b[a.getMonth()]+a.getFullYear();return c},k=function(a){var b={},c=["MailFromDateFilter","MailToDateFilter","MailDateFilter"];return _(a).each(function(a){if(c.indexOf(a.className)!==-1)switch(a.className){case"MailFromDateFilter":b.fDate=j(a.actualValue),b.eDate||(b.eDate=j(new Date));break;case"MailToDateFilter":b.fDate||(b.fDate=j(new Date(0))),b.eDate=j(a.actualValue);break;case"MailDateFilter":b.fDate=j(a.actualValue),b.eDate=b.fDate}}),b.fDate&&b.eDate?b:{}},l=function(a){var b=[];if(_(a).each(function(a){a.className===c&&b.push(a.actualValue.id)}),b.length)return{folId:b}},m=function(a){var b=[];if(_(a).each(function(a){a.className===d&&b.push(a.actualValue.id)}),b.length)return{labId:b}},n=function(a){var b=[];if(_(a).each(function(a){a.className===e&&b.push(a.actualValue.value)}),b.length)return{wType:b}},o=function(a){var b={};return _(a).each(function(a){a.className in h&&(b[h[a.className].flagName]=h[a.className].value)}),b},p=function(a){var b=[];_(a).each(function(a){a.className in f?b.push({lhs:f[a.className].lhs,value:a.value,contains:!0}):a.className in g&&b.push({lhs:g[a.className].lhs,value:a.value,contains:!1})});var c=i(b);return c?{SearchStr:encodeURIComponent(c),searchQuery:b}:{}};b.buildQuery=function(a){var b=a.data,c={accId:zmail.accId,thdView:!1,from:1};c.to=zmail.Search.Models.Contexts.mailSearchContext.pageSize,a.paginate&&(c.from=zmailSearch.Model.getStartIndexforNextPage(),c.lastRT=zmailSearch.Model.getLastRetrievalTime(),c.lastM=zmailSearch.Model.getLastMessageId());var d=p(b);return zmailSearch.Core.setSaveSearchQuery(d.searchQuery),c=_.extend(c,{SearchStr:d.SearchStr},o(b),l(b),m(b),n(b),k(b)),c.SearchStr?c:""}}(),function(){"use strict";var a=zmail.Core.Namespaces,b=a.create("zmailSearch.View");b.i18n=zmText.get("search");var c=function(a){var b,c;return c=zmInit.constructMailRow("",[a]),b=$(c)};b.setHeaderActionObj=function(a){var c=b.i18n.savedsearch.save,d="<span class='SC_lnk zm_savesearch' data-data-event = 'savesearch'>"+c+"</span>";a.listingHeader.obj.left={leftHTML:b.i18n.mail.resultsHeader+d};var e=zmTopMenus.util.get("search");a.listingAction.obj.left=e.left,a.listingAction.obj.right=e.right,a.listingCenter={eventListeners:[]}},b.generateListView=function(a,b){void 0===a&&(a=0);var d=zmailSearch.Model.getSearchData().searchList,e=0,f=zmailSearch.Model.getSearchData().elemObj.listingContentElem;b=b||d.length;var g=document.createDocumentFragment();for(e=a;e<b;e++)g.appendChild(c(d[e])[0]);0===a&&(f.html(""),f.scrollTop(0),0===b&&this.setEmptyListing()),f.append(g)},b.setEmptyListing=function(){var a=zmailSearch.Model.getSearchData().elemObj.listingContentElem,b=zmailSearch.Model.getSearchData().searchList;0===b.length&&a.html(zmInit.emptyRow(this.i18n.emptyResults))},b.removeListingContent=function(){if(zmailSearch.Model.getSearchData()&&zmailSearch.Model.getSearchData().elemObj){var a=zmailSearch.Model.getSearchData().elemObj.listingContentElem;a.html("")}},b.hidesavesearchOption=function(){var a=zmailSearch.Model.getSearchData()&&zmailSearch.Model.getSearchData().elemObj;a&&a.listingHeaderElem.find(".zm_savesearch").hide()},b.bindEvents=function(a){this.subcribeEvents(a)},b.subcribeEvents=function(){$.subscribe("mail/read",b.updateRowRead),$.subscribe("mail/unread",b.updateRowUnread),$.subscribe("mail/flag",b.updateFlagRow),$.subscribe("mail/delete",b.updateRowDelete),$.subscribe("mail/label",b.updateLabelRow),$.subscribe("mail/move",b.updateRowMove),$.subscribe("mail/archive",b.updateRowArchive),$.subscribe("mail/unarchive",b.updateRowUnarchive),$.subscribe("mail/spam",b.updateRowSpam),$.subscribe("mail/notspam",b.updateRowNotspam)},b.unsubscribeEvents=function(){$.unsubscribe("mail/read",b.updateRowRead),$.unsubscribe("mail/unread",b.updateRowUnread),$.unsubscribe("mail/flag",b.updateFlagRow),$.unsubscribe("mail/delete",b.updateRowDelete),$.unsubscribe("mail/label",b.updateLabelRow),$.unsubscribe("mail/move",b.updateRowMove),$.unsubscribe("mail/archive",b.updateRowArchive),$.unsubscribe("mail/unarchive",b.updateRowUnarchive),$.unsubscribe("mail/spam",b.updateRowSpam),$.unsubscribe("mail/notspam",b.updateRowNotspam)},b.updateRowRead=function(a,b){if(zmList.isMailListedInSearch(b)){var c=zmailSearch.Utils.CommonUtils.getMsgRowElemObj(b);zmailSearch.Actions.markAsRead(b,c)}},b.updateRowUnread=function(a,b){if(zmList.isMailListedInSearch(b)){var c=zmailSearch.Utils.CommonUtils.getMsgRowElemObj(b);zmailSearch.Actions.markAsUnread(b,c)}},b.updateFlagRow=function(a,b,c,d){if(zmList.isMailListedInSearch(b)){var e=zmailSearch.Utils.CommonUtils.getMsgRowElemObj(b);zmailSearch.Actions.applyFlag(b,e,{flagVal:d})}},b.updateRowDelete=function(a,b){zmList.isMailListedInSearch(b)&&zmailSearch.Actions.deleteMail(b)},b.updateLabelRow=function(a,b,c,d){if(zmList.isMailListedInSearch(b)){var e=zmailSearch.Utils.CommonUtils.getMsgRowElemObj(b);zmailSearch.Actions.applyTag(b,e,d)}},b.updateRowMove=function(a,b,c,d){if(zmList.isMailListedInSearch(b)){var e=zmailSearch.Utils.CommonUtils.getMsgRowElemObj(b);zmailSearch.Actions.moveMail(b,e,d.folId)}},b.updateRowArchive=function(a,b){if(zmList.isMailListedInSearch(b)){var c=zmailSearch.Utils.CommonUtils.getMsgRowElemObj(b);zmailSearch.Actions.archiveMail(b,c)}},b.updateRowUnarchive=function(a,b){if(zmList.isMailListedInSearch(b)){var c=zmailSearch.Utils.CommonUtils.getMsgRowElemObj(b);zmailSearch.Actions.unarchiveMail(b,c)}},b.updateRowSpam=function(a,b){zmList.isMailListedInSearch(b)&&zmailSearch.Actions.markAsSpam(b)},b.updateRowNotspam=function(a,b){zmList.isMailListedInSearch(b)&&zmailSearch.Actions.markAsNotSpam(b)},b.removeRowElem=function(a){if(zmList.isMailListedInSearch(a)){var b=zmailSearch.Utils.CommonUtils.getMsgRowElemObj(a);b.rowElem.remove();var c=zmailSearch.Core.getPageSize(),d=zmailSearch.Core.hasPagination(),e=zmailSearch.Model.getSearchList()||[];e.length<c&&d&&zmail.Search.SearchWatcher.handlePagination()}},b.updateFolderName=function(a,b,c){if(b.rowElem.length&&b.rowElem.find(".zmFdr span").html(c),b.previewContentElem.length){var d=b.previewContentElem.find("[data-mid="+a+"]");d.find(".zm_folname").html(c)}},b.closePreview=function(a){if(zmailSearch.Core.isWorkspaceAvailable()){var b=zmailSearch.Utils.CommonUtils.getSearchTabId(),c=zmPrev.prevDetails(b);c.msgId&&(a&&c.msgId===a?zmPrev.clsPreview(b):zmPrev.clsPreview(b))}},b.savedSearchName=function(a){var c,d,e,f,g,h,i,j,k,l,m="",n={};if(a=a||{},i=$.Deferred(),e=a.mode||"add","edit"===e&&i.resolve(),"add"===e||"rename"===e){switch(e){case"add":d=b.i18n.savedsearch.nameInfo,m="New Search";break;case"rename":d=b.i18n.savedsearch.renameInfo}n={title:d,style:{width:"200px"},customClass:"noanim",buttons:[{txt:"Save",selected:!0,callback:function(){var b,c="",d=$("#zm_rnssrchpopup").find("input"),f="";b=d.val(),"rename"===e&&(c=zmSearch.savedSearchId,f=m.toLowerCase()),zmSearch.isValidName(b,a,c)?("rename"===e&&f===b.toLowerCase()?i.reject():i.resolve({savedsearchname:b}),zmsDialog.remove()):d.focus()}},{isCancel:!0,txt:b.i18n.cancel,callback:function(){zmsDialog.remove()}}],closeaction:function(){$("#zm_rnssrchpopup").remove(),i.reject()},afterDisplay:function(){$("#zm_rnssrchpopup").find("input").focus(),$("#zm_rnssrchpopup").find("input").select()}},"rename"===e?(h=zmsuite.getAppLeft().getNodes()[0].getLayer("zmlSSrchTreeH").el,j=$(".zm_compose"),k=j.offset(),f=k.left+j.width(),g=h.position().top<0?$(".zm_compose").offset().top:h.offset().top,l=g+250-$(document.body).height(),l>0&&(g-=l),n.posParent={top:g+"px",left:f+"px"}):"add"===e&&(n.mask=!0,n.pos="center"),c=$('<div id="zm_rnssrchpopup" class="SC_p10"><ul><li class="SC_p10"><input type="text" data-enableshortcuts="true" class="SC_tiput" value="'+m+'" placeholder="'+b.i18n.savedsearch.placeholder+'"/></li></div>'),$("#zm_rnssrchpopup").length||$(document.body).append(c),zmsDialog.create("zm_rnssrchpopup",n),$("#zmsdialog_zm_rnssrchpopup").mousedown(function(a){zmUtil.stopEvents(a,!0)}),$("#zmsdialog_zm_rnssrchpopup").click(function(a){zmUtil.hideMenu(!1,!0)})}return i.promise()},b.updateSavedSearchLayer=function(a,c){if("add"===c){if($("#zmlSSrchTree").length){var d,e,f,g="zmlSSrchTreeH";zmail.savedSearchList[a.searchid]={id:a.searchid,FN:a.searchname},d=zmail.mailLeft.getNodes()[0].getLayer(g),e=zmList.getRowInfo(a.searchid,g);for(f in e){e[f].FN=a.searchname,e[f].id=a.searchid;break}d.appendNode(e,d.mapObject)}else{var h={};h.id=a.searchid,h.FN=a.searchname,zmail.savedSearchList[a.searchid]=h;var i={id:"id",name:"FN"};if(Object.keys(zmail.savedSearchList).length>0){var j=new ZMLayer,k={type:"1",mapObject:i,disableSelection:!0,listId:"zmlSSrchTree",id:"zmlSSrchTreeH",dataObject:{headerObject:{id:"zmlSSrchTreeH",name:"Saved Searches",showList:!0},listObject:zmail.savedSearchList}};j.push(k),zmail.mailLeft.getNodes()[0].insertLayerAfter("zmlview",j)}}zmUtil.succErrMsg("s",b.i18n.savedsearch.saveSuccess),b.hidesavesearchOption()}}}(),function(){"use strict";var a,b=zmail.Core.Namespaces,c=b.create("zmailSearch.Model");c.i18n=zmText.get("search");var d=function(a,b,c){this.initSearchTabInfo(b),this.initSearchReqData(),this.initSearchResult(a.response),this.initSearchElemObj(c)};d.prototype={initSearchTabInfo:function(a){this.tabInfo=a.tabInfo},initSearchReqData:function(){this.requestParams=zmailSearch.Core.getQueryParams()},initSearchResult:function(a){this.searchList=[],this.from=1,this.to=zmailSearch.Core.getPageSize(),this.hasNextPage="",this.lastRT="",this.lastMsgId=""},initSearchElemObj:function(a){this.elemObj={centerContainerElem:a.listing.$el,listingHeaderElem:a.listingHeader.$el,listingActionElem:a.listingAction.$el,listingContentElem:a.listingCenter.$el,prevContainerElem:a.preview.$el,previewHeaderElem:a.previewHeader.$el,previewContentElem:a.previewContent.$el,viewDetails:{fId:"",view:"search",flag:"",label:"",attach:""}}},initSearchResponse:function(a){var b=a.response||[];b.length&&(b=b[1]),this.addSearchList(b)},addSearchList:function(a){var b,c,d,e,f,g=a.length;e=zmCache.dolistObj(null,a),d=e.MO,f=a[g-1].stateinfo,this.setHasPagination(parseInt(f[13])),this.hasNextPage&&a[g-1].lastRT&&(this.setLastRetrievalTime(a[g-1].lastRT),this.setLastMessageId(a[g-2].M)),this.searchList.length?(b=this.searchList.length,this.searchList=this.searchList.concat(d)):(b=0,this.searchList=d),c=this.searchList.length,this.from=c+1,zmailSearch.View.generateListView(b,c)},setHasPagination:function(a){this.hasNextPage=a},setLastRetrievalTime:function(a){this.lastRT=a},setLastMessageId:function(a){this.lastMsgId=a}},c.initSearchData=function(b,c,e){a=new d(b,c,e)},c.populateSearchData=function(a,b){this.getSearchData().initSearchResponse(a)},c.getSearchData=function(){return a},c.getStartIndexforNextPage=function(){return this.getSearchData().from||1},c.getLastRetrievalTime=function(){return this.getSearchData().lastRT},c.getLastMessageId=function(){return this.getSearchData().lastMsgId},c.hasPagination=function(){return this.getSearchData().hasNextPage||!1},c.resetSearchData=function(){a&&(zmailSearch.View.closePreview(),zmailSearch.View.removeListingContent(),zmCache.clearSearchList(),zmCenterListing.mailObjectAPI.dropViewObjectStore(this.getSearchData().tabInfo.appId),a=void 0)},c.deleteMessageFromList=function(a){var b=this.getSearchList(),c=b.indexOf(a);c!==-1&&b.splice(c,1),zmailSearch.View.setEmptyListing()},c.deleteMessageContent=function(a){zmContentCache.remove(a)},c.beforeSearchTabClose=function(){this.resetSearchData(),zmailSearch.View.unsubscribeEvents()},c.getSearchList=function(){return this.getSearchData().searchList}}(),function(){"use strict";var a=zmail.Core.Namespaces,b=a.create("zmailSearch.Utils.CommonUtils"),c=zmText.get("mail").preview;b.escapeSpecialChars=function(a){return a.indexOf("=")!==-1&&a.indexOf("\\=")===-1&&(a=a.replace(/[=]/gi,"\\=")),a.indexOf("!")!==-1&&a.indexOf("\\!")===-1&&(a=a.replace(/!/gi,"\\!")),a.indexOf("&")!==-1&&a.indexOf("\\&")===-1&&(a=a.replace(/&/gi,"\\&")),a.indexOf("|")!==-1&&a.indexOf("\\|")===-1&&(a=a.replace(/\|/gi,"\\|")),a.indexOf('"')!==-1&&a.indexOf('\\"')===-1&&(a=a.replace(/"/gi,'\\"')),a.indexOf("(")!==-1&&a.indexOf("\\(")===-1&&(a=a.replace(/\(/gi,"\\(")),a.indexOf(")")!==-1&&a.indexOf("\\)")===-1&&(a=a.replace(/\)/gi,"\\)")),a.indexOf("<")!==-1&&a.indexOf("\\<)")===-1&&(a=a.replace(/[<]/gi,"\\<")),a.indexOf(">")!==-1&&a.indexOf("\\>)")===-1&&(a=a.replace(/[>]/gi,"\\>")),a.indexOf("'")!==-1&&a.indexOf("\\')")===-1&&(a=a.replace(/'/gi,"\\'")),a.indexOf(" ")===-1&&a.indexOf(",")===-1||(a="( "+a+" )"),a},b.getMsgRowElemObj=function(a){var b=$.extend({},zmailSearch.Model.getSearchData().elemObj),c=zmCenterListing.mailObjectAPI.getViewObject(a,b.viewDetails.view),d=c&&c.$el||[];return d.length||(d=b.listingContentElem.find("#"+a)),b.rowElem=d||[],b},b.getSearchTabId=function(){return zmailSearch.Model.getSearchData().tabInfo.appId},b.getSearchViewDetails=function(){return zmailSearch.Model.getSearchData().elemObj?zmailSearch.Model.getSearchData().elemObj.viewDetails:{}},b.getFolderNameOfMsg=function(a){var b=zmailSearch.Utils.CommonUtils.getFolderIdOfMsg(a),d=zmInit.findFolName(b);return zmail.mailObj[a]&&zmail.mailObj[a].AR&&(d=d+" ("+c.contentOptions.archived+")"),d},b.getFolderName=function(a){return zmInit.findFolName(a)},b.getFolderIdOfMsg=function(a){if(a&&zmail.mailObj[a])return zmail.mailObj[a].FD||""},b.getConversationViewType=function(){return 0},b.newSavedSearch=function(a){var b=a.mode||"add",c={mode:b},d={searchStr:JSON.stringify(zmailSearch.Core.getSaveSearchQuery())};$.extend(!0,d,zmailSearch.Core.getQueryParams()),"add"===b&&(d.searchname=a.savedsearchname);var e=function(a,b){a.searchid&&a.searchname?zmailSearch.View.updateSavedSearchLayer(a,b.mode):zmUtil.succErrMsg("e",zmail.i18n.errproc)};d.method=b,zmAjq.XHR({u:zmail.conPath+"/savesearch.do",t:"POST",fn:e,p:d,csr:"s",ep:c})}}(),window.zmSearchUtil=function(){"use strict";var a={isNewSearch:function(){return zmail.newSearch},getSearchString:function(){var a;return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?zmailSearch.Model.getSearchData().requestParams.SearchStr:zmail.searchObj[1].collection.searchContArr[0]||zmail.searchObj[1].collection.advSearchStr),a||""},getRequestParams:function(){var a;return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?zmailSearch.Model.getSearchData().requestParams:zmail.searchObj[1].collection.getCurrentParams()),a||{}},isWorkspaceAvailable:function(){if(zmSearchUtil.isNewSearch()){if(zmailSearch.Core.isWorkspaceAvailable())return!0}else if(zmsuite.isWorkspaceAvailable("zm_srch1")&&zmail.searchObj[1]&&"m"===_zm.getProperty(zmail.searchObj[1],"elemObj.appType"))return!0;return!1},getSearchList:function(){var a=[];return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?zmailSearch.Model.getSearchList():zmail.searchObj[1].collection.searchList),a||[]},getSearchElemObj:function(){},getSearchedFolders:function(){var a=[];return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?zmailSearch.Model.getSearchData().requestParams.folId:zmail.searchObj[1].collection.folderArr),a||[]},getSearchViewDetails:function(){var a;return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?zmailSearch.Utils.CommonUtils.getSearchViewDetails():zmsuite.getCenterOuter().$el.data("data-detail")),a||{view:"search"}},getSearchTabId:function(){var a="";return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?zmailSearch.Utils.CommonUtils.getSearchTabId():"zm_srch1"),a},hasNextPage:function(){var a=!1;return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?zmailSearch.Model.hasPagination():zmail.searchObj[1].collection.hasNext),a},getPageSize:function(){var a="";return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?zmailSearch.Core.getPageSize():zmail.searchObj[1].collection.limit),a},getSearchAppType:function(){var a="";return zmSearchUtil.isWorkspaceAvailable()&&(a=zmSearchUtil.isNewSearch()?"m":zmSearch.getSearchAppType()),a},launchSavedSearch:function(a){var b=[];if(a.searchstring){var c,d=$.parseJSON(zmUtil.decodeHTMLEntities(a.searchstring)),e=d.length,f={"Entire Message":"EntireMessage",Sender:"Sender","To/Cc":"ToOrCc",Subject:"Subject",Content:"EmailContent","Attachment Name":"AttachmentName","Attachment Content":"AttachmentContent"},g={"Entire Message":"EntireMessageExclude",Sender:"SenderExclude","To/Cc":"ToOrCcExclude",Subject:"SubjectExclude",Content:"EmailContentExclude","Attachment Name":"AttachmentNameExclude","Attachment Content":"AttachmentContentExclude"};for(c=0;c<e;c++)d[c].contains?b.push({className:f[d[c].lhs],value:d[c].value}):b.push({className:g[d[c].lhs],value:d[c].value})}if(a.folId&&b.push({className:"FolderFilter",value:zmfolAction.getFolderPath(a.folId)}),a.fDate||a.eDate){var h={Jan:0,Feb:1,Mar:2,Apr:3,May:4,Jun:5,Jul:6,Aug:7,Sep:8,Oct:9,Nov:10,Dec:11};if(a.fDate){var i=a.fDate.split("-");i=new Date(i[2],h[i[1]],i[0]),b.push({className:"MailFromDateFilter",value:i,actualValue:i})}if(a.eDate){var j=a.eDate.split("-");j=new Date(j[2],h[j[1]],j[0]),b.push({className:"MailToDateFilter",value:j,actualValue:j})}}1===a.hasFlg&&b.push({className:"HasFlagFilter"}),1===a.hasAtt&&b.push({className:"HasAttachmentFilter"}),1===a.resp&&b.push({className:"HasReplyFilter"}),a.labId&&b.push({className:"MailTagFilter",value:zmail.labInfo[a.labId]}),zmail.Search.setContext(zmail.Search.Models.Contexts.mailSearchContext),zmail.Search.newSearch(b)}};return a}();