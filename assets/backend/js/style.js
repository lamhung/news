$(document).ready(function(){
          $('.dropdown-submenu a.menu_sub').on("click", function(e){
            $(this).next('ul').toggle();
            e.stopPropagation();
            e.preventDefault();
          });
        });
