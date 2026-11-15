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

    // Close modal: overlay, X button, or Esc key
    function closeModal() {
      $modal.fadeOut(200);
    }
    $modal
      .find(".filter-plus-deactivation-modal-overlay, .filter-plus-deactivation-close")
      .on("click", closeModal);
    $(document).on("keydown", function (e) {
      if (e.key === "Escape" && $modal.is(":visible")) {
        closeModal();
      }
    });

    // Highlight selected row
    $modal
      .find('input[name="filter_plus_deactivation_reason"]')
      .on("change", function () {
        $modal.find(".filter-plus-deactivation-reasons li").removeClass("is-selected");
        $(this).closest("li").addClass("is-selected");

        // Enable submit button
        $modal.find(".filter-plus-deactivation-submit").prop("disabled", false);
      });

    // Enable submit when user types in the manual box
    $modal.find(".filter-plus-deactivation-message").on("input", function () {
      var hasReason = $modal.find('input[name="filter_plus_deactivation_reason"]:checked').length > 0;
      var hasText = $.trim($(this).val()) !== "";
      $modal.find(".filter-plus-deactivation-submit").prop("disabled", !(hasReason || hasText));
    });

    // Send feedback to API, then deactivate (always deactivates, even on error)
    function sendAndDeactivate(reason, $btn) {
      var message = $.trim($modal.find(".filter-plus-deactivation-message").val() || "");

      $modal.find(".filter-plus-deactivation-modal-footer button").prop("disabled", true);
      $btn.text("Deactivating...");

      $.ajax({
        url: filter_plus_deactivation.ajax_url,
        type: "POST",
        timeout: 8000,
        data: {
          action: "filter_plus_deactivation_feedback",
          nonce: filter_plus_deactivation.nonce,
          reason: reason || "",
          message: message,
        },
        complete: function () {
          window.location.href = deactivateUrl;
        },
      });
    }

    // Skip & Deactivate — still send data (reason "skipped" + any manual text)
    $modal.find(".filter-plus-deactivation-skip").on("click", function () {
      sendAndDeactivate("skipped", $(this));
    });

    // Submit & Deactivate — send selected reason + manual text
    $modal.find(".filter-plus-deactivation-submit").on("click", function () {
      var reason = $modal
        .find('input[name="filter_plus_deactivation_reason"]:checked')
        .val();
      sendAndDeactivate(reason || "", $(this));
    });
  });
})(jQuery);
