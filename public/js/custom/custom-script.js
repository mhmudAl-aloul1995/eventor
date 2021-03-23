var $loading = $('.ok');


$('select[required]').css({
    position: 'absolute',
    display: 'inline',
    height: 0,
    padding: 0,
    border: '1px solid rgba(255,255,255,0)',
    width: 0
});
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
    $('select').formSelect();

    $('.modal').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        startingTop: '4%', // Starting top style attribute
        endingTop: '10%', // Ending top style attribute
        ready: function (modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
            alert("Ready");
            console.log(modal, trigger);
        },
        complete: function () {
            alert('Closed');
        } // Callback for Modal close
    });

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
    form.attr('action', links + formName + id);
    form.validate();
    if (form.valid() == false) {
        $('#' + formName + 'Modal').modal('open');
        return false;
    } else {
        var $form = form, formData = new FormData();
        var id = form.find('[name="id"]').val();
        var file = form.find('[type="file"]')

        $.each($form.serializeArray(), function (i, obj) {
            formData.append(obj.name, obj.value);
        });
        formData.append("_token", token);

        id ? formData.append('_method', "PUT") : formData.append('_method', "POST")

        if (file.length > 0) {
            $.each(file, function (i, obj) {

                if ($(obj).val()) {
                    formData.append($(obj).attr('name'), obj.files[0])
                }
            });
        }
        $.ajax({
            url: id ? links + '/' + formName + '/' + id : links + '/' + formName,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            type: "POST",

            success: function (data) {
                if (data.success) {
                    $('#' + formName + "Modal").modal('close');

                    $('.' + formName + 'Table').click()
                }
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
$(".modal").modal({
    onOpenEnd: onModalHide
});

function reloadTable(table) {
    $('#' + table + "Table").DataTable().ajax.reload()


}

function showModal(formName, id) {

    var form = $('#' + formName + 'Form')

    form.find('.error').removeClass('error');
    form.find("lable").click();
    form.find("input,textarea").css("border-bottom", "1px solid #9e9e9e").css("box-shadow", "none").val(null)

    var selects = form.find('select').serializeArray();
    $.each(selects, function (i, field) {
        var fieldName = field.name
        const selected = document.querySelector('[name="' + fieldName + '"]');
        const materializeSelected = M.FormSelect.init(selected);

        selected.value = "";
        if (typeof (Event) === 'function') {
            var event = new Event('change');
        } else {
            var event = document.createEvent('Event');
            event.initEvent('change', true, true);
        }
        selected.dispatchEvent(event)


    });


    if (id == null) {
        $('#' + formName + 'Modal').modal('open');
        form.find('[name="id"]').val(null);

    } else {

        $.get(links + "/" + formName + '/' + id + "/edit", function (data) {
            console.log(data)
            if (data) {
                var selects = form.find('select').serializeArray();
                var inputs = form.find('textarea,input').serializeArray();

                $.each(selects, function (i, field) {
                    var fieldName = field.name


                    const selected = document.querySelector('[name="' + fieldName + '"]');
                    const materializeSelected = M.FormSelect.init(selected);
                    selected.value = data[fieldName];

                    if (formName == 'users' && fieldName == 'role_id') {
                        selected.value = data['roles'][0]['id'];

                    }
                    if (typeof (Event) === 'function') {
                        var event = new Event('change');
                    } else {
                        var event = document.createEvent('Event');
                        event.initEvent('change', true, true);
                    }
                    selected.dispatchEvent(event)

                });
                $.each(inputs, function (i, field) {

                    var fieldName = field.name
                    form.find('[name="' + fieldName + '"]').val(data[fieldName]);
                });
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


