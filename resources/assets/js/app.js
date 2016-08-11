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

$(".showCard").click(function(){
    var idCard = $(this).data('cardid');
    $(this).siblings("li").removeClass("active");
    $(this).addClass("active");
    $.ajax({
        url: url,
        type: "GET",
        data: {id: idCard},
        success: function(card){
            $card = $(card)
            $("#card-container").fadeOut(150).html($card).fadeIn(150);
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
        format: 'dd/mm/yyyy',
        disableDblClickSelection: true
    });
});

$(".pagination a").click(function(e){
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

$("#id-file").change(function(){
    $("#id-label").children("label").html("<b>ID importé : </b>" + $(this)[0].files[0].name);
});
 $("#avs-file").change(function(){
    $("#avs-label").children("label").html("<b>AVS importée : </b>" + $(this)[0].files[0].name);
});
 $("#permit-file").change(function(){
    $("#permit-label").children("label").html("<b>Permis importée : </b>" + $(this)[0].files[0].name);
});

 $(function(){
    $("#id-file").hover(function(){
        $("#cross1").css({transform: "rotate(90deg)" , transition : "0.3s"});
        $("#cross-cont1").css({"background-color" : "white", color : "#060b2b", transition : "background-color 0.3s, color 0s"});
    });
    $("#id-file").mouseleave(function(){
        $("#cross1").css({transform: "rotate(0deg)" , transition : "0.3s"});
        $("#cross-cont1").css({"background-color" : "#060b2b", color : "white", transition : "background-color 0.3s, color 0s"});
    });
    $("#avs-file").hover(function(){
        $("#cross2").css({transform: "rotate(90deg)" , transition : "0.3s"});
        $("#cross-cont2").css({"background-color" : "white", color : "#060b2b", transition : "background-color 0.3s, color 0s"});
    });
    $("#avs-file").mouseleave(function(){
        $("#cross2").css({transform: "rotate(0deg)" , transition : "0.3s"});
        $("#cross-cont2").css({"background-color" : "#060b2b", color : "white", transition : "background-color 0.3s, color 0s"});
    });
    $("#permit-file").hover(function(){
        $("#cross3").css({transform: "rotate(90deg)" , transition : "0.3s"});
        $("#cross-cont3").css({"background-color" : "white", color : "#060b2b", transition : "background-color 0.3s, color 0s"});
    });
    $("#permit-file").mouseleave(function(){
        $("#cross3").css({transform: "rotate(0deg)" , transition : "0.3s"});
        $("#cross-cont3").css({"background-color" : "#060b2b", color : "white", transition : "background-color 0.3s, color 0s"});
    });

});

 $("#add-experience").click(function(e){
    e.preventDefault();
    //ici on fait des vérifs dynamique
    if($(".experience-title:last").val() == "" || $(".experience-from:last").val() == "" || $(".experience-to:last").val() == "" || $(".experience-description:last").val() == ""){
        alert("Tous les champs doivent être remplis avant d'ajouter une nouvelle Expérience");
    }else{
        //si c'est ok, on execute:
        var nextId = parseInt($(".experience-title:last").data("experience"));
        nextId++;
        var toAppend = "<hr><input class=\"experience-title\" data-experience=\""+nextId+"\" type=\"text\" name=\"experience-title"+nextId+"\" placeholder=\"Titre de l'experience\"><div style=\"display: flex; padding: 0; border:none; margin-bottom:0;\"><input type=\"text\" name=\"experience-from"+nextId+"\" class=\"experience-from date\" placeholder=\"Date début\" style=\"width: 20%; margin-right:10px;\"><input type=\"text\" name=\"experience-to"+nextId+"\" class=\"experience-to date\" placeholder=\"Date fin\" style=\"width: 20%\"></div><textarea name=\"experience-description"+nextId+"\" class=\"experience-description\" placeholder=\"Description de l'experience\" rows=\"4\" style=\"margin:.3125rem 0\"></textarea>";
        $("#append-experience").append(toAppend);
        $('.date').fdatepicker({
        language: 'fr',
        format: 'dd/mm/yyyy',
        disableDblClickSelection: true
    });
    }
 });

  $("#add-education").click(function(e){
    e.preventDefault();
    //ici on fait des vérifs dynamique
    if($(".education-title:last").val() == "" || $(".education-from:last").val() == "" || $(".education-to:last").val() == "" || $(".education-description:last").val() == ""){
        alert("Tous les champs doivent être remplis avant d'ajouter une nouvelle Education");
    }else{
       //si c'est ok, on execute:
        var nextId = parseInt($(".education-title:last").data("education"));
        nextId++;
        var toAppend = "<hr><input class=\"education-tile\" data-education=\""+nextId+"\" type=\"text\" name=\"education-title"+nextId+"\" placeholder=\"Titre de l'éducation\"><div style=\"display: flex; padding: 0; border:none; margin-bottom:0;\"><input type=\"text\" name=\"education-from"+nextId+"\" class=\"education-from date\" placeholder=\"Date début\" style=\"width: 20%; margin-right:10px;\"><input type=\"text\" name=\"education-to"+nextId+"\" class=\"education-to date\" placeholder=\"Date fin\" style=\"width: 20%\"></div><textarea name=\"education-description"+nextId+"\" class=\"education-description\" placeholder=\"Description de l'éducation\" rows=\"4\" style=\"margin:.3125rem 0\"></textarea>";
        $("#append-education").append(toAppend);
        $('.date').fdatepicker({
        language: 'fr',
        format: 'dd/mm/yyyy',
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
        var toAppend = "<li class=\"li-edit-cv\" style=\"padding:0\"><input class=\"langue\" data-langue=\""+nextId+"\"type=\"text\" name=\"language"+nextId+"\" placeholder=\"Langue\"></li>";
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