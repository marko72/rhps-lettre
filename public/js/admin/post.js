$(document).ready(function () {
    /*$(document).on('click','.btnUpdate',function (e) {
        e.preventDefault()
        var prodID = $(this).data('id')
        $.ajax({
            url: BASE_URL+"/posts/"+prodID,
            method: "GET",
            success:function (data) {
                alert("Dobro")
                console.log(data)
            },
            error:function (xhr) {
                alert(xhr.responseJSON)
            }
        })
    })*/
    $(document).on('click','.btnDelete',function (e) {
        e.preventDefault()
        var prodID = $(this).data('id')
        var csrf  =$("#_token").val()
        $.ajax({
            type:"DELETE",
            url:BASE_URL+'/posts/'+prodID,
            /*data:{
              prodID
            },*/
            success:function (data) {
                var ispis = ispisiPostove(data.postovi,0);
            },
            error:function (xhr, status ,err) {
                alert(xhr.responseJSON.greska)
            }
        })
    })

    $(document).on('click','.page',function (e) {
        e.preventDefault()
        $('.active').removeClass('active')
        var pg = $(this).data('id')
        $(this).addClass('active')
        $.ajax({
            url : BASE_URL + "/posts/paginate/" +pg,
            method: "post",
            success: function (data) {
                ispisiPostove(data.postovi, pg)
            },
            error: function (xhr, status, err) {
                alert(xhr.responseJSON.poruka)
            }
        })
    })
})

function ispisiPostove(data, pg) {
    var ispis = '';
    $.each(data, function (i,e ) {
        ispis+='<tr>\n' +
            '<td>'+(pg+1)+'</td>'+
            '                                        <td>'+e.title+'</td>\n' +
            '                                        <td style="max-height: 100px">'+e.content+'</td>\n' +
            '                                        <td><img class="img-thumbnail" src="'+BASE_URL+'/images/news/'+e.picture.path+'" alt="'+e.picture.alt+'"></td>\n' +
            '                                        <td>'+e.user.name+' '+e.user.surname+'</td>\n' +
            '                                        <td>'+e.categories.title+'</td>\n' +
            '                                        <td>'+e.created_at+'</td>\n' +
            '                                        <td>'+e.updated_at+'</td>\n' +
            '                                        <td><a href="'+BASE_URL+'/posts/'+e.id+'/edit" class="btn btn-primary btnUpdate">Izmeni</a></td>\n' +
            '                                        <td><a href="#" class="btn btn-danger btnDelete" data-id="'+e.id+'">Obriši</a></td>\n' +
            '                                    </tr>';
        pg++;
    })
    $("#tabelaPostovi").html(ispis);

}