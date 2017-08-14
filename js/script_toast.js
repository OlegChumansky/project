/**
 * Created by user on 05.07.2017.
 */

var toastId = 1254;
function setToast(text) {
    toastId++;
    var body = $('body');

    var container = $(".js_toast_container");
    if (container.length == 0) container = $('<div/>').addClass("toast_container js_toast_container").appendTo(body);

    var toast = $('<div/>').attr("id", "toast_" + toastId).addClass("toast").html(text).css("visibility", "visible").css("opacity", 0.9).prependTo(container);
    toast.mouseout(function () {
        var id = $(this).attr('id');
        setTimeout(function () {
            clear(id);
        }, 1000);
        $(this).css("opacity", 0.5);
    });
    toast.mouseover(function () {
        $(this).css("opacity", 1);
        stopClear($(this).attr('id'));
    });
    toast.dblclick(function () {
        deleteToast($(this).attr('id'));
    });
    setTimeout(function () {
        clear(toast.attr('id'));
    }, text.length * 120);
}

function clear(id) {
    console.log("id: " + id);
    var toast = $("#" + id);
    if (toast.length != 0) {
        var opacity = toast.css("opacity");
        if (opacity <= 0.9) {
            if (opacity <= 0) {
                toast.remove();
            }
            else {
                setTimeout(function () {
                    clear(id);
                }, 50);
                toast.css("opacity", opacity - 0.03);
            }
        }
    }
}

function stopClear(id) {
    var toast = $("#" + id);
    if (toast.length != 0) {
        toast.css("opacity", 1);
    }
}

function deleteToast(id) {
    var toast = $("#" + id);
    if (toast.length != 0) {
        toast.remove();
    }
}