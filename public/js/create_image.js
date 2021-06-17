$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    let max_fields = 5,
        wrapper = $(".wrapper-image"),
        add_button = $(".add-create-field"),
        x = 1;


    /* Add field file 'images' */

    $(add_button).click(function (e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div><input class="add-file" type="file" name="image[]"/><a href="#" class="delete btn btn-danger">Удалить</a></div>'); //add input box
        } else {
            alert('Максимальное кол-во картинок!')
        }
    });

    /* Delete field */

    $(wrapper).on("click", ".delete", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});