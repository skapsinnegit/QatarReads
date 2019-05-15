! function(e, t) {
    function n() {
        function n(t) {
            var n = t || e.event,
                o = n.keyCode || n.which;
            if (-1 !== [9, 13, 32, 27].indexOf(o)) {
                for (var r = n.target || n.srcElement, a = -1, i = 0; i < S.length; i++)
                    if (r === S[i]) {
                        a = i;
                        break
                    }
                9 === o ? (r = -1 === a ? w : a === S.length - 1 ? S[0] : S[a + 1], O(n), r.focus(), l(r, f.confirmButtonColor)) : (r = 13 === o || 32 === o ? -1 === a ? w : void 0 : 27 !== o || h.hidden || "none" === h.style.display ? void 0 : h, void 0 !== r && I(r, n))
            }
        }

        function i(t) {
            var n = t || e.event,
                o = n.target || n.srcElement,
                r = n.relatedTarget,
                a = v(m, "visible");
            if (a) {
                var i = -1;
                if (null !== r) {
                    for (var l = 0; l < S.length; l++)
                        if (r === S[l]) {
                            i = l;
                            break
                        } - 1 === i && o.focus()
                } else L = o
            }
        }
        if (void 0 === arguments[0]) return e.console.error("sweetAlert expects at least 1 attribute!"), !1;
        var f = a({}, y);
        switch (typeof arguments[0]) {
            case "string":
                f.title = arguments[0], f.text = arguments[1] || "", f.type = arguments[2] || "";
                break;
            case "object":
                if (void 0 === arguments[0].title) return e.console.error('Missing "title" argument!'), !1;
                f.title = arguments[0].title, f.text = arguments[0].text || y.text, f.type = arguments[0].type || y.type, f.customClass = arguments[0].customClass || f.customClass, f.allowOutsideClick = arguments[0].allowOutsideClick || y.allowOutsideClick, f.showCancelButton = void 0 !== arguments[0].showCancelButton ? arguments[0].showCancelButton : y.showCancelButton, f.closeOnConfirm = void 0 !== arguments[0].closeOnConfirm ? arguments[0].closeOnConfirm : y.closeOnConfirm, f.closeOnCancel = void 0 !== arguments[0].closeOnCancel ? arguments[0].closeOnCancel : y.closeOnCancel, f.timer = arguments[0].timer || y.timer, f.confirmButtonText = y.showCancelButton ? "Confirm" : y.confirmButtonText, f.confirmButtonText = arguments[0].confirmButtonText || y.confirmButtonText, f.confirmButtonColor = arguments[0].confirmButtonColor || y.confirmButtonColor, f.cancelButtonText = arguments[0].cancelButtonText || y.cancelButtonText, f.imageUrl = arguments[0].imageUrl || y.imageUrl, f.imageSize = arguments[0].imageSize || y.imageSize, f.doneFunction = arguments[1] || null;
                break;
            default:
                return e.console.error('Unexpected type of argument! Expected "string" or "object", got ' + typeof arguments[0]), !1
        }
        o(f), u(), c();
        for (var m = p(), d = function(t) {
            var n = t || e.event,
                o = n.target || n.srcElement,
                a = "confirm" === o.className,
                i = v(m, "visible"),
                l = f.doneFunction && "true" === m.getAttribute("data-has-done-function");
            switch (n.type) {
                case "mouseover":
                    a && (o.style.backgroundColor = r(f.confirmButtonColor, -.04));
                    break;
                case "mouseout":
                    a && (o.style.backgroundColor = f.confirmButtonColor);
                    break;
                case "mousedown":
                    a && (o.style.backgroundColor = r(f.confirmButtonColor, -.14));
                    break;
                case "mouseup":
                    a && (o.style.backgroundColor = r(f.confirmButtonColor, -.04));
                    break;
                case "focus":
                    var c = m.querySelector("button.confirm"),
                        u = m.querySelector("button.cancel");
                    a ? u.style.boxShadow = "none" : c.style.boxShadow = "none";
                    break;
                case "click":
                    if (a && l && i) f.doneFunction(!0), f.closeOnConfirm && s();
                    else if (l && i) {
                        var d = String(f.doneFunction).replace(/\s/g, ""),
                            y = "function(" === d.substring(0, 9) && ")" !== d.substring(9, 10);
                        y && f.doneFunction(!1), f.closeOnCancel && s()
                    } else s()
            }
        }, g = m.querySelectorAll("button"), b = 0; b < g.length; b++) g[b].onclick = d, g[b].onmouseover = d, g[b].onmouseout = d, g[b].onmousedown = d, g[b].onfocus = d;
        M = t.onclick, t.onclick = function(t) {
            var n = t || e.event,
                o = n.target || n.srcElement,
                r = m === o,
                a = B(m, o),
                i = v(m, "visible"),
                l = "true" === m.getAttribute("data-allow-ouside-click");
            !r && !a && i && l && s()
        };
        var w = m.querySelector("button.confirm"),
            h = m.querySelector("button.cancel"),
            S = m.querySelectorAll("button:not([type=hidden])");
        z = e.onkeydown, e.onkeydown = n, w.onblur = i, h.onblur = i, e.onfocus = function() {
            e.setTimeout(function() {
                void 0 !== L && (L.focus(), L = void 0)
            }, 0)
        }
    }

    function o(t) {
        var n = p(),
            o = n.querySelector("h2"),
            r = n.querySelector("p"),
            a = n.querySelector("button.cancel"),
            i = n.querySelector("button.confirm");
        if (o.innerHTML = h(t.title).split("\n").join("<br>"), r.innerHTML = h(t.text || "").split("\n").join("<br>"), t.text && C(r), t.customClass && b(n, t.customClass), k(n.querySelectorAll(".icon")), t.type) {
            for (var c = !1, s = 0; s < d.length; s++)
                if (t.type === d[s]) {
                    c = !0;
                    break
                }
            if (!c) return e.console.error("Unknown alert type: " + t.type), !1;
            var u = n.querySelector(".icon." + t.type);
            switch (C(u), t.type) {
                case "success":
                    b(u, "animate"), b(u.querySelector(".tip"), "animateSuccessTip"), b(u.querySelector(".long"), "animateSuccessLong");
                    break;
                case "error":
                    b(u, "animateErrorIcon"), b(u.querySelector(".x-mark"), "animateXMark");
                    break;
                case "warning":
                    b(u, "pulseWarning"), b(u.querySelector(".body"), "pulseWarningIns"), b(u.querySelector(".dot"), "pulseWarningIns")
            }
        }
        if (t.imageUrl) {
            var f = n.querySelector(".icon.custom");
            f.style.backgroundImage = "url(" + t.imageUrl + ")", C(f);
            var m = 80,
                y = 80;
            if (t.imageSize) {
                var g = t.imageSize.split("x")[0],
                    v = t.imageSize.split("x")[1];
                g && v ? (m = g, y = v, f.css({
                    width: g + "px",
                    height: v + "px"
                })) : e.console.error("Parameter imageSize expects value with format WIDTHxHEIGHT, got " + t.imageSize)
            }
            f.setAttribute("style", f.getAttribute("style") + "width:" + m + "px; height:" + y + "px")
        }
        n.setAttribute("data-has-cancel-button", t.showCancelButton), t.showCancelButton ? a.style.display = "inline-block" : k(a), t.cancelButtonText && (a.innerHTML = h(t.cancelButtonText)), t.confirmButtonText && (i.innerHTML = h(t.confirmButtonText)), i.style.backgroundColor = t.confirmButtonColor, l(i, t.confirmButtonColor), n.setAttribute("data-allow-ouside-click", t.allowOutsideClick);
        var w = t.doneFunction ? !0 : !1;
        n.setAttribute("data-has-done-function", w), n.setAttribute("data-timer", t.timer)
    }

    function r(e, t) {
        e = String(e).replace(/[^0-9a-f]/gi, ""), e.length < 6 && (e = e[0] + e[0] + e[1] + e[1] + e[2] + e[2]), t = t || 0;
        var n = "#",
            o, r;
        for (r = 0; 3 > r; r++) o = parseInt(e.substr(2 * r, 2), 16), o = Math.round(Math.min(Math.max(0, o + o * t), 255)).toString(16), n += ("00" + o).substr(o.length);
        return n
    }

    function a(e, t) {
        for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n]);
        return e
    }

    function i(e) {
        var t = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(e);
        return t ? parseInt(t[1], 16) + ", " + parseInt(t[2], 16) + ", " + parseInt(t[3], 16) : null
    }

    function l(e, t) {
        var n = i(t);
        e.style.boxShadow = "0 0 2px rgba(" + n + ", 0.8), inset 0 0 0 1px rgba(0, 0, 0, 0.05)"
    }

    function c() {
        var e = p();
        E(g(), 10), C(e), b(e, "showSweetAlert"), w(e, "hideSweetAlert"), A = t.activeElement;
        var n = e.querySelector("button.confirm");
        n.focus(), setTimeout(function() {
            b(e, "visible")
        }, 500);
        var o = e.getAttribute("data-timer");
        "null" !== o && "" !== o && (e.timeout = setTimeout(function() {
            s()
        }, o))
    }

    function s() {
        var n = p();
        q(g(), 5), q(n, 5), w(n, "showSweetAlert"), b(n, "hideSweetAlert"), w(n, "visible");
        var o = n.querySelector(".icon.success");
        w(o, "animate"), w(o.querySelector(".tip"), "animateSuccessTip"), w(o.querySelector(".long"), "animateSuccessLong");
        var r = n.querySelector(".icon.error");
        w(r, "animateErrorIcon"), w(r.querySelector(".x-mark"), "animateXMark");
        var a = n.querySelector(".icon.warning");
        w(a, "pulseWarning"), w(a.querySelector(".body"), "pulseWarningIns"), w(a.querySelector(".dot"), "pulseWarningIns"), e.onkeydown = z, t.onclick = M, A && A.focus(), L = void 0, clearTimeout(n.timeout)
    }

    function u() {
        var e = p();
        e.style.marginTop = T(p())
    }
    var f = ".sweet-alert",
        m = ".sweet-overlay",
        d = ["error", "warning", "info", "success"],
        y = {
            title: "",
            text: "",
            type: null,
            allowOutsideClick: !1,
            showCancelButton: !1,
            closeOnConfirm: !0,
            closeOnCancel: !0,
            confirmButtonText: "OK",
            confirmButtonColor: "#AEDEF4",
            cancelButtonText: "Cancel",
            imageUrl: null,
            imageSize: null,
            timer: null
        },
        p = function() {
            return t.querySelector(f)
        },
        g = function() {
            return t.querySelector(m)
        },
        v = function(e, t) {
            return new RegExp(" " + t + " ").test(" " + e.className + " ")
        },
        b = function(e, t) {
            v(e, t) || (e.className += " " + t)
        },
        w = function(e, t) {
            var n = " " + e.className.replace(/[\t\r\n]/g, " ") + " ";
            if (v(e, t)) {
                for (; n.indexOf(" " + t + " ") >= 0;) n = n.replace(" " + t + " ", " ");
                e.className = n.replace(/^\s+|\s+$/g, "")
            }
        },
        h = function(e) {
            var n = t.createElement("div");
            return n.appendChild(t.createTextNode(e)), n.innerHTML
        },
        S = function(e) {
            e.style.opacity = "", e.style.display = "block"
        },
        C = function(e) {
            if (e && !e.length) return S(e);
            for (var t = 0; t < e.length; ++t) S(e[t])
        },
        x = function(e) {
            e.style.opacity = "", e.style.display = "none"
        },
        k = function(e) {
            if (e && !e.length) return x(e);
            for (var t = 0; t < e.length; ++t) x(e[t])
        },
        B = function(e, t) {
            for (var n = t.parentNode; null !== n;) {
                if (n === e) return !0;
                n = n.parentNode
            }
            return !1
        },
        T = function(e) {
            e.style.left = "-9999px", e.style.display = "block";
            var t = e.clientHeight,
                n;
            return n = "undefined" != typeof getComputedStyle ? parseInt(getComputedStyle(e).getPropertyValue("padding"), 10) : parseInt(e.currentStyle.padding), e.style.left = "", e.style.display = "none", "-" + parseInt(t / 2 + n) + "px"
        },
        E = function(e, t) {
            if (+e.style.opacity < 1) {
                t = t || 16, e.style.opacity = 0, e.style.display = "block";
                var n = +new Date,
                    o = function() {
                        e.style.opacity = +e.style.opacity + (new Date - n) / 100, n = +new Date, +e.style.opacity < 1 && setTimeout(o, t)
                    };
                o()
            }
            e.style.display = "block"
        },
        q = function(e, t) {
            t = t || 16, e.style.opacity = 1;
            var n = +new Date,
                o = function() {
                    e.style.opacity = +e.style.opacity - (new Date - n) / 100, n = +new Date, +e.style.opacity > 0 ? setTimeout(o, t) : e.style.display = "none"
                };
            o()
        },
        I = function(n) {
            if (MouseEvent) {
                var o = new MouseEvent("click", {
                    view: e,
                    bubbles: !1,
                    cancelable: !0
                });
                n.dispatchEvent(o)
            } else if (t.createEvent) {
                var r = t.createEvent("MouseEvents");
                r.initEvent("click", !1, !1), n.dispatchEvent(r)
            } else t.createEventObject ? n.fireEvent("onclick") : "function" == typeof n.onclick && n.onclick()
        },
        O = function(t) {
            "function" == typeof t.stopPropagation ? (t.stopPropagation(), t.preventDefault()) : e.event && e.event.hasOwnProperty("cancelBubble") && (e.event.cancelBubble = !0)
        },
        A, M, z, L;
    e.sweetAlertInitialize = function() {
        var e = '<div class="sweet-overlay" tabIndex="-1"></div><div class="sweet-alert" tabIndex="-1"><div class="icon error"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning"> <span class="body"></span> <span class="dot"></span> </div> <div class="icon info"></div> <div class="icon success"> <span class="line tip"></span> <span class="line long"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom"></div> <h2>Title</h2><p>Text</p><button class="cancel" tabIndex="2">Cancel</button><button class="confirm" tabIndex="1">OK</button></div>',
            n = t.createElement("div");
        n.innerHTML = e, t.body.appendChild(n)
    }, e.sweetAlert = e.swal = function() {
        var e = arguments;
        if (null !== p()) n.apply(this, e);
        else var t = setInterval(function() {
            null !== p() && (clearInterval(t), n.apply(this, e))
        }, 100)
    }, e.swal.setDefaults = function(e) {
        if (!e) throw new Error("userParams is required");
        if ("object" != typeof e) throw new Error("userParams has to be a object");
        a(y, e)
    },
        function() {
            "complete" === t.readyState || "interactive" === t.readyState && t.body ? e.sweetAlertInitialize() : t.addEventListener ? t.addEventListener("DOMContentLoaded", function n() {
                t.removeEventListener("DOMContentLoaded", arguments.callee, !1), e.sweetAlertInitialize()
            }, !1) : t.attachEvent && t.attachEvent("onreadystatechange", function() {
                "complete" === t.readyState && (t.detachEvent("onreadystatechange", arguments.callee), e.sweetAlertInitialize())
            })
        }()
}(window, document);