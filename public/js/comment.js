$(document).ready(function () {
    $("#btnComment").click(function (e) {
        e.preventDefault()
        var usrID = $('#userID').val()
        var admin = $("#admin").val()
        if(usrID == 0){
            alert('Da bi ste ostavili komentar morate biti ulogovani')
        }else {
            var postID = $('#postID').val()
            var message = $("#message").val()
            $.ajax({
                url : BASE_URL + '/comment',
                type : 'post',
                data : {
                    usrID,
                    postID,
                    message
                },
                success : function (data) {
                    writeComments(data.komentari, usrID, admin)
                },
                error : function (xhr, status, err) {
                    alert("Pisanje komentara nije uspelo")
                }

            })
        }
    })
    $(document).on('click','.delete-comment',function (e) {
        e.preventDefault()
        var idComment = $(this).data('id')
        var idPost = $("#postID").val()
        var userID = $("#userID").val()

        $.ajax({
            url : BASE_URL + "/uncomment",
            type : "post",
            data : {
                idComment,
                idPost,
                userID
            },
            success : function (data) {
                writeComments(data.komentari, userID, 0)
            },
            error : function (xhr, status, code) {
                alert("Greska pri brisanju, pokusajte kasnije")
            }
        })

    })
    $(document).on('click','.delete-comment-admin',function (e) {
        e.preventDefault()
        var idComment = $(this).data('id')
        var idPost = $("#postID").val()
        var userID = $("#admin").val()
        $.ajax({
            url : BASE_URL + "/uncomment",
            type : "post",
            data : {
                idComment,
                idPost,
                userID
            },
            success : function (data) {
                writeComments(data.komentari, -1, 1)
            },
            error : function (xhr, status, code) {
                alert("Greska pri brisanju, pokusajte kasnije")
            }
        })

    })
})

function writeComments(data, userID, admin) {
    var ispis = '';
    $.each(data, function (i,e) {
        ispis += '<li class="single_comment_area">\n' +
            '                                            <!-- Comment Content -->\n' +
            '                                            <div class="comment-content d-flex">\n' +
            '                                                <!-- Comment Meta -->\n' +
            '                                                <div class="comment-meta">\n' +
            '                                                    <a href="#" class="comment-date">'+e.created_at+'</a>\n' +
            '                                                    <h6>'+e.name+' '+e.surname+'</h6>\n' +
            '                                                    <p>'+e.pivot.content+'</p>\n'
        if (admin != 0){

            ispis += ' <a href="#" class="btn btn-danger delete-comment-admin" data-id="'+e.pivot.id+'">Obriši komentrar</a>'+
                '<input type="hidden" id="admin" value="'+admin+'">'
        }else {
            if(e.id == userID){
                ispis += ' <a href="#" class="btn btn-danger delete-comment" data-id="'+e.pivot.id+'">Obriši komentrar</a>'
            }
        }
    ispis +='                                                </div>\n' +
            '                                            </div>\n' +
            '                                        </li>'
    })
    $("#comments").html(ispis)
}