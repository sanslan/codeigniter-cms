$(document).ready(function() {
    
    $("#delete_pages").click(function(){
        var id_array = $(".table-pages input:checkbox:checked").map(function(){
                            return $(this).val();
                        }).get(); 
        $.post( "/admin/page/bulk_delete",{ pages: id_array  }, function( data ) {
            location.reload();
        });
    })

    $("#delete_posts").click(function(){
        var id_array = $(".table-posts input:checkbox:checked").map(function(){
                            return $(this).val();
                        }).get(); 
        $.post( "/admin/post/bulk_delete",{ posts: id_array  }, function( data ) {
            location.reload();
        });
    })

    $("#delete_categories").click(function(){
        var id_array = $(".table-categories input:checkbox:checked").map(function(){
                            return $(this).val();
                        }).get(); 
        $.post( "/admin/category/bulk_delete",{ categories: id_array  }, function( data ) {
            location.reload();
        });
    })
    $("#select_thumbnail").click(function(e){
        e.preventDefault();
        PopupCenter('http://ci-blog.loc/admin/media/select_thumbnail','xtf','950','700');  
    })

    $(".remove-thumbnail-button").click(removeThumbnail);

});
function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}

function replaceThumbnail(file){
    $("#thumb-image").attr("src",'/'+file);
    $("#thumb_input").val(file);
    $(".remove-thumbnail-button").css('display','block');
}
function removeThumbnail(){
    $("#thumb-image").attr("src",'/assets/img/no-image.png');
    $("#thumb_input").val("");
    $(".remove-thumbnail-button").css('display','none');
}