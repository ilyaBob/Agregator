$(document).ready(function() {
    $("#add-url-book").click(function() {
        var formGroupElement = $(".form-url");

        var clonedElement = formGroupElement.clone();
        clonedElement.removeClass("form-url");
        clonedElement.insertBefore($("#add-url-book"));
    });
});
