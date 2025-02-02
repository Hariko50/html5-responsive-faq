jQuery(function($) {
    $('.hrf-title').on('click', function() {
        var myContentId = $(this).data('content-id');
        if (!myContentId) {
            return;
        }
        // Falls jQuery 3+ vorhanden ist: sicheren Selektor bauen.
        var safeId = ($.escapeSelector)
            ? $.escapeSelector(myContentId)
            : myContentId.replace(/([!"#$%&'()*+,.\/:;<=>?@[\\\]^`{|}~])/g, "\\$1");

        $('#' + safeId).slideToggle();

        // Klassentoggle: wechselt zwischen "close-faq" und "open-faq".
        if ($(this).hasClass('close-faq')) {
            $(this).removeClass('close-faq').addClass('open-faq');
        } else {
            $(this).removeClass('open-faq').addClass('close-faq');
        }
    });
});
