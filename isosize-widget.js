//passing jquery variable to make it available as $
jQuery(document).ready(function($){

    // getting php variable
    var position = php_var.position;
    var key = php_var.key;

    // Creating element <div> tag in html file and getting data on the fly
    // syntax jQuery( html, attributes )
    // css is loaded via script in isosize-index.php
    //creating div element
    var thediv = jQuery("<div>", {
        class: "isosize",
        id: "div_two"
    });

    // creating frame element
    var theframe = jQuery("<iframe>", {
        src: "http://www.isosize.com/api/v4/widget.aspx?api=116220116912341371971631151481635987&key="+key,
        id: "frame_two",
        scrolling: "no",
        frameborder: "0",
        style: "position:relative; left:-70px; overflow: hidden; height: 400px; width: 100%;"
    });

    // appending frame into div itself appending into the body element
    thediv.append(theframe);
    thediv.appendTo("body");

    if (position == "left"){ widgetOnLeft(); }
    else{ widgetOnRight(); }

});


function widgetOnRight(){

    // animation of the widget via div tag and isosize class in body
    jQuery(".isosize").hover(
        function () {
            jQuery(this).stop().animate({ right: "-95px" }, "medium");
        },
        function () {
            jQuery(this).stop().animate({ right: "-440px" }, "medium");
        },
        500
    );
}


function widgetOnLeft(){

    jQuery(".isosize").hover(
        function () {
            jQuery(this).stop().animate({ left: "-1px" }, "medium");
        },
        function () {
            jQuery(this).stop().animate({ left: "-300px" }, "medium");
        },
        500
    );
}
