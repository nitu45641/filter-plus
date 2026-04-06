(function ($) {
  "use strict";

  $(document).ready(function () {
    var $modal = $("#filter-plus-deactivation-modal");
    var deactivateUrl = "";

    // Intercept the deactivate link click for this plugin
    $(
      'tr[data-slug="' +
        filter_plus_deactivation.slug +
        '"] .deactivate a, tr[data-plugin="' +
        filter_plus_deactivation.slug +
        '/filter-plus.php"] .deactivate a'
    ).on("click", function (e) {
      e.preventDefault();
      deactivateUrl = $(this).attr("href");
      $modal.fadeIn(200);
    });

    // Close modal on overlay click
    $modal
      .find(".filter-plus-deactivation-modal-overlay")
      .on("click", function () {
        $modal.fadeOut(200);
      });

    // Show/hide detail input based on selected reason
    $modal
      .find('input[name="filter_plus_deactivation_reason"]')
      .on("change", function () {
        $modal.find(".filter-plus-deactivation-detail").slideUp(150);

        var $detail = $(this)
          .closest("li")
          .find(".filter-plus-deactivation-detail");
        if ($detail.length) {
          $detail.slideDown(150).focus();
        }

        $modal
          .find(".filter-plus-deactivation-submit")
          .prop("disabled", false);
      });

    // Skip & Deactivate
    $modal.find(".filter-plus-deactivation-skip").on("click", function () {
      window.location.href = deactivateUrl;
    });

    // Submit & Deactivate
    $modal.find(".filter-plus-deactivation-submit").on("click", function () {
      var $btn = $(this);
      var reason = $modal
        .find('input[name="filter_plus_deactivation_reason"]:checked')
        .val();
      var detail = $modal
        .find('input[name="filter_plus_deactivation_reason"]:checked')
        .closest("li")
        .find(".filter-plus-deactivation-detail")
        .val();

      if (!reason) {
        window.location.href = deactivateUrl;
        return;
      }

      $btn.text("Submitting...").prop("disabled", true);

      $.ajax({
        url: filter_plus_deactivation.ajax_url,
        type: "POST",
        data: {
          action: "filter_plus_deactivation_feedback",
          nonce: filter_plus_deactivation.nonce,
          reason: reason,
          detail: detail || "",
        },
        complete: function () {
          window.location.href = deactivateUrl;
        },
      });
    });
  });
})(jQuery);
