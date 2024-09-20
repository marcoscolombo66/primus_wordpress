(function() {
    
    var links = document.getElementsByClassName('primus-login-menu');
    var form = document.getElementById('primus-login');
    
    var closeButton = document.getElementById('primus-login-close');
    var loginButton = document.getElementById('primus-login-button');
    //modal
    var modal = document.getElementById("primus-login-modal");
    var modalContent = document.getElementById('primus-login-modal-body');
    var modalClose = document.getElementsByClassName("primus-login-modal-close")[0];
    
    function addListenerToLinkLogin(link) {
        link.addEventListener('click', function (e) {
            if (window.logged == true){
                window.location = '/PRIMUS/trunk/';
            }
            else{
                var prevCookie =  jQuery.cookie("rememberPrimus");
                if (prevCookie) {
                    document.getElementById('primus-login-remember').checked = true;
                    document.getElementById('primus-login-username').value = jQuery.cookie("usernamePrimus"),
                    document.getElementById('primus-login-password').value = jQuery.cookie("passwordPrimus");
                    //callLogin(false);
                }
                form.classList.remove('hide');
                form.classList.add('visible');
                e.preventDefault();
            }
        })
    }
    
    for (var index = 0; index < links.length; index++) {
        var element = links[index];
        addListenerToLinkLogin(element);
    }

    closeButton.addEventListener('click', function (e) {
        form.classList.remove('visible');
        form.classList.add('hide');
        e.preventDefault();
    });

    modalClose.addEventListener('click', function (e) {
        modal.style.display = "none";
        e.preventDefault();
    });

    loginButton.addEventListener('click', function (e) {
        e.preventDefault();
        // var prevCookie =  jQuery.cookie("rememberPrimus");
        // if (prevCookie) {
        //     document.getElementById('primus-login-remember').checked = true;
        //     document.getElementById('primus-login-username').value = jQuery.cookie("usernamePrimus"),
        //     document.getElementById('primus-login-password').value = jQuery.cookie("passwordPrimus");
        // }
        callLogin(false);
        e.preventDefault();
    });

    function callLogin(logout) {
        var remember = document.getElementById('primus-login-remember').checked;
        if (remember) {
            var user = document.getElementById('primus-login-username').value;
            var password = document.getElementById('primus-login-password').value;
            jQuery.cookie("usernamePrimus", user, {
                expires: 14,
                path: "/"
            }), jQuery.cookie("passwordPrimus", password, {
                expires: 14,
                path: "/"
            }), jQuery.cookie("rememberPrimus", true, {
                expires: 14,
                path: "/"
            })
        } else {
            jQuery.cookie("usernamePrimus", null, {path: "/"}), jQuery.cookie("passwordPrimus", null, {path: "/"}), jQuery.cookie("rememberPrimus", null, {path: "/"})
        }
        var loading = '<div style="display: flex;text-align: center;align-items: center;width: 260px;margin: 0 auto;">Sending Credentials...<div class="sk-folding-cube sk-folding-cube-inline sk-folding-cube-small"><div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div></div>';

        modalContent.innerHTML = loading;
        modal.style.display = "block";

        var data = {
            action: "login",
            logout: logout,
            loginUsername: document.getElementById('primus-login-username').value,
            loginPassword: document.getElementById('primus-login-password').value,
            browser: BrowserDetect.browser,
            browserVersion: BrowserDetect.version,
            os: BrowserDetect.OS
        }

        jQuery.post('/PRIMUS/trunk/manage.php', data, function(data) {
            var obj = eval("(" + data + ")");
            if (!obj.success) {
                if ("duplicatedSession" === obj.errorType) {
                    showLoginDuplicatedSession(obj);
                } else {
                    modalContent.innerHTML = obj.message;
                    modal.style.display = "block";
                    jQuery.cookie("usernamePrimus", null, {path: "/"}), jQuery.cookie("passwordPrimus", null, {path: "/"}), jQuery.cookie("rememberPrimus", null, {path: "/"})
                }
            } else {
                if (obj.redirect) {
                    window.location = obj.redirect;
                } else {                    
                    // window.location = location.host.includes('dev') || location.host.includes('localhost') ? 'http://dev.shipprimus.com/PRIMUS/trunk/' : 'https://shipprimus.com/PRIMUS/trunk/';
                    window.location = '/PRIMUS/trunk/';
                }
            }
        }).fail(function(xhr, status, error) { 
            console.log(status, error) 
        });
    }

    function showLoginDuplicatedSession(obj) {
        var modalResult = '<div class="modal-content">You have another session started in this browser.<br/> Click <a id="login-othe" class="login-other link-primary-dark" href="javascript:void(0)" style="color:#00BBFF;">here</a> to login with ' + obj.userName + "</div>";
        modalContent.innerHTML = modalResult;
        modal.style.display = "block";
        jQuery("#login-other").on("click", function() {
            callLogin(true);
        });
    }

    jQuery.cookie = function(name, value, options) {
        if (typeof value != 'undefined') { // name and value given, set cookie
            options = options || {};
            if (value === null) {
                value = '';
                options.expires = -1;
            }
            var expires = '';
            if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
                var date;
                if (typeof options.expires == 'number') {
                    date = new Date();
                    date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
                } else {
                    date = options.expires;
                }
                expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
            }
            // CAUTION: Needed to parenthesize options.path and options.domain
            // in the following expressions, otherwise they evaluate to undefined
            // in the packed version for some reason...
            var path = options.path ? '; path=' + (options.path) : '';
            var domain = options.domain ? '; domain=' + (options.domain) : '';
            var secure = options.secure ? '; secure' : '';
            document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
        } else { // only name given, get cookie
            var cookieValue = null;
            if (document.cookie && document.cookie != '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = jQuery.trim(cookies[i]);
                    // Does this cookie string begin with the name we want?
                    if (cookie.substring(0, name.length + 1) == (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }
    };
}());