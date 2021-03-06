/*!
* jQuery showDialog
* befen.net
* Date: 2012.10.05
*/

function detectMacXFF() {
    var userAgent = navigator.userAgent.toLowerCase();
    if (userAgent.indexOf("mac") != -1 && userAgent.indexOf("firefox") != -1) {
        return true;
    }
}

function in_array(needle, haystack) {
    if (typeof needle == "string" || typeof needle == "number") {
        for (var i in haystack) {
            if (haystack[i] == needle) {
                return true;
            }
        }
    }
    return false;
}

function sd_load(sd_width) {
    if (sd_width) {
        $("#SD_window").css("width", sd_width + "px");
    }
    var isIE = (document.all) ? true : false;
    var isIE6 = isIE && ([/MSIE (\d)\.0/i.exec(navigator.userAgent)][0][1] == 6);
    var newbox = document.getElementById("SD_window");
    newbox.style.zIndex = "9999";
    newbox.style.display = "block"
    newbox.style.position = !isIE6 ? "fixed" : "absolute";
    newbox.style.top = newbox.style.left = "50%";
    newbox.style.marginTop = -newbox.offsetHeight / 2 + "px";
    newbox.style.marginLeft = -newbox.offsetWidth / 2 + "px";
    function newbox_iestyle() {
        newbox.style.marginTop = document.documentElement.scrollTop - newbox.offsetHeight / 2 + "px";
        newbox.style.marginLeft = document.documentElement.scrollLeft - newbox.offsetWidth / 2 + "px";
    }

    if (isIE6) {
        newbox_iestyle();
        window.attachEvent("onscroll", function() {
            newbox_iestyle();
        })
    }
}

function sd_remove() {
    $("#SD_close,#SD_cancel,#SD_confirm").unbind("click");
    $("#SD_window,#SD_overlay,#SD_HideSelect").remove();
    if (typeof document.body.style.maxHeight == "undefined") {
        $("body", "html").css({ height: "auto", width: "auto" });
    }
}

function showDialog(mode, msg, t, sd_width) {
    var sd_width = sd_width ? sd_width : 400;
    var mode = in_array(mode, ['confirm', 'window', 'info', 'loading']) ? mode : 'alert';
    var t = t ? t : "House5 提示信息";
    var msg = msg ? msg : "";
    var confirmtxt = confirmtxt ? confirmtxt : "确定";
    var canceltxt = canceltxt ? canceltxt : "取消";
    sd_remove();
    try {
        if (typeof document.body.style.maxHeight === "undefined") {
            $("body", "html").css({ height: "100%", width: "100%" });
            if (document.getElementById("SD_HideSelect") === null) {
                $("body").append("<iframe id='SD_HideSelect'></iframe><div id='SD_overlay'></div>");
            }
        } else {
            if (document.getElementById("SD_overlay") === null) {
                $("body").append("<div id='SD_overlay'></div>");
            }
        }

        if (detectMacXFF()) {
            $("#SD_overlay").addClass("SD_overlayMacFFBGHack");
        } else {
            $("#SD_overlay").addClass("SD_overlayBG");
        }

        $("body").append("<div id='SD_window'></div>");
        var SD_html;
        SD_html = "";
        SD_html += "<table cellspacing='0' cellpadding='0'><tbody><tr><td class='SD_bg'></td><td class='SD_bg'></td><td class='SD_bg'></td></tr>";
        SD_html += "<tr><td class='SD_bg'></td>";
        SD_html += "<td id='SD_container'>";
        SD_html += "<h3 id='SD_title'>" + t + "</h3>";
        SD_html += "<div id='SD_body'><div id='SD_content'>" + msg + "</div></div>";
        SD_html += "<div id='SD_button'><div class='SD_button'>";
        SD_html += "<a id='SD_confirm'>" + confirmtxt + "</a>";
        SD_html += "<a id='SD_cancel'>" + canceltxt + "</a>";
        SD_html += "</div></div>";
        SD_html += "<a href='javascript:;' id='SD_close'</a>";
        SD_html += "</td>";
        SD_html += "<td class='SD_bg'></td></tr>";
        SD_html += "<tr><td class='SD_bg'></td><td class='SD_bg'></td><td class='SD_bg'></td></tr></tbody></table>";
        $("#SD_window").append(SD_html);
        $("#SD_confirm,#SD_cancel,#SD_close").bind("click", function() {
            sd_remove();
        });
        if (mode == "info" || mode == "alert") {
            $("#SD_cancel").hide();
            $("#SD_button").show();
        }
        if (mode == "window") {
            $("#SD_close").show();
        }
        if (mode == "confirm") {
            $("#SD_button").show();
        }

        $("#SD_body").width(sd_width - 50);
        sd_load(sd_width);
        $("#SD_window").show();
        $("#SD_window").focus();
    } catch (e) {
        alert("System Error !");
    }
}

function showInfo(msg, fn, timeout) {
    showDialog("info", msg);
    $("#SD_confirm").unbind("click");
    if (fn && timeout) {
        st = setTimeout(function() {
            sd_remove();
            fn();
        }, timeout * 1000);
    }
    $("#SD_confirm").bind("click", function() {
        if (timeout) {
            clearTimeout(st);
        }
        sd_remove();
        if (fn) {
            fn();
        }
    });
}

function showWindow(title, the_url, sd_width) {
    var sd_width = sd_width ? sd_width : 400;
    $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        timeout: 10000,
        url: the_url,
        data: "isajax=1",
        success: function(data) {
            showDialog("window", data, title, sd_width);
        },
        error: function(data) {
            showDialog("alert", "<div class='error'>读取数据失败！</div>");
        },
        beforeSend: function(data) {
            showDialog("loading", "<div class='loadding'>正在努力加载数据...</div>");
        }
    });
}

function showConfirm(msg, fn) {
    showDialog("confirm", msg);
    $("#SD_confirm").unbind("click");
    $("#SD_confirm").bind("click", function() {
        if (fn) {
            fn();
        }
    });
}