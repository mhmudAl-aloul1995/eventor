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
        var file = form.find('[type="file"]')

        if (file.length > 0) {
            $.each(file, function (i, obj) {

                formData.append($(obj).attr('name'), obj.files[0])

            });
        }


        var id = form.find('[name="id"]').val();

        id ? formData.append('_method', "POST") : null
        $.ajax({
            url: $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},

            type: id ? "POST" : "POST",

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
    //form.find('option:eq(0)').prop('selected', true).trigger('change');


    if (id == null) {
        $('#' + formName + 'Modal').modal('open');
        form.attr('action', links + "/" + formName);
        form.attr('method', "POST");

        form.find('[name="id"]').val(null);

    } else {

        $.get(links + "/" + formName + '/' + id + "/edit", function (data) {
            if (data) {
                form.attr('method', "POST");
                form.attr('action', links + "/update" + formName);
                var selects = form.find('select').serializeArray();
                var inputs = form.find('textarea,input').serializeArray();
                $.each(selects, function (i, field) {
                    var fieldName = field.name
                    var select = $('[name="' + fieldName + '"]');
                    select.formSelect();

                    select.find('option:eq(' + data[fieldName] + ')').prop('selected', true);
                    select.formSelect();

                });
                $.each(inputs, function (i, field) {

                    var fieldName = field.name
                    form.find('[name="' + fieldName + '"]').val(data[fieldName]);
                });
                form.find('[name="_method"]').val("POST")
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


