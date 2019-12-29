window.display_prompt = function (text, link) {
    $("#prompt_message").css('display', 'flex');
    $("#prompt_message_text").text(text);
    $("#prompt_message_submit").attr("href", link);
}

window.cancel_prompt = function() {
    $("#prompt_message").hide();
}

$(document).ready(function() {
    $("#prompt_message_cancel").click(window.cancel_prompt);
});
