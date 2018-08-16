$(document).ready(function() {
    
    $("#delete_pages").click(function(){
        var id_array = $(".table-pages input:checkbox:checked").map(function(){
                            return $(this).val();
                        }).get(); 
        $.post( "/admin/page/bulk_delete",{ pages: id_array  }, function( data ) {
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

});


