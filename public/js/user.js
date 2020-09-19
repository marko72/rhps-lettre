$(document).ready(function () {

    $("#btnReg").click(function () {
        proveriPodatke(0)
    })
    $("#btnEdit").click(function () {
        proveriPodatke(1)
    })

})
function proveriPodatke(izmena) {
    var name = $("#tbName").val()
    var surname = $("#tbSurname").val()
    var email = $("#tbEmail").val()
    var passwd = $("#tbPasswd").val()
    var greske = []

    var paternImePrezime = /^[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}(\s[A-ZŠĐŽĆČ][a-zšđćžč]{2,13}){0,2}$/;
    var paternEmail = /^[A-z]{3,13}((\_|\.){0,1}[0-9]{0,4}){0,2}((\.|\_){0,1}[A-z]{3,13}){0,2}((\.|\_){0,1}[0-9]{0,4}){0,2}\@(gmail|ymail|yahoo|rocketmail|outlock)\.(com|net|rs|fr|it)$/;
    var paternPasswd = /[\w\S]{5,}[\d]{1,10}/;

    if(!paternImePrezime.test(name)){
        greske.push("Ime nije u skladu sa paternom")
    }
    if(!paternImePrezime.test(surname)){
        greske.push("Prezime nije u skladu sa paternom")
    }
    if(!paternEmail.test(email)){
        greske.push("Email nije u skladu sa paternom")
    }
    if(passwd.length==0){
        greske.push("Morate uneti lozinku")
    }

    if(greske.length==0){
        if(izmena==0){
            var data = {
                'insert':"da",
                name,
                surname,
                email,
                passwd
            }
            var putanja = BASE_URL + "/user"
            var _method = 'post'
            posaljiPodatke(data, putanja, _method)
        }else {
            var usrID = $("#usrID").val()
            var data = {
                'edit':"da",
                name,
                surname,
                email,
                passwd
            }
            var putanja = BASE_URL + "/user/" + usrID
            var _method = 'put'
            posaljiPodatke(data, putanja, _method)
        }
        $('.greske').html('<li class="list-group-item">Podaci su dobri</li>')
    }else {
        var ispis = ''
        $.each(greske,function (i,e) {
            ispis += '<li class="list-group-item">'+e+'</li>';
        })
        $('.greske').html(ispis)
    }

}

function posaljiPodatke(data, putanja, _method) {
    $.ajax({
        url: putanja,
        type: _method,
        data: data,
        success: function (data) {
            if(_method=='put'){
                alert("Uspesno izmenjeni podaci")
                $('.greske').html('<li class="list-group-item">Uspesno ste izmenili podatke</li>')
            }else {
                alert(data.poruka)
                $('.greske').html('<li class="list-group-item">Uspesno ste se registrovali</li>')
            }
        },
        error: function (xhr, status, error) {
            if (xhr.status==422){
                var ispis = ''
                $.each(xhr.responseJSON.errors,function (i,e) {
                    ispis += '<li class="list-group-item">'+e+'</li>';
                })
                $('.greske').html(ispis)
            }else {
                var ispis = ''
                $.each(xhr.responseJSON,function (i,e) {
                    ispis += '<li class="list-group-item">'+e+'</li>';
                })
                $('.greske').html(ispis)
            }

        }
    })
}