$(document).ready(function () {
    $(document).on('click',".btnUpdate",function (e) {
        e.preventDefault()
        var idKor = $(this).data('id')
        var uloga = $("#ddlUloga").val()

        $.ajax({
            url : BASE_URL + "/adminUsers/" + idKor,
            method: "put",
            data: {
                idKor,
                uloga
            },
            success: function (data) {
                alert(data.poruka)
            },
            error: function (xhr, status, err) {
                alert(xhr.responseJSON.poruka)
            }
        })
    })
    $(document).on('click',".btnDelete",function (e) {
        e.preventDefault()
        var idKor = $(this).data('id')
        $.ajax({
            url : BASE_URL + "/adminUsers/" + idKor,
            method: "delete",
            data: {
                idKor
            },
            success: function (data) {
                ispisiTabeluSaKorisnicima(data.korisnici)
            },
            error: function (xhr, status, err) {
                alert(xhr.responseJSON.poruka)
            }
        })
    })
})

function ispisiTabeluSaKorisnicima(data) {
    var ispis = ''
    $.each(data,function (i,e) {
        ispis += '<tr>\n' +
            '                                        <td>'+i+'</td>\n' +
            '                                        <td>'+e.name+'</td>\n' +
            '                                        <td>'+e.surname+'</td>\n' +
            '                                        <td>'+e.email+'</td>\n' +
            '                                        <td>\n' +
            '                                            <select class="form-control custom-select " id="ddlUloga" name="ddlUloga">\n' +
            '                                                <option value="1" '
            if(e.role.id == 1)
                ispis += 'selected'
            ispis+='>Admin</option>\n' +
            '                                                <option value="2" '
        if(e.role.id == 2)
            ispis += 'selected'
            ispis += '>Korisnik</option>\n' +
            '                                            </select>\n' +
            '                                        </td>\n' +
            '                                        <td>'+e.created_at+'</td>\n' +
            '                                        <td>'+e.updated_at+'</td>\n' +
            '                                        <td><a href="#" class="btn btn-primary btnUpdate" data-id="'+e.id+'">Izmeni</a></td>\n' +
            '                                        <td><a href="#" class="btn btn-danger btnDelete" data-id="'+e.id+'">Obriši</a></td>\n' +
            '                                    </tr>'
    })
    $('#tabelaKorisnici').html(ispis)
}