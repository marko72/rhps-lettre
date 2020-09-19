$(document).ready(function () {
    $(document).on('click','#pretrazi',function (e) {
        e.preventDefault()
        var search = $("#topSearch").val()
        $('#search').val(search)
        $(this).addClass('active')
        $.ajax({
            url : BASE_URL + "/news/search/" +1 ,
            method: "post",
            data: {
                search
            },
            success: function (data) {
                ispisVesti(data.vesti, 1, data.brojStrana)
            },
            error: function (xhr, status, err) {
                alert(xhr.responseJSON.poruka)
            }
        })
    })
    $(document).on('click','.page',function (e) {
        e.preventDefault()
        $('.active').removeClass('active')
        var pg = $(this).data('id')
        var search = $('#search').val()
        $(this).addClass('active')
        $.ajax({
            url : BASE_URL + "/news/paginate/" +pg,
            method: "post",
            data: {
                search
            },
            success: function (data) {
                ispisVesti(data.vesti, 0,0)
            },
            error: function (xhr, status, err) {
            }
        })
    })
})
function ispisVesti(data, pretraga, brojStrana) {
    var ispis = ''
    $.each(data,function (i,e) {
        ispis += '<!-- Single Post Area -->\n' +
            '<div class="single-post-area style-2">\n' +
            '    <div class="row align-items-center">\n' +
            '        <div class="col-12 col-md-6">\n' +
            '            <!-- Post Thumbnail -->\n' +
            '            <div class="post-thumbnail">\n' +
            '                <img src="'+BASE_URL+'/images/news/'+e.picture.path+'" alt="'+e.title.toLowerCase()+'">\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="col-12 col-md-6">\n' +
            '            <!-- Post Content -->\n' +
            '            <div class="post-content mt-0">\n' +
            '                <a href="#" class="post-cata cata-sm cata-success">'+e.categories.title+'</a>\n' +
            '                <a href="{{route(\'single.news\',$v->id)}}" class="post-title mb-2">'+e.title+'</a>\n' +
            '                <div class="post-meta d-flex align-items-center mb-2">\n' +
            '                    <a href="#" class="post-author">'+e.user.name+' '+e.user.surname+'</a>\n' +
            '                    <i class="fa fa-circle" aria-hidden="true"></i>\n' +
            '                    <a href="#" class="post-date">'+e.created_at+'</a>\n' +
            '                </div>\n' +
            '                <p class="mb-2">'+e.content.substr(0,255)+'</p>\n' +
            '                <div class="post-meta d-flex">\n' +
            '                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> '+e.brKomentara+'</a>\n' +
            '\n' +
            '                </div>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </div>\n' +
            '</div>'
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
    $('#news').html(ispis)
}