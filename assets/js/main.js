(function(global) {
  "use strict";

  var kffaderStyleElems = {},
    kffaderNextUnique = 0;
  $.fn.kffader = function() {
    this.each(function() {
      var elem = $(this),
        opts = JSON.parse(elem.attr("data-kffader") || "{}"),
        sel = opts.sel || "img",
        allImgs = elem.find(sel),
        imgs,
        count,
        name = opts.name,
        time = opts.time,
        fade = opts.fade,
        showTime = time - fade,
        fadePercent = 100 * fade / time,
        totalTime,
        rules,
        style,
        old,
        firstNotLoaded;

      allImgs.toArray().some(function(img, i) {
        var elem = $(img),
          complete = elem.prop("complete");
        if (complete !== undefined && !complete) {
          firstNotLoaded = i;
          return true;
        }
      });

      if (firstNotLoaded !== undefined) {
        allImgs = allImgs.slice(0, firstNotLoaded);
      }

      imgs = allImgs.filter(function() {
        var c = $(this).prop("complete");
        return c === undefined || c;
      });
      count = imgs.length;
      totalTime = time * count;

      name = makeUnique(name);

      imgs.each(function(i) {
        var img = $(this);
        img.css({
          "animation-delay": i * time + "s",
          "animation-duration": totalTime + "s",
          "animation-name": name
        });
      });

      var fis = 0,
        fie = fis + fadePercent,
        fos = 100 / count,
        foe = fos + fadePercent;
      if (count > 1) {
        rules = [
          [
            "@keyframes ",
            name,
            " {",
            "from {opacity: 0;}",
            fis,
            "% {opacity: 0;}",
            fie,
            "% {opacity: 1;}",
            fos,
            "% {opacity: 1;}",
            foe,
            "% {opacity: 0;}",
            "to {opacity: 0;}",
            "}"
          ].join("")
        ];
      } else {
        rules = [
          [
            "@keyframes ",
            name,
            " {",
            "from {opacity: 1;}",
            "to {opacity: 1;}",
            "}"
          ].join("")
        ];
      }
      rules.push(rules[0].replace("@keyframes", "@-webkit-keyframes"));

      rules = rules.join("\n");

      if (Object.prototype.hasOwnProperty.call(kffaderStyleElems, name))
        kffaderStyleElems[name].remove();
      kffaderStyleElems[name] = $("<style/>", {
        html: rules,
        appendTo: "head"
      });

      function makeUnique(name) {
        return name + "-" + ("0000" + kffaderNextUnique++).substr(-4);
      }
    });
  };
})(this);
(function($, window) {
  $(function($) {
    "use strict";

    function updateSlideshowKeyframes(event) {
      var target = $(event.target),
        container = target.closest("[data-kffader]");
      if (container.length > 0) container.kffader();
    }

    $.fn.almDone = function() {
      var loadMore = $("#load-more");

      if ($("body").hasClass("en-US")) {
        loadMore.text("Back to top");
      } else {
        loadMore.text("Retour en haut");
      }

      loadMore.addClass("btn-done");

      var loadDone = $(".btn-done");

      loadDone.click(function() {
        $("html,body").animate({ scrollTop: 0 }, 500);
      });
    };

    function pauseAll() {
      $('iframe[src*="vimeo.com"]').each(function() {
        $f(this).api("unload");
      });
    }

    $(document).on("almComplete-shim almDone-shim", function(event, alm) {
      $(".post-slides").addClass("hidden");

      setTimeout(function() {
        pauseAll();
      }, 1000);

      if (!Modernizr.touchevents) {
        // var masonryInit = true; // set Masonry init flag
        // if ($(".masonry-grid").length) {
        //   var $container = $(".alm-listing"); // our container
        //   if (masonryInit) {
        //     // initialize Masonry only once
        //     masonryInit = false;
        //     $container.masonry({
        //       itemSelector: ".alm-repeater-template",
        //       gutter: 0
        //     });
        //   } else {
        //     $container.masonry("reloadItems"); // Reload masonry items oafter callback
        //   }
        //   $container.imagesLoaded(function() {
        //     // When images are loaded, fire masonry again.
        //     $container.masonry();
        //   });
        // }
      }

      //keep one animation running until another one gets hovered
      if ($("body").hasClass("page-id-23")) {
        $(".entry-content:nth-child(4) .post-slides").removeClass("hidden");
        $(".entry-content").on("mouseenter", function() {
          $(".entry-content:nth-child(4) .post-slides").addClass("hidden");
        });
      }

      if ($("body").hasClass("page-id-25")) {
        $(".entry-content:nth-child(6) .post-slides").removeClass("hidden");
        $(".entry-content").on("mouseenter", function() {
          $(".entry-content:nth-child(6) .post-slides").addClass("hidden");
        });
      }

      //remove img titles on hover
      $("*").removeAttr("title");

      var dior = $('a[href*="dior"]');

      $(".alm-reveal .entry-content")
        .off("mouseenter.almComplete")
        .on("mouseenter.almComplete", function(event) {
          $(this)
            .find(".post-slides.hidden")
            .removeClass("hidden");

          $(this)
            .find('iframe[src*="vimeo.com"]')
            .each(function() {
              $f(this).api("play");
            });
        })
        .off("mouseleave.almComplete")
        .on("mouseleave.almComplete", function(event) {
          $(this)
            .find(".post-slides")
            .addClass("hidden");

          $(this)
            .find('iframe[src*="vimeo.com"]')
            .each(function() {
              $f(this).api("unload");
            });
        });

      $("img")
        .not(".kffader-waiting")
        .addClass("kffader-waiting")
        .on("load", updateSlideshowKeyframes);

      $("[data-kffader]").kffader();
    });

    $(".lang-item > a").text(function() {
      return $(this)
        .attr("hreflang")
        .substr(0, 2)
        .toUpperCase();
    });
    $("ul.hidden .lang-item-en > a")
      .closest("ul.hidden")
      .removeClass("hidden");
    //$('a[href=""][hreflang]').attr('href', function() {
    //    return location.href;
    //});

    if (!$ || !$.ajaxloadmore) window.early.done();

    var debug = 1 ? console.log.bind(console) : $.noop;
    $("[data-customaction]").each(function() {
      var elem = $(this),
        command = elem.attr("data-customaction");

      command.split(/,\s*/).forEach(function(command) {
        var parse = command.match(
            /^\s*([a-zA-Z0-9_]+)\(([^\)]+)\)\s+of\s+(.*?)\s+on\s+(\S+)\s*$/
          ),
          verb = parse && parse[1],
          args = parse && parse[2],
          victimSelector = parse && parse[3],
          eventNameSlashList = parse && parse[4],
          eventNames = eventNameSlashList.split("/"),
          eventSpaceList = eventNames.join(" ");

        if (!parse)
          throw new Error('invalid customaction command: "' + command + '"');

        //if (victims.length === 0)
        //    debug('warning, customaction matches no elements: ', command);

        elem.on(eventSpaceList, function(event) {
          if (!elem.is(event.target)) {
            //debug('did not match');
            return;
          }

          var argArray = (args.length && args.split(",")) || [],
            victims = (victimSelector === "this" && elem) || $(victimSelector);
          argArray = argArray.map(function(item, index, argArray) {
            if (item === "this") return elem[0];
            else if (item === "$(this)") return elem;
            return item;
          });

          victims[verb].apply(victims, argArray);
        });
      });
    });

    $(document).on("submit", "form[name=mailchimp-subscribe]", function(event) {
      event.preventDefault();
      var form = $(event.target),
        emailField = form.find("input[name=email]"),
        email = emailField.val(),
        fname = form.find("input[name=fname]").val(),
        lname = form.find("input[name=lname]").val();
      if (email && email.length) {
        $.post("/wp-admin/admin-ajax.php", {
          action: "subscribe",
          email: email,
          fname: fname,
          lname: lname
        }).then(
          function(response) {
            $(".mailchimp-msg").addClass("hidden");
            $(".mailchimp-success").removeClass("hidden");
          },
          function(err) {
            var detail = (err && err.detail) || "";
            $(".mailchimp-msg").addClass("hidden");
            if (detail.indexOf("invalid") >= 0)
              $(".mailchimp-invalid").removeClass("hidden");
            else if (detail.indexOf("exists") >= 0)
              $(".mailchimp-exists").removeClass("hidden");
            else $(".mailchimp-generic").removeClass("hidden");
          }
        );
      } else {
        emailField.focus();
      }
    });

    // the event needs to be run before slick is initialized
    if (!($(".slider .slick-slide").length > 1)) {
      // autoplay video after 3s
      if (!Modernizr.touchevents) {
        if ($(".single-video-wrapper").length) {
          console.log("rdy");
          var iframe = $("#player1")[0];
          var player = $f(iframe);

          player.addEvent("ready", function() {
            player.api("pause");
            setTimeout(function() {
              player.api("play");
              player.api("setVolume", 1);
              player.api("pause");
            }, 3000);
          });
        }
      }
    }

    $(".slider").on("init", function(event, slick) {
      if ($(".single-video-wrapper").length) {
        var iframe = $("#player1")[0];
        var player = $f(iframe);

        if ($(".slick-track > img.slick-slide").length) {
          player.addEvent("ready", function() {
            player.api("pause");
            setTimeout(function() {
              player.api("play");
              player.api("setVolume", 1);
              player.api("pause");
            }, 3000);
          });
        } else {
          player.addEvent("ready", function() {
            player.api("pause");
            setTimeout(function() {
              player.api("play");
              player.api("setVolume", 1);
            }, 3000);
          });
        }
      }
    });

    $(".slider").on("afterChange", function(event, slick, currentSlide) {
      $(this)
        .find('iframe[src*="vimeo.com"]')
        .each(function() {
          $f(this).api("setVolume", 0);
        });
      if ($(".slider .single-video-wrapper").hasClass("slick-active")) {
        $(".single-video-wrapper.slick-active")
          .find('iframe[src*="vimeo.com"]')
          .each(function() {
            $f(this).api("play");
            $f(this).api("setVolume", 1);
          });
      } else {
        $(this)
          .find('iframe[src*="vimeo.com"]')
          .each(function() {
            $f(this).api("unload");
          });
      }
    });

    $(".slider").slick({
      dots: true,
      infinite: true,
      speed: 500,
      fade: true,
      cssEase: "linear",
      adaptiveHeight: true
    });

    //Add active state to menu items when in single.php
    if ($(".type-post").hasClass("category-work")) {
      $("#menu-item-93").addClass("current_page_item");
    } else if ($(".type-post").hasClass("category-art")) {
      $("#menu-item-35").addClass("current_page_item");
    }

    if (!Modernizr.touchevents) {
      var left = $(".slick-prev"),
        right = $(".slick-next"),
        cursorLeft = $(".cursorleft"),
        cursorRight = $(".cursorright"),
        slide = $(".slick-list"),
        leftAdjTop = -10, // left-right adj left
        leftAdjLeft = -10, // up-down adj left
        rightAdjTop = -10, // left-right adj right
        rightAdjLeft = -10; // up-down adj right

      left
        .on("mouseout", function(event) {
          cursorLeft.hide();
        })
        .on("mouseenter", function(event) {
          cursorLeft.show();
        })
        .on("mousemove", function(event) {
          var ofsParent = $(this).offsetParent(),
            ofs = ofsParent.offset();
          cursorLeft.css({
            top: event.pageY - ofs.top + leftAdjTop + "px",
            left: event.pageX - ofs.left + leftAdjLeft + "px"
          });
        });

      right
        .on("mouseout", function(event) {
          cursorRight.hide();
        })
        .on("mouseenter", function(event) {
          cursorRight.show();
        })
        .on("mousemove", function(event) {
          var ofsParent = slide.offsetParent(),
            ofs = ofsParent.offset();
          cursorRight.css({
            top: event.pageY - ofs.top + rightAdjTop + "px",
            left: event.pageX - ofs.left + rightAdjLeft + "px"
          });
        });

      $(".slick-dots").on("mouseenter mouseleave", "button", function(event) {
        $(this)
          .closest("ul")
          .toggleClass("js", event.type == "mouseenter");
      });
    }

    // console.log("scrollll");
    // $(window).on("scroll", function(ev) {
    //   if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    //     $(".alm-load-more-btn").trigger("click");
    //   }
    // });
  }); // end of document ready
})(jQuery, window); // end of jQuery name space
