var $loading = $('.ok');


$(document)
    .ajaxStart(function () {
        $loading.prop('disabled', true);
    })
    .ajaxStop(function () {
        $loading.prop('disabled', false);
        $('.buttons-page-length').on('click', function (e) {
        });
    });
$(document).ready(function () {
    $('#clickmewow').click(function () {
        $('#radio1003').attr('checked', 'checked');
    });
    $("select").show();
})
$(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%'
});

function submitForm(formName) {
    var form = $('#' + formName + 'Form')
    form.validate();
    if (form.valid() == false) {
        $('#' + formName + 'Modal').modal('open');
        return false;
    } else {
        var $form = form,
            formData = new FormData(),
            params = $form.serializeArray();
        formData.append('_token', token);
        $.each(params, function (i, obj) {
            formData.append(obj.name, obj.value);
        });
        var file = form.find('[type="file"]');
        if (file.length > 0) {
            formData.append(file.attr('name'), file[0].files[0]);
        }
        var id = form.find('[name="id"]').val();

        id ? formData.append('_method', "PUT") : null
        $.ajax({
            url: $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},

            type: id ? "PUT" : "POST",

            success: function (data) {
                if (data.success) {
                    //  $('#' + formName + 'Modal').modal('hide');
                    $('.' + formName + 'Table').click()
                    M.toast({html: data.message})
                }
                //$('#' + formName + 'Modal').modal('colse');
                $('#' + formName + 'Table').DataTable().ajax.reload()

                M.toast({html: data.message})


            },
            error: function (data) {
                console.log(data.message);

                /* var errors="";
                 data.errors.each(function(index, value) {
                     errors+=value;
                 });*/
                M.toast({html: data.message})
            },
            statusCode: {
                500: function (data) {
                    console.log(data);
                }
            }
        });
    }
}

var onModalHide = function () {
    $('form').validate().resetForm()
};

/*$(".modal").modal({
    onOpenEnd : onModalHide
});*/

function showModal(formName, id) {

    var form = $('#' + formName + 'Form')
    /* form.validate().resetForm();
     form.find('.error').removeClass('error');
     form.find('input,textarea').css('border-bottom-color', 'black').val(null)*/
    form.find('select').val(null).trigger('change');
    if (id == null) {
        $('#' + formName + 'Modal').modal('open');
        form.attr('action', links + "/" + formName);
        form.attr('method', "POST");

        form.find('[name="id"]').val(null);
        form.find('[name="_method"]').val(null);

    } else {

        $.get(links + "/" + formName + '/' + id + "/edit", function (data) {
            if (data) {
                form.attr('method', "PUT");
                form.attr('action', links + "/" + formName + "/" + id);
                var selects = form.find('.select2');
                var inputs = form.find('textarea,input').serializeArray();
                $.each(selects, function (i, field) {
                    var fieldName = field.name
                    form.find('[name="' + fieldName + '"]').val(data[fieldName]).trigger('change');
                });
             /*   if (formName == "roles") {
                    var Values = new Array();

                    $.each(data.permissions, function (i, field) {

                        var id = field.id
                        Values.push(id);


                    });

                    form.find('[name="permissions[]"]').val(Values).trigger('change');

                    $('[name="permissions[]"]').on('change',function () {
                        var ids = $(this).val();
                        var role_id = form.find('[name="id"]').val()
                        $.ajax({
                            url: links + '/updateRolePermissions/',
                            data: {_token: token, permissions: ids, role_id:role_id},
                            type: "POST",
                            success: function (data, textStatus, jqXHR) {


                            },
                            error: function (data, textStatus, jqXHR) {
                                console.log(data)

                                M.toast({html: data.message})

                            },
                        });

                    });


                }
                if (formName == "users") {
                    var Values = new Array();

                    $.each(data.roles, function (i, field) {

                        var id = field.id
                        Values.push(id);


                    });
                    form.find('[name="roles[]"]').val(Values).trigger('change');

                    $('[name="roles[]"]').on('change',function () {
                        var ids = $(this).val();
                        var user_id = form.find('[name="id"]').val()
                        alert(user_id);
                        $.ajax({
                            url: links + '/updateRoleUsers/',
                            data: {_token: token, roles: ids, user_id:user_id},
                            type: "POST",
                            success: function (data, textStatus, jqXHR) {


                            },
                            error: function (data, textStatus, jqXHR) {
                                console.log(data)

                                M.toast({html: data.message})

                            },
                        });

                    });

                    var Values = new Array();

                    $.each(data.permissions, function (i, field) {

                        var id = field.id
                        Values.push(id);


                    });

                }*/
                $.each(inputs, function (i, field) {

                    var fieldName = field.name
                    form.find('[name="' + fieldName + '"]').val(data[fieldName]);
                });
                form.find('[name="_method"]').val("PUT")
                $('#' + formName + 'Modal').modal('open');
            }
        }).fail(function (data) {
            M.toast({html: data.message})
        })


    }

}


function deleteThis(formName, id) {

    if (!confirm('هل انت متاكد؟')) {
        return false;
    } else {

        $.ajax({
            url: links + '/' + formName + '/' + id,
            data: {_token: token},
            type: "DELETE",
            success: function (data, textStatus, jqXHR) {

                //   $('.' + formName + 'Table').click()

                M.toast({html: data.message})
                $('#' + formName + 'Table').DataTable().ajax.reload()
                $('.dropdown-trigger').dropdown();

            },
            error: function (data, textStatus, jqXHR) {
                console.log(data)

                M.toast({html: data.message})

            },
        });
    }
}


