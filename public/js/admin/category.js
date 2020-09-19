$(document).ready(function () {
    $("#btnInsert").click(function (e) {
        e.preventDefault();
        var title = $("#title").val()
        /*var _token = $("#_token").val()*/
        if(title==""){
            $("#greske").attr('hidden',false)
            $("#greske").html("<h5>Naziv kategorije ne sme biti prazan</h5>")
        }else {
            $.ajax({
                url:BASE_URL+"/categories",
                method:"post",
                data:{
                    "insert":"da",
                    title
                },
                success:function (data) {
                    alert("Uspešno uneta kategorija!")
                },
                error:function (xhr) {
                    alert(xhr.responseJSON.errors.title)
                }
            })
        }
    })
    $(document).on('click',".btnDelete",function (e) {
        e.preventDefault()
        var id = $(this).data('id')
        $.ajax({
            type:"DELETE",
            url: BASE_URL+"/categories/"+id,
            success:function (data) {
                alert("Uspesno obrisno!")
                ispisiTabelu(data.kategorije)
            },
            error:function (xhr) {
                alert(xhr.responseJSON.poruka);
            }
        })
    })
})
function ispisiTabelu(data) {
    var ispis = ""
    $.each(data,function (i,e) {
        ispis+='<tr>' +
            '       <td>'+(++i)+'</td>\n' +
            '       <td>'+e.title+'</td>\n' +
            '       <td><a href="#" class="btn btn-danger btnDelete" data-id="'+e.id+'" data-token="{{csrf_token()}}">Obriši</a></td>\n' +
            '</tr>'
    })
    $('#tabelaKategorije').html(ispis)
}