$(document).ready(function () {
    $(document).on('click','#pretrazi',function (e) {
        e.preventDefault()
        var search = $("#search").val()
        $('#pretraga').val(search)
        $(this).addClass('active')
        $.ajax({
            url : BASE_URL + "/statistics/date/" +1,
            method: "post",
            data: {
                search
            },
            success: function (data) {
                console.log(data)
                ispisAktivnosti(data.aktivnosti, 0,1, data.brojStrana)
            },
            error: function (xhr, status, err) {
                alert(xhr.responseJSON.poruka)
                console.log(xhr.responseJSON)
            }
        })
    })
    $(document).on('click','.page',function (e) {
        e.preventDefault()
        $('.active').removeClass('active')
        var pg = $(this).data('id')
        var pretraga = $('#pretraga').val()
        $(this).addClass('active')
        $.ajax({
            url : BASE_URL + "/statistics/" +pg,
            method: "post",
            data: {
                pretraga
            },
            success: function (data) {
                ispisAktivnosti(data.aktivnosti, pg, 0,0)
            },
            error: function (xhr, status, err) {
                alert(xhr.responseJSON.poruka)
            }
        })
    })
})
function ispisAktivnosti(data, pg, pretraga, brojStrana) {
    var ispis = ''
    $.each(data,function (i,e) {
        ispis += '<tr>\n' +
            '<td>'+(pg+1)+'</td>'+
            '   <td>Korisnik '+e.user.name+' '+e.user.surname+' '+e.action+'</td>\n '+
            '   </tr>'
        pg++
    })
    if(pretraga!=0){
        var ispisLinkova = ''
        for (var i=0;i<brojStrana;i++){
            if(i==0){
                ispisLinkova += '<li class="page-item active page" aria-current="page" data-id="'+((i+1)-1)*5+'"><span class="page-link">'+(i+1)+'</span></li>'
            }else {
                ispisLinkova += '<li class="page-item page" aria-current="page" data-id="'+((i+1)-1)*5+'"><span class="page-link">'+(i+1)+'</span></li>'
            }
        }
        $('.pagination').html(ispisLinkova)

    }

    $('#tabelaAktivnosti').html(ispis)
}