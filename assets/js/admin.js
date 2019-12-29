$(document).ready(function() {
    var input_file = $("#article_form_file");

    input_file.change(function() {
        var label = $("#article_label_file");
        var filename = input_file.val();
        
        label.text(filename);
    });
});
