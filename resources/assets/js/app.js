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