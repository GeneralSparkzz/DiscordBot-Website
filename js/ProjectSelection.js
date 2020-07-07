function SelectProject(Name) {
    $.ajax({
        url: "./partials/Portfolio/Projects/" + Name + ".php",
        type: 'post',
        success: function (data) {
            $("#section-selected-project").html(data);
        },
        error: function () {
            $("#section-selected-project").html('An error occured');
        }
    })
}