function removeElementById(id) {
    const element = $('#' + id);
    if (element != null) {
        element.remove();
    }
}

$(document).ready(function() {
    $("#btn_delete").click(function(e) {
        removeElementById("btn_delete");
    });
});
