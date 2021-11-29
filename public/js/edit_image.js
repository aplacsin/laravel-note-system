$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var count = 0;

$(document).ready(function () {
    let wrapper = $(".wrapper-edit-image-form"),
        add_button = $(".add-edit-image-field");


    /* Add field file 'images' */

    $(add_button).click(function (e) {
        e.preventDefault();
        count++
        $(wrapper).append('<div><input class="add-file" type="file" name="image[]"/><a href="#" class="delete btn btn-danger">-</a></div>');
    });

    /* Delete field */

    $(wrapper).on("click", ".delete", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        count--;
    })
});

/* Delete images */

$(".edit-image-delete").click(function () {
    //Then you get the html element and set to it the lang attribute.
    /*   var lang = $("html").filter(":first").attr("lang"); */
    let id = $(this).data("id"),
        token = $("meta[name='csrf-token']").attr("content");
    if (confirm('Вы точно хотите удалить изображение?')) {
        $.ajax({
            url: "/image/" + id + "/destroy",
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
