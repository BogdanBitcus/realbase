<? //include_once($_SERVER['DOCUMENT_ROOT']."/_s/c.php");
	$w = htmlspecialchars($_REQUEST['w']);
/*  ?> <script> <? /* */ ?>
(function(){
    function RealBaseInit() {
    	
        var hashToken = '#realbase';
        var hashValue = '';
        var domainId = '1983';
        var widgetDefLoad = true;
        var gaTrackingId = 'UA-159856621-1';
        var widgetState = false;
            

       function setStyles() {
            var cssId = 'realbaseStyle';
            if (!document.getElementById(cssId)) {
                var head  = document.getElementsByTagName('head')[0];
                var link  = document.createElement('link');
                link.id   = cssId;
                link.rel  = 'stylesheet';
                link.type = 'text/css';
                link.href = 'http://realbase.dev.realist.digital/public/css/style.css';
                link.media = 'all';
                head.appendChild(link);

                link.onload = function () {
                    createWidgetBtn();
                    addListener(document.getElementById('realbase-widget-btn-show'), 'click', showAndCreateIframe);
                };
            }
        }
        
        
        
        function getHashValue() {
            var widgetHash = window.location.hash;
            widgetHash = widgetHash.replace(hashToken, '');
            //var arr = widgetHash.split('/');
            //arr.splice(0,2);
            //widgetHash = '/' + arr.join('/');
            return widgetHash;
            // todo consider there is alresy hash in url
        }
        
        
        
        function setHashValue(newHash) {
            hashValue = hashToken + newHash;
            if(widgetState) {
                setWindowLocationHash();
            }
        }
        
        
        
        function setWindowLocationHash() {
            window.location.hash = hashValue;
        }
        
        
        
        function clearWindowLocationHash() {
            window.location.hash = '';
        }
        
        
        
        function createWidgetBtn() {
          var widgetBtn = document.createElement('div');
          widgetBtn.innerHTML = '<div class="mobile-hide-icon bottom-left" id="realbase-widget-btn-show" style="display:block;position:fixed;top:auto;left:4%;right:auto;bottom:2%;cursor:pointer;z-index:9999998;padding:8.5px 0;backgroud-color:red;">\
          							<span class="realbase-widget-title" style="background-color:#d83189;color:#FFFFFF">Обрати планування</span>\
          					</div>\
          					';
          document.body.appendChild(widgetBtn);
        }
        
        
        function createIframe() {
            let oldIframeWrap = document.getElementById('iframeWr');
            if(oldIframeWrap){
                oldIframeWrap.remove();
            }
            var widgetHash = getHashValue();
            var iframeWr = document.createElement('div');
            iframeWr.setAttribute('id', 'iframeWr');
            iframeWr.style.position = 'fixed';
            iframeWr.style.top = '0';
            iframeWr.style.left = '0';
            iframeWr.style.bottom = '0';
            iframeWr.style.right = '0';
            iframeWr.style.transform = 'translateX(100%)';
            iframeWr.style.transition = '1s';
            iframeWr.style.zIndex = '-1';
            iframeWr.innerHTML = "<iframe style='display:block; border:none; width:100%; min-height:100%;' id='iframeRealBase' name='iframeRealBase' src='http://realbase.dev.realist.digital" + widgetHash + "'></iframe>";
            document.body.appendChild(iframeWr);
        }
        
        
        
        
        function addListener(element, eventName, handler) {
            if (element.addEventListener) {
                element.addEventListener(eventName, handler, false);
            } else if (element.attachEvent) {
                element.attachEvent('on' + eventName, handler);
            } else {
                element['on' + eventName] = handler;
            }
        }
        
        
        
        
        function closeIframe(){
            var iframeWr = document.getElementById('iframeWr');
            var iframe = document.getElementById('iframe');
            document.body.ontouchmove = function(e){ return true; }
            document.body.style.position = 'inherit';
            document.body.style.overflow = 'inherit';
            iframeWr.style.transform = 'translateX(100%)';
            iframeWr.style.transition = '1s';
            clearWindowLocationHash();
            widgetState = false;
            setTimeout(function () { iframeWr.style.zIndex = '-1' }, 1000);
        }
        
        
        
       function showAndCreateIframe(){
            if(!widgetDefLoad){ // widgetDefLoad == false
                openIframe();
            }else{
                createIframe();
                openIframe();
            }
        }
        
        
        
        function showWidgetOnLinkClicked() {
          setTimeout(() => {
            createIframe();
            openIframe();
          }, 500);
        }
        
        
        
        function openIframe(){
            var iframeWr = document.getElementById('iframeWr');
            var iframe = document.getElementById('iframe');
            
            document.body.ontouchmove = function(e){ e.preventDefault(); }
            document.body.style.position = 'fixed';
            document.body.style.minWidth = '100%';
            document.body.style.maxWidth = '100%';
            document.body.style.overflow = 'hidden';
            iframeWr.style.zIndex = '10000002';
            iframeWr.style.transform = 'translateX(0%)';
            iframeWr.style.transition = '1s';
            widgetState = true;

                if(ga && ga.length) {
                  var tracker = getGaTracker();
                  if (tracker) {
                    ga(tracker.get('name')+'.send', 'event', 'widgetButtonClick', 'TFMainWidgetClicked');
                  }
                }
                /*if(ahoy){
                    trackAhoyEvent('show_domain');
                }*/
        }
            
            
            
        function getQueryParams(){
            queryParams = window.location.search.substr(1).split('&');
            if (queryParams == '') return {};
            var res = {};
            for (var i = 0; i < queryParams.length; ++i) {
                var p = queryParams[i].split('=', 2);
                if (p.length == 1)
                res[p[0]] = '';
                else
                res[p[0]] = decodeURIComponent(p[1].replace(/\+/g, ' '));
            }
            return res;
        }
        
        
        
        function sendClientIds() {
            /*var ahoyVisitId,
            	ahoyVisitorId;*/
        	if(ga && ga.length && getGaClientID){
            	var clientId = getGaClientID();
            	if(clientId){
            		var msg = { clientId : clientId };
              		senMessageToWidget(JSON.stringify(msg));
          		}
        	}
          	/*if(ahoy){
            	ahoyVisitorId = ahoy.getVisitorId();
            	ahoyVisitId = ahoy.getVisitId();
            	senMessageToWidget(JSON.stringify({
                	visitorId: ahoyVisitorId,
                	visitId: ahoyVisitId
              	}));
        	}*/
        }
        
        
        
        function senMessageToWidget(msg){
            var widgetUrl = 'http://realbase.dev.realist.digital/';
            document.getElementById('iframeRealBase').contentWindow.postMessage(msg, widgetUrl);
        }
        
        

        function openIframeIfLocationParamExist(){
            var locationParams = window.location.hash.split('/');
            if (locationParams == '') return {};
            var res = {};
            for (var i = 0; i < locationParams.length; ++i) {
                if(locationParams[i] == '#realbase') {
                    setTimeout(function () { 
                       showAndCreateIframe();
                    }, 1000);
                }
            }
        }
        
        
        
        function bindEvent(element, eventName, eventHandler) {
            if (element.addEventListener){
                element.addEventListener(eventName, eventHandler, false);
            } else if (element.attachEvent) {
                element.attachEvent('on' + eventName, eventHandler);
            }
        }
        
        
        
		function addScript( src ) {
			return new Promise(function(resolve, reject) {
		    var s = document.createElement('script');
		    s.onload = () => resolve(s);
		    s.onerror = () => reject(new Error(`Error while loading script ${src}`));
		    s.setAttribute('src', src);
		    s.setAttribute('async', true);
		    document.head.appendChild(s);
		    });
		}
            
            
        
        function getUtms(){
            var queryParams = getQueryParams();
            var res = {};
            var params = ['utm_source', 'utm_medium', 'utm_term', 'utm_content', 'utm_campaign'];
            for(var i=0; i < params.length; ++i){
                if(queryParams[params[i]]){
                    res[params[i]] = queryParams[params[i]];
                }
            }
            return res;
        }
        
        /*function trackAhoyEvent(name){
            var opts = getUtms();
            opts['domain_id']=domainId;
            ahoy.track(name, opts);
        }*/



        function getGaTracker() {
            var tracker = ga.getAll().filter(item => {
                if(item.get('trackingId') === gaTrackingId) {
                    return item;
                }
            });
          if(tracker){
              return tracker[0];
          }else{
            return null;
          }
        }
            
            
            
        function getGaClientID(){
            var tracker = getGaTracker();
            if (tracker) {
                var clientId = tracker.get('clientId');
                return clientId;
            } else {
                return null;
            }
        }
        
        
        

        
            
            
            
        function initAnalytics() {
            //var ahoyUrl = 'http://realbase.dev.realist.digital/public/js/ahoy.js';

            //let loadAhoyScript = addScript(ahoyUrl);

            (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date(); a = s.createElement(o),
                m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');


            var opts;
            /*window.ahoy = {
                urlPrefix: 'http://realbase.dev.realist.digital',
                //visitsUrl: '/ahoy/visits',
                visitsUrl: '/ru/registration/',
                //eventsUrl: '/ahoy/events',
                eventsUrl: '/ru/registration/',
                cookieDomain: null,
                page: window.location.href,
                platform: 'Web',
                useBeacon: false,
                startOnReady: true,
                trackVisits: true
            };

            loadAhoyScript.then(() => {
            	setTimeout(() => {
                	trackAhoyEvent('init_widget');
                }, 500);
            })*/
        }
        
        
        
        if(!widgetDefLoad){ // widgetDefLoad == false
            createIframe();
        }



        openIframeIfLocationParamExist();
        
        setStyles();
        
        
        
        var elements = document.getElementsByClassName('realbase-custom-widget-show');
        for (var i = 0; i < elements.length; i++) {
            elements[i].addEventListener('click', showWidgetOnLinkClicked);
        }
        
        
        
        bindEvent(window, 'message', function (e){
            if(!e.origin || e.origin.indexOf('realbase.dev.realist.digital')===-1){
                return;
            }
            if(e.data == 'close-realbase'){
                closeIframe();
                return;
            }
            if(e.data === 'widget-initialized'){
                sendClientIds();
                return;
            }
            if(e.data){
                setHashValue(e.data);
                
                
                if(gaTrackingId!=''){
	                var url_for_gtag = window.location.href.replace('http://kvartoblik.dev.realist.digital', '');
	                gtag('config', gaTrackingId, {'page_path': url_for_gtag});
				}
            }
        });
        
        
        
        if (getQueryParams()['realbasewidget'] === 'show') { // GET params
          showAndCreateIframe();
        }
        
        
        initAnalytics();
        
        
        
    };
    if(document.readyState == 'loading'){
        document.addEventListener('DOMContentLoaded', RealBaseInit);
    } else {
        RealBaseInit();
    }
})();