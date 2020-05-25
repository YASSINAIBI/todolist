$(function() {
    $(".task-box").click(function(){
        $(this).toggleClass("line-through");
    });

    $("#change_img").click(function(){
        $(".update_img").fadeIn(2000);
        $(".update_email").hide();
    });


    $("#change_email").click(function(){
        $(".update_email").fadeIn(2000);
        $(".update_email").animate({
            left: '5%',
        });
        $(".update_img").hide();
    });
});

