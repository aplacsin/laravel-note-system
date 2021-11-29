$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var count = 0;

$(document).ready(function () {
    let wrapper = $(".wrapper-edit-file-form"),
        add_button = $(".add-edit-file-field");


    $(add_button).click(function (e) {
        e.preventDefault();
        count++
        $(wrapper).append('<div><input class="add-file" type="file" name="file[]"/><a href="#" class="delete btn btn-danger">-</a></div>');
    });

    $(wrapper).on("click", ".delete", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        count--;
    })
});


$(".edit-file-delete").click(function () {
    //Then you get the html element and set to it the lang attribute.
    /*   var lang = $("html").filter(":first").attr("lang"); */
    let id = $(this).data("id"),
        token = $("meta[name='csrf-token']").attr("content");
    if (confirm('Вы точно хотите удалить файл?')) {
        $.ajax({
            url: "/file/" + id + "/destroy",
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            success: function () {
                location.reload();
            }
        });
    }
});
