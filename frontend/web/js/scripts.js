var $ = jQuery;

$(window).resize(function(){
    $('#footer').css('height',heightFoot);
    $('body').css('margin-bottom',heightFoot);
});
$(document).ready(function(){
    $("#wizard").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "horizontal",
        onInit:function(){
            $('.select-drop').select2({
                minimumResultsForSearch: Infinity
            });
        },
    });
    $('.sel').select2({
        minimumResultsForSearch: Infinity
    });
    var heightFoot = $('#footer').outerHeight();
    $('#footer').css('height',heightFoot);
    $('body').css('margin-bottom',heightFoot);
    $('.portfolio-carousel').owlCarousel({
        loop:true,
        margin:50,
        nav:false,
        dots:true,
        items:5,
        navText: ["<span></span>","<span></span>"],
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:2,
                nav:false,
            },
            // breakpoint from 480 up
            // breakpoint from 768 up
            768 : {
                items:4,
                nav:false,
                dots:true
            },
            1199 : {
                items:5,
            }
        }
    });
    $('.testimonials-carousel').owlCarousel({
        loop:true,
        margin:50,
        nav:true,
        dots:false,
        items:1,
        navText: ["<span class='glyphicon glyphicon-chevron-left'></span>","<span class='glyphicon glyphicon-chevron-right'></span>"],
        responsive : {
            // breakpoint from 0 up
            0 : {
                items:1,
                nav:false,
            },
            // breakpoint from 480 up
            // breakpoint from 768 up
            768 : {
                items:1,
                nav:false,
                dots:true
            },
            1199 : {
                items:1,
            }
        }
    });
    $('.testimonials-carousel').on('changed.owl.carousel', function(e) {
        if (!e.namespace || e.property.name != 'position') return
        $('#info').text(e.relatedTarget.relative(e.item.index)+ 1 + '/' + e.item.count)
    });
    if($(".checkbox").length > 0 || $(".radio").length > 0){
        checks();
        $(".checkbox input[type='checkbox'], .radio input[type='radio']").change(function(){
            checks();
        });
    }
});
function initialize() {

    var input = document.getElementById('searchTextField');

    var options = {
        types: ['(cities)'],
    };

    var autocomplete = new google.maps.places.Autocomplete(input, options);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {

    });

}

function checks(){
    $(".checkbox input[type='checkbox'], .radio input[type='radio']").each(function(){
        if($(this).attr('checked')){$(this).closest('label').addClass('checked');}
        else {$(this).closest('label').removeClass('checked');}
    });
}


var selectedMark = 0;
var selectedPresence = 0;

$(".marks .eval").click(function(){
    selectedMark = $(this).attr("data-val");
    console.log(selectedMark);
});

$(".presence .eval").click(function(){
    selectedPresence = $(this).attr("data-val");
    console.log(selectedPresence);
});

$(".lesson-mark").click(function () {
    if(selectedMark > 0){
        $(this).attr('data-val', selectedMark);
        $(this).text(selectedMark);
    } else {
        $(this).attr('data-val', '');
        $(this).text('');
    }
    console.log('start');
    $.ajax({
        url: '/lesson-data/update-value',
        type: "POST",
        data: {
            "lesson_data_id": $(this).attr("lesson-data-id"),
            "lesson_attr": "homework_mark",
            "lesson_attr_val": selectedMark
        },
        success: function (data) {
            //alert(data);
           console.log("mark updated");
            console.log(data);

        },
        error: function(error){
            console.log("error");
            console.log(error);
        }
    });

});

$(".lesson-presence").click(function () {

    $(this).attr('data-val', selectedPresence);
    $(this).text(selectedPresence == 0 ? '-' : '+');

    console.log('start');
    $.ajax({
        url: '/lesson-data/update-value',
        type: "POST",
        data: {
            "lesson_data_id": $(this).attr("lesson-data-id"),
            "lesson_attr": "presence",
            "lesson_attr_val": selectedPresence
        },
        success: function (data) {
            //alert(data);
            console.log("presence updated");
            console.log(data);

        },
        error: function(error){
            console.log("error");
            console.log(error);
        }
    });

});