"use strict";function _classCallCheck(a,b){if(!(a instanceof b))throw new TypeError("Cannot call a class as a function")}function _possibleConstructorReturn(a,b){if(!a)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!b||"object"!=typeof b&&"function"!=typeof b?a:b}function _inherits(a,b){if("function"!=typeof b&&null!==b)throw new TypeError("Super expression must either be null or a function, not "+typeof b);a.prototype=Object.create(b&&b.prototype,{constructor:{value:a,enumerable:!1,writable:!0,configurable:!0}}),b&&(Object.setPrototypeOf?Object.setPrototypeOf(a,b):a.__proto__=b)}define([],function(a){var b={};return b.init=function(){var c=a("zmText"),d=a("_zm"),e=a("zmUtil"),f=a("zmAppLoader"),g=function(a,b,d){return c.get("editorInteg",a,b,d)};b.staticVersion=zmail.editorStatic||"v53",b.language=zmail.user.lang,b.needplaintext=!0,b.editorCSS=!0,b.inlineQuotes=!0,b.modeChange=e.modeChange,b.spellcheckURL=zmail.urls.spellcheckURL,b.spellcheckProxyUrl=zmail.conPath+"/ze",b.useSameDomain=!0,b.useProxy=!0,b.domain=document.domain,b.tabKeyHandling=!0,b.needEditorFocus=!1,b.needEditorBorder=!0,b.needResizeImage=!1,b.removeInsertOptions=!1,b.removeFontFamily=!1,b.removeFontSize=!1,b.defaultFontSize="10pt",b.defaultFontFamily="Arial,Helvetica,sans-serif",b.defaultFontColor="blue",b.outGoingFontFamily="",b.outGoingFontSize="",b.outGoingColor="";var h=window.location.protocol;b.cssPath=b.imgPath="//"+zmail.jstatic+"/ze/"+b.staticVersion,b.jsPath="//"+zmail.jstatic+"/ze/"+b.staticVersion,b.toolbarOrder=[[["attach","Attachment","zei-attachment"]],[["bold",g("tooltip.bold"),"zei-bold"],["italic",g("tooltip.italic"),"zei-italic"],["underline",g("tooltip.underline"),"zei-underline"],["strikethrough",g("tooltip.strikethrough"),"zei-strike"]],[["fontfamily",g("tooltip.font"),"zei-fontfamily"]],[["fontsize",g("tooltip.fontSize"),"zei-arrow"]],[["forecolor",g("tooltip.fontColor"),"zei-textclr"],["backcolor",g("tooltip.backgroundColor"),"zei-bgclr"]],[["alignoptions",g("tooltip.alignOptions"),"zei-textleft"],["listoptions",g("tooltip.listOptions"),"zei-unorder"],["indentoptions",g("tooltip.indentOptions"),"zei-outdent"],["directionoptions",g("tooltip.directionOptions"),"zei-rtl"]],[["image",g("tooltip.insertImage"),"zei-image"],["link",g("tooltip.insertLink"),"zei-link"]],[["quote",g("tooltip.insertQuote"),"zei-quote"],["removeformat",g("tooltip.removeFormatting"),"zei-removeformat"]],[["table",g("tooltip.table"),"zei-table"],["inserthorizontalrule",g("tooltip.insertHR"),"zei-line"]],[["smiley",g("tooltip.insertSmiley"),"zei-smiley"]],[["otheroptions",g("tooltip.spellcheck"),"zei-arrow ze-big"]]],b.insertOptions=[["table",g("tooltip.bold"),"ze_tbl"],["inserthorizontalrule",g("tooltip.insertHR"),"ze_hr"],["object",g("tooltip.insertHtml"),"ze_obj"],["code",g("tooltip.insertCode"),"ze_icode"],["quote",g("tooltip.insertQuote"),"ze_quote"]],b.align=[{htm:g("dropdown.alignLeft"),datAttr:"justifyleft"},{htm:g("dropdown.alignRight"),datAttr:"justifyright"},{htm:g("dropdown.justify"),datAttr:"justifyfull"},{htm:g("dropdown.alignCenter"),datAttr:"justifycenter"}],b.list=[{htm:g("dropdown.bullets"),datAttr:"insertunorderedlist"},{htm:g("dropdown.numbering"),datAttr:"insertorderedlist"}],b.indent=[{htm:g("dropdown.incIndent"),datAttr:"indent"},{htm:g("dropdown.decIndent"),datAttr:"outdent"}],b.others=[{htm:g("dropdown.plainText"),datAttr:"switchmode"}],b.fontfamily=[{htm:"Serif",ff:"serif"},{htm:"Arial",ff:"arial,helvetica,sans-serif"},{htm:"Courier New",ff:"'courier new',courier,monospace"},{htm:"Georgia",ff:"georgia,times new roman,times,serif"},{htm:"Tahoma",ff:"tahoma,arial,helvetica,sans-serif"},{htm:"Times New Roman",ff:"'times new roman',times,serif"},{htm:"Trebuchet",ff:"'trebuchet ms',arial,helvetica,sans-serif"},{htm:"Verdana",ff:"verdana"},{htm:"Comic Sans MS",ff:"'Comic Sans MS'"},{htm:"Calibri",ff:"Calibri, Verdana, Arial, sans-serif"}],b.fontsize=[{htm:"8",datAttr:"1"},{htm:"10",datAttr:"2"},{htm:"12",datAttr:"3"},{htm:"14",datAttr:"4"},{htm:"18",datAttr:"5"},{htm:"24",datAttr:"6"},{htm:"36",datAttr:"7"}],b.insertOptions=[["image",g("tooltip.insertImage"),"ze_tim"],["smiley",g("tooltip.insertSmiley"),"ze_tis"],["link",g("tooltip.insertLink"),"ze_til"],["table",g("tooltip.table"),"ze_tbl"],["inserthorizontalrule",g("tooltip.insertHR"),"ze_hr"],["object",g("tooltip.insertHtml"),"ze_obj"],["code",g("tooltip.insertCode"),"ze_icode"],["quote",g("tooltip.insertQuote"),"ze_quote"]],b.textDir=[{htm:"RTL",datAttr:"rtl"},{htm:"LTR",datAttr:"ltr"}],b.SmarttoolbarOrder=[[["fontfamily",g("tooltip.font"),"zei-arrow"]],[["fontsize",g("tooltip.fontSize"),"zei-arrow"]],[["heading",g("tooltip.heading"),"zei-arrow"]],[["bold",g("tooltip.bold"),"zei-bold"],["italic",g("tooltip.italic"),"zei-italic"],["underline",g("tooltip.underline"),"zei-underline"],["strikethrough",g("tooltip.strikethrough"),"zei-strike"]],[["forecolor",g("tooltip.fontColor"),"zei-textclr"]],[["backcolor",g("tooltip.backgroundColor"),"zei-bgclr"]],[["link",g("tooltip.insertLink"),"zei-link"]],[["alignoptions",g("tooltip.alignOptions"),"zei-textleft"]],[["listoptions",g("tooltip.listOptions"),"zei-unorder"]]],b.Paragraphtoolbar=[[["heading",g("tooltip.heading"),"zei-arrow"]],[["alignLeft",g("dropdown.alignLeft"),"zei-textleft"],["alignRight",g("dropdown.alignRight"),"zei-textright"],["alignCenter",g("dropdown.alignCenter"),"zei-textcenter"],["alignjustify",g("dropdown.justify"),"zei-textjustify"]],[["NumBullets",g("dropdown.bullets"),"zei-order"],["DotBullets",g("dropdown.numbering"),"zei-unorder"]],[["LefttoRight",g("dropdown.rightToLeft"),"zei-rtl"],["RightToLeft",g("dropdown.leftToRight"),"zei-ltr"]]],b.insertToolbar=[[["quote",g("tooltip.insertQuote"),"zei-quote"]],[["image",g("tooltip.insertImage"),"zei-image"]],[["removeformat",g("tooltip.removeFormatting"),"zei-removeformat"]],[["link",g("tooltip.insertLink"),"zei-link"]],[["unlink",g("tooltip.removeLink"),"zei-unlink"]],[["tableGrid",g("tooltip.table"),"zei-table"]],[["inserthorizontalrule",g("tooltip.insertHR"),"zei-line"]],[["smiley",g("tooltip.insertSmiley"),"zei-smiley"]]],b.heading=[{htm:g("dropdown.normal"),datAttr:"Normal",fontsize:"20"},{htm:g("dropdown.heading1"),datAttr:"Heading1",fontsize:"26"},{htm:g("dropdown.heading2"),datAttr:"Heading2",fontsize:"24"},{htm:g("dropdown.heading3"),datAttr:"Heading3",fontsize:"22"},{htm:g("dropdown.heading4"),datAttr:"Heading4",fontsize:"20"},{htm:g("dropdown.heading5"),datAttr:"Heading5",fontsize:"18"},{htm:g("dropdown.heading6"),datAttr:"Heading6",fontsize:"16"}],b.imgAction="/ze/uploadImage",b.context="zm",b.imgAction="/zm/zeUploadImage.do",b.csrfParamVal="zmrcsr",b.plainTextDataDef=!0,b.csrfCookieVal=d.getCookie("zmcsr"),b.contextVal="zm",b.smileyPath=h+"//"+zmail.jstatic+"/ze/"+b.staticVersion+"/images/",b.imgParameters="?aId="+zmail.accId+"&mode=composeSet&frm=c",b.imgParametersFunction=function(){var c=a("zmTab");"object"!=typeof c||"settings"!==c.currentTab&&"zm-settings"!==c.currentTab?b.imgParameters="?aId="+zmail.accId+"&mode=composeSet&frm=c":b.imgParameters="?aId="+zmail.defAccId+"&mode=composeSet&frm=s"},b.attachDrop=[{htm:g("dropdown.attachDesktop"),clk:function(a){zmComp.triggerUpload(a)}},{htm:g("dropdown.attachCloud"),clk:function(a){zmComp.triggerCloudUpload(a)}}],b.setContentProcessed=!1;var i=navigator.userAgent.toLowerCase();b.is_ie=i.indexOf("ie")!==-1,b.is_safari=i.indexOf("safari")!==-1,b.is_opera=i.indexOf("opera")!==-1,b.is_mac=i.indexOf("mac")!==-1,b.language=b.ElementInArray(["en","zh","da","nl","fr","de","hu","it","ja","pl","pt","ru","es","sv","tr","uk"],b.language)||"en",b.is_opera&&b.toolbarOrder.pop(),b.loadURL(b.cssPath+"/css/editor.min.css","css"),b.editorCoreLoaded=f.loadFiles("extjs",b.jsPath+"/js/i18n/"+b.language+"/zep.min.js"),b.loading=!0},b.attach=function(a){zmComp.triggerUpload(a)},b.template=function(a){"undefined"!=typeof zmComp&&"function"==typeof zmComp.triggerTemplate&&zmComp.triggerTemplate(a)},b.signature=function(a){"undefined"!=typeof zmComp&&"function"==typeof zmComp.triggerSignature&&zmComp.triggerSignature(a)},b.setFocus=function(a){"undefined"!=typeof zmComp&&"function"==typeof zmComp.trigggerFocus&&zmComp.trigggerFocus(a)},b.setBlur=function(a){"undefined"!=typeof zmComp&&"function"==typeof zmComp.tirggerBlur&&zmComp.trigggerBlur(a)},b.loadURL=function(a,b){var c,d,e=document;"css"===b?(c=e.createElement("link"),c.type="text/css",c.rel="stylesheet",c.href=a,e.getElementsByTagName("head")[0].appendChild(c)):"js"===b&&(d=e.createElement("script"),d.type="text/javascript",d.src=a,d.charset="utf-8",e.getElementsByTagName("head")[0].appendChild(d))},b.ElementInArray=function(a,b){for(var c=a.shift();c;){if(c===b)return c;c=a.shift()}},b.loadInsertImage=function(a,b,c,d,e){var f="/mail/ImageSignature?fileName="+a+"&accountId="+c+"&storeName="+b;f+="c"===e?"&frm=c":"&frm=s",ZE&&ZE.activeEditor&&ZE.activeEditor.previewImage(f)},window.ZE_Init=b,b});var _createClass=function(){function a(a,b){for(var c=0;c<b.length;c++){var d=b[c];d.enumerable=d.enumerable||!1,d.configurable=!0,"value"in d&&(d.writable=!0),Object.defineProperty(a,d.key,d)}}return function(b,c,d){return c&&a(b.prototype,c),d&&a(b,d),b}}(),_get=function a(b,c,d){null===b&&(b=Function.prototype);var e=Object.getOwnPropertyDescriptor(b,c);if(void 0===e){var f=Object.getPrototypeOf(b);return null===f?void 0:a(f,c,d)}if("value"in e)return e.value;var g=e.get;if(void 0!==g)return g.call(d)};!function(){var a=zmail.Core.Namespaces,b=a.create("zmail.ZEditor.AutoComplete.System"),c=zmail.Components.AutoComplete,d=c.System.AbstractHTMLContentEditable,e=c.Utils,f=function(a){function b(){return _classCallCheck(this,b),_possibleConstructorReturn(this,(b.__proto__||Object.getPrototypeOf(b)).apply(this,arguments))}return _inherits(b,a),_createClass(b,[{key:"init",value:function(a){var c=this;c.editor=a,c.avoidEnterAction=!1,c.editor.initobj.isEnterKeyHandler=c.enterKeyHandler.bind(c),_get(b.prototype.__proto__||Object.getPrototypeOf(b.prototype),"init",this).call(this,a.doc.body)}},{key:"destroy",value:function(){var a=this;_get(b.prototype.__proto__||Object.getPrototypeOf(b.prototype),"destroy",this).call(this),a.editor=null}},{key:"getSelectionRange",value:function(){var a,b,c=this,d=c.editor,e=d.win,f=d.doc;return a=e.getSelection(),b=f.createRange(),a.rangeCount?(b.setStart(a.anchorNode,a.anchorOffset),b.setEnd(a.anchorNode,a.anchorOffset),b):null}},{key:"enterKeyHandler",value:function(){var a=this;return a.avoidEnterAction||setTimeout(function(){$(a).triggerHandler("textchange",{element:a.editor.doc.body,source:a,event:null})},0),a.avoidEnterAction}},{key:"replaceContent",value:function(a,b){var c=this,d=c.editor.win.getSelection(),e=c.getCurrentTypingWord(),f=c.getSelectionRange();f.setStart(f.startContainer,f.startOffset-e.length),d.removeAllRanges(),d.addRange(f),c.editor.insertHTML(b)}},{key:"getCurrentTypingWord",value:function(){var a=this,b=a.getSelectionRange(),c=b.startContainer,d=b.startOffset;3!==c.nodeType&&((!c.childNodes.length||1===c.childNodes.length&&3===c.childNodes[0].nodeType)&&a.checkAndInsertSingleTextNode(),c=c.childNodes[0]);var f=c.nodeValue,g=e.findWordAtIndex(f,d);return g}},{key:"getListAnchorBounds",value:function(){var a=this,b=a.editor,c=window.getSelection(),d=a.getCurrentTypingWord(),e=a.getSelectionRange(),f=e.startContainer;if(3!==f.nodeType){if(!f.childNodes.length||1===f.childNodes.length&&3===f.childNodes[0].nodeType){var g=e.startContainer.textContent,h=c.anchorOffset,i=document.createTextNode(g);e=document.createRange(),e.setStart(i,h),e.setEnd(i,h)}}else{var j=e.startOffset-d.length;j>0?e.setStart(e.startContainer,e.startOffset-d.length):e.setStart(e.startContainer,0)}var k=b.iframe.getBoundingClientRect(),l=e.getBoundingClientRect();return{top:k.top+l.top,right:k.left+l.left+l.width,left:k.left+l.left,bottom:k.top+l.top+l.height,height:l.height,width:l.width}}}]),b}(d);b.ZEditorUserInput=f}();