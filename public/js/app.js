function afterNow(e, n, t) {
    (new Date).getTime() - new Date(e.value).getTime();
    return !0
}

function refresh_current_side_nav_element(e) {
    var n = window.innerHeight,
        t = $(window).scrollTop(),
        i = t + n / 2,
        o = !1,
        a = $(elements).map(function(e, n) {
            var t = $(n).offset().top;
            return {
                hash: n,
                top_offset: t
            }
        });
    a.each(function(e, n) {
        i >= n.top_offset && (o = n)
    }), $(".index-side-nav a.active").removeClass("active"), o && $('.index-side-nav a[href="' + o.hash + '"]').addClass("active")
}

function scroll_to_element(e) {
    e.length && $(window).scrollTop(e.offset().top - 55)
}

function change_active_element(e) {
    e.length && ($(".index-side-nav a.active").removeClass("active"), e.addClass("active"))
}

function refresh_side_nav_elements() {
    var e = [];
    return $(".index-side-nav a").each(function() {
        e.push($(this).attr("href"))
    }), e
}

function prevent_scrolling() {
    $("body").css("overflow-y", "hidden")
}
var configuration = {
    abide: {
        live_validate: !0,
        validate_on_blur: !0,
        error_labels: !0,
        validators: {
            after_now: afterNow
        },
        patterns: {
            time: /^(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])$/,
            abovezero: /^[1-9][0-9]*$/
        }
    }
};

$(document).foundation(configuration), $(document).foundation();
var elements = [],
    currentscroll = 0;
$(function() {
    ".index-side-nav".length && (elements = refresh_side_nav_elements(), refresh_current_side_nav_element(null), $(".index-side-nav a").click(function(e) {
        e.preventDefault();
        var n = $(e.target),
            t = $(n.attr("href"));
        scroll_to_element(t), change_active_element(n)
    }), $(window).scroll(Foundation.utils.throttle(refresh_current_side_nav_element, 200)))
}), $(".top-bar .signin-button-parent .signin-button").on("click", function(e) {
    e.preventDefault(), $(".top-bar .top-bar-section .signin-section").removeClass("closed"), $(".top-bar .signin-button-parent").addClass("hidden")
}), $(".top-bar .top-bar-section .signin-section .exit-button").on("click", function(e) {
    e.preventDefault(), $(".top-bar .top-bar-section .signin-section").addClass("closed"), setTimeout(function() {
        $(".top-bar .signin-button-parent").removeClass("hidden")
    }, 200)
});

$(".signup-button").click(function(){
  $("#home").addClass("blured");
  $("#details").addClass("blured");
  $("#apps").addClass("blured");
  $("#partners").addClass("blured");
  $(".footer").addClass("blured");
});

$(".payment-button").click(function(){
    $("#optionPayment").addClass("blured");
});

var modal = $("#signupModal, #signinModal");

$(document).mouseup(function (e)
{
    if (!modal.is(e.target)&& modal.has(e.target).length === 0)
    {
        $("#home").removeClass("blured");
        $("#details").removeClass("blured");
        $("#apps").removeClass("blured");
        $("#partners").removeClass("blured");
        $(".footer").removeClass("blured");

    }
});

var modalPayment = $("#paymentCashModal, #paymentTransferModal");

$(document).mouseup(function (e)
{
    if (!modalPayment.is(e.target)&& modalPayment.has(e.target).length === 0)
    {
        $("#optionPayment").removeClass("blured");
    }
});

$("body").on('click', '.showCard', function(){
    var idCard = $(this).data('cardid');
    $(this).siblings("li").removeClass("active");
    $(this).addClass("active");
    $("#card-container").fadeOut(150);
    if((window.location.href).split('/').pop() == "experience"){
        $.ajax({
            url: url,
            type: "GET",
            data: {id: idCard, search: 0},
            success: function(card){
                $card = $(card)
                $("#card-container").html($card).fadeIn(150);
            }
        });
    }else{
        $.ajax({
            url: url,
            type: "GET",
            data: {id: idCard, search: 1},
            success: function(card){
                $card = $(card)
                $("#card-container").html($card).fadeIn(150);
            }
        });
    }
    
});

$(".showChrono").click(function(e){
    e.preventDefault();
    var idChrono = $(this).data('chrono-id');
    $(this).siblings("a").removeClass("active");
    $(this).addClass("active");
    $("#list-to-append").fadeOut(150);
    $.ajax({
        url: url_liste,
        type: "GET",
        data: {id: idChrono},
        success: function(liste){
            $liste = $(liste)
            $("#list-to-append").html($liste).fadeIn(150);
        }
    });
});

$(function(){
    $('#date').fdatepicker({
        language: 'fr',
        format: 'dd/mm/yyyy hh:ii',
        disableDblClickSelection: true,
        pickTime: true
    });
    $('.date').fdatepicker({
        language: 'fr',
        format: 'mm/yyyy',
        disableDblClickSelection: true
    });
});

$(function(){
    $('#dateFinish').fdatepicker({
        language: 'fr',
        format: 'dd/mm/yyyy hh:ii',
        disableDblClickSelection: true,
        pickTime: true
    });
    $('.date').fdatepicker({
        language: 'fr',
        format: 'mm/yyyy',
        disableDblClickSelection: true
    });
});

$(".go-to-page").click(function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    $("#to-load").load(url + " #to-load");
});

$("#more-details").click(function(){
    $this = $(this);
    if($this.children("i").hasClass("fa-caret-down")){
        $this.children("i").removeClass("fa-caret-down").addClass("fa-caret-up");
        $this.children("span").text("LESS DETAILS");
        $(".details-container").css({"max-height":"3000px", opacity:"1"});
    }else{
        $this.children("i").removeClass("fa-caret-up").addClass("fa-caret-down");
        $this.children("span").text("MORE DETAILS");
        $(".details-container").css({"max-height":"0", opacity:""});
    } 
});

$("#nationalite-file").change(function(){
    $("#nationalite-label").children("label").html("<b>Nationality card uploaded : </b>" + $(this)[0].files[0].name);
});
 $("#avs-file").change(function(){
    $("#avs-label").children("label").html("<b>AVS uploaded : </b>" + $(this)[0].files[0].name);
});
 $("#permit-file").change(function(){
    $("#permit-label").children("label").html("<b>Permit uploaded : </b>" + $(this)[0].files[0].name);
});
 $("#iban-file").change(function(){
    $("#iban-label").children("label").html("<b>IBAN uploaded : </b>" + $(this)[0].files[0].name);
});

 $(function(){
    $("#nationalite-file").hover(function(){
        $("#cross2").css({transform: "rotate(90deg)" , transition : "0.3s"});
        $("#cross-cont2").css({"background-color" : "white", color : "#060b2b", transition : "background-color 0.3s, color 0s"});
    });
    $("#nationalite-file").mouseleave(function(){
        $("#cross2").css({transform: "rotate(0deg)" , transition : "0.3s"});
        $("#cross-cont2").css({"background-color" : "#060b2b", color : "white", transition : "background-color 0.3s, color 0s"});
    });
    $("#avs-file").hover(function(){
        $("#cross1").css({transform: "rotate(90deg)" , transition : "0.3s"});
        $("#cross-cont1").css({"background-color" : "white", color : "#060b2b", transition : "background-color 0.3s, color 0s"});
    });
    $("#avs-file").mouseleave(function(){
        $("#cross1").css({transform: "rotate(0deg)" , transition : "0.3s"});
        $("#cross-cont1").css({"background-color" : "#060b2b", color : "white", transition : "background-color 0.3s, color 0s"});
    });
    $("#permit-file").hover(function(){
        $("#cross3").css({transform: "rotate(90deg)" , transition : "0.3s"});
        $("#cross-cont3").css({"background-color" : "white", color : "#060b2b", transition : "background-color 0.3s, color 0s"});
    });
    $("#permit-file").mouseleave(function(){
        $("#cross3").css({transform: "rotate(0deg)" , transition : "0.3s"});
        $("#cross-cont3").css({"background-color" : "#060b2b", color : "white", transition : "background-color 0.3s, color 0s"});
    });
    $("#iban-file").hover(function(){
        $("#cross4").css({transform: "rotate(90deg)" , transition : "0.3s"});
        $("#cross-cont4").css({"background-color" : "white", color : "#060b2b", transition : "background-color 0.3s, color 0s"});
    });
    $("#iban-file").mouseleave(function(){
        $("#cross4").css({transform: "rotate(0deg)" , transition : "0.3s"});
        $("#cross-cont4").css({"background-color" : "#060b2b", color : "white", transition : "background-color 0.3s, color 0s"});
    });

});

$("#modif-files").click(function(e){
    var href = $(this).attr('href');
    swal({  title: "Are you sure ?",   text: "Files already uploaded will be suppressed from our data base.",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#060b2b",   confirmButtonText: "Yes!",   closeOnConfirm: false }, function(){   window.location.href = href; });
    return false;
});

$("#delete-link").click(function(e){
    var href = $(this).attr('href');
    swal({  title: "Are you sure ?",   text: "",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#060b2b",   confirmButtonText: "Yes!",   closeOnConfirm: false }, function(){   window.location.href = href; });
    return false;
});

 $("#add-experience").click(function(e){
    e.preventDefault();
    //ici on fait des vérifs dynamique
    if($(".experience-title:last").val() == "" || $(".experience-from:last").val() == "" || $(".experience-to:last").val() == "" || $(".experience-description:last").val() == ""){
        swal({   title: "Error!",   text: "Tous les champs doivent être remplis avant d'ajouter une nouvelle Expérience",   type: "error",   confirmButtonText: "Ok" });
    }else{
        //si c'est ok, on execute:
        var nextId = parseInt($(".experience-title:last").data("experience"));
        nextId++;
        var toAppend = "<hr><input class=\"experience-title\" data-experience=\""+nextId+"\" type=\"text\" name=\"experience-title"+nextId+"\" placeholder=\"Titre de l'experience\"><div style=\"display: flex; padding: 0; border:none; margin-bottom:0;\"><input type=\"text\" name=\"experience-from"+nextId+"\" class=\"experience-from date\" placeholder=\"Date début\" data-date-format=\"mm/yyyy\" data-start-view=\"year\" data-min-view=\"year\" style=\"width: 20%; margin-right:10px;\"><input type=\"text\" name=\"experience-to"+nextId+"\" class=\"experience-to date\" placeholder=\"Date fin\" data-date-format=\"mm/yyyy\" data-start-view=\"year\" data-min-view=\"year\" style=\"width: 20%\"></div><textarea name=\"experience-description"+nextId+"\" class=\"experience-description\" placeholder=\"Description de l'experience\" rows=\"4\" style=\"margin:.3125rem 0\"></textarea>";
        $("#append-experience").append(toAppend);
        $('.date').fdatepicker({
        language: 'fr',
        format: 'mm/yyyy',
        disableDblClickSelection: true
    });
    }
 });

 $("#add-education").click(function(e){
    e.preventDefault();
    //ici on fait des vérifs dynamique
    if($(".education-title:last").val() == "" || $(".education-from:last").val() == "" || $(".education-to:last").val() == "" || $(".education-description:last").val() == ""){
        swal({   title: "Error!",   text: "Tous les champs doivent être remplis avant d'ajouter une nouvelle education",   type: "error",   confirmButtonText: "Ok" });
    }else{
        //si c'est ok, on execute:
        var nextId = parseInt($(".education-title:last").data("education"));
        nextId++;
        var toAppend = "<hr><input class=\"education-title\" data-education=\""+nextId+"\" type=\"text\" name=\"education-title"+nextId+"\" placeholder=\"Titre de l'education\"><div style=\"display: flex; padding: 0; border:none; margin-bottom:0;\"><input type=\"text\" name=\"education-from"+nextId+"\" class=\"education-from date\" placeholder=\"Date début\" data-date-format=\"mm/yyyy\" data-start-view=\"year\" data-min-view=\"year\" style=\"width: 20%; margin-right:10px;\"><input type=\"text\" name=\"education-to"+nextId+"\" class=\"education-to date\" placeholder=\"Date fin\" data-date-format=\"mm/yyyy\" data-start-view=\"year\" data-min-view=\"year\" style=\"width: 20%\"></div><textarea name=\"education-description"+nextId+"\" class=\"education-description\" placeholder=\"Description de l'education\" rows=\"4\" style=\"margin:.3125rem 0\"></textarea>";
        $("#append-education").append(toAppend);
        $('.date').fdatepicker({
        language: 'fr',
        format: 'mm/yyyy',
        disableDblClickSelection: true
    });
    }
 });

    $("#add-skill").click(function(e){
    e.preventDefault();
    //ici on fait des vérifs dynamique
    if($(".competence:last").val() == ""){
        alert("Vous devez remplir le champ avant d'en ajouter un autre");
    }else{
       //si c'est ok, on execute:
        var nextId = parseInt($(".competence:last").data("competence"));
        nextId++;
        var toAppend = "<li class=\"li-edit-cv\" style=\"padding:0\"><input class=\"competence\" data-competence=\""+nextId+"\"type=\"text\" name=\"skill"+nextId+"\" placeholder=\"Compétence\"></li>";
        $("#append-skill").append(toAppend); 
    }
    
 });

    $("#add-language").click(function(e){
    e.preventDefault();
    //ici on fait des vérifs dynamique
    if($(".langue:last").val() == ""){
        alert("Vous devez remplir le champ avant d'en ajouter un autre");
    }else{
        //si c'est ok, on execute:
        var nextId = parseInt($(".langue:last").data("langue"));
        nextId++;
        var toAppend = "<li class=\"li-edit-cv\" style=\"padding:0\"><input type=\"text\" name=\"language"+nextId+"\" placeholder=\"Langue\" class=\"langue\" data-langue=\""+nextId+"\"></li>";
        $("#append-language").append(toAppend);
    }
 });



    $("#login-submit").submit(function(e) {
     var self = this;
     e.preventDefault();
     jQuery.fancybox('<div class="box">Some amazing wonderful content</div>', {
           'onClosed' : function() { 
                          self.submit();
                        }
     });
     return false; //is superfluous, but I put it here as a fallback
});

var width = $(window).width();
$(document).ready(function(){
    if(location.pathname.split('/').slice(-1)[0] == "login"){
        $("body").css({
            "display":"flex",
            "flex-direction":"column",
            "min-height":"100vh"
        })
    }
    
    if(width <= 700){
        $('#logo-navbar').attr('src', '/extrasme/public/images/logo.gif');
    }
    
    // On passe chaque note à l'état grisé par défaut
    $("ul.notes-echelle li label").removeClass("completed");
    // Au survol de chaque note à la souris
    $("ul.notes-echelle li").mouseover(function() {
        // On passe les notes supérieures à l'état inactif (par défaut)
        $(this).nextAll("li").children("label").removeClass("completed");
        // On passe les notes inférieures à l'état actif
        $(this).prevAll("li").children("label").addClass("completed");
        // On passe la note survolée à l'état actif (par défaut)
        $(this).children("label").addClass("completed");
    });
    // Lorsque l'on sort du sytème de notation à la souris
    $("ul.notes-echelle").mouseout(function() {
        // On passe toutes les notes à l'état inactif
        $(this).children("label").removeClass("completed");
        // On simule (trigger) un mouseover sur la note cochée s'il y a lieu
        $(this).find("li input:checked").parent("li").trigger("mouseover");
    });
});

$(window).resize(function(){
    width = $(window).width();
    if(width <= 700){
        $('#logo-navbar').attr('src', '/extrasme/public/images/logo.gif');
    }else{
        $('#logo-navbar').attr('src', '/extrasme/public/images/logo-long.gif');
    }
});

$(function() {
    $('.image-editor').cropit();

    $('#profile-form').submit(function() {
          // Move cropped image data to hidden input
          var imageData = $('.image-editor').cropit('export');
          $('.hidden-image-data').val(imageData);
          return true;
      });
});

$(function() {
    $('#search').focus(function(){
        $(this).parent("div").addClass("border-blur");
    });
    $('#search').blur(function(){
        $(this).parent("div").removeClass("border-blur");
    });
});

$(function() {
    $('.fav-list-container').on('click', function(){
        var idStud = $(this).data('studid');
        $(".rightpan-toload").fadeOut(150);
        if($(this).data('type') == 0){
            $.ajax({
                url: urlPro,
                type: "GET",
                data: {id: idStud},
                success: function(card){
                    $card = $(card)
                    $(".rightpan-toload").html($card).fadeIn(150);
                }
            });
        }else{     
            $.ajax({
                url: urlStudent,
                type: "GET",
                data: {id: idStud},
                success: function(card){
                    $card = $(card)
                    $(".rightpan-toload").html($card).fadeIn(150);
                }
            });
        }
        
    });
});

function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}