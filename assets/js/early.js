;(function(global) {
    "use strict";

    var stopTimer = false,
        timerContainer, // = document.querySelector('.timer-container'),
        timerDisplay, // = document.querySelector('.timer-display', timerContainer),
        fadingTimer = false,
        start = Date.now();

    // Create the elements and display them
    timerContainer = document.createElement('div');
    timerDisplay = document.createElement('div');
    timerContainer.classList.add('timer-container');
    timerDisplay.classList.add('timer-display');
    timerContainer.appendChild(timerDisplay);
    document.querySelector('body').appendChild(timerContainer);

    global.early = {
        late: function() {
            if ($ && $.ajaxloadmore && window.useloadmore) {
                // AjaxLoadMore shim
                shimAjaxLoadMore('almComplete');
                shimAjaxLoadMore('almDone');
                shimAjaxLoadMore('almEmpty');
            } else {
                setTimeout(function() {
                    $(document).trigger('almComplete-shim');
                }, 1500);
            }
        },
        hide: function() {
            $(timerContainer).fadeOut(function() {
                stopTimer = true;
            });
        },
        done: completeHandler
    };

    window.requestAnimationFrame(function frame() {
        var diff = Date.now() - global.pageStartTime,
            h = Math.floor(diff / (1000 * 60 * 60)) % 24,
            m = Math.floor(diff / (1000 * 60)) % 60,
            s = Math.floor(diff / (1000)) % 60,
            t = diff % 1000,
            tm = ('0' + m.toString()).substr(-2),
            ts = ('0' + s.toString()).substr(-2),
            tt = ('00' + t.toString()).substr(-3),
            r = h + ':' + tm + ':' + ts + '.' + tt;

        if (stopTimer) {
            return;
        }

        timerDisplay.innerHTML = r
            .replace('&', '&amp;')
            .replace('<', '&lt;')
            .replace('"', '&quot;');

        window.requestAnimationFrame(frame);
    });

    $(document).one('almComplete-shim almEmpty-shim', completeHandler);

    function completeHandler() {
        var waitExpect = 0,
            waitGot = 0,
            imageLoadedHandler = function(event) {
                if (!event || ++waitGot === waitExpect) {
                    window.early.hide();
                }
            };

        $('img').each(function() {
            var elem = $(this);
            if (!elem.prop('complete')) {
                ++waitExpect;
                elem.one('load', imageLoadedHandler);
            }
        });

        if (waitExpect === 0)
            imageLoadedHandler(null);
    }

    function shimAjaxLoadMore(name) {
        $.fn[name] = function() {
            var args = Array.prototype.slice.call(arguments);
            $(document).trigger(name + '-shim', args);
        };
    }
}(this));