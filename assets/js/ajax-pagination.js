(function($) {
  $(function() {
    "use strict";

    $(document).on("click", ".ajax-post-link", function(event) {
      event.preventDefault();

      $.ajax({
        url: ajaxpagination.ajaxurl,
        type: "post",
        data: {
          action: "ajax_pagination",
          query_vars: ajaxpagination.query_vars
        },
        success: function(html) {
          $("#content").append(html);
        }
      });
    });
  }); // end of document ready
})(jQuery); // end of jQuery name space
