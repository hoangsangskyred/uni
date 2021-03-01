// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        });

})();

let $CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $SIDEBAR_MENU = $('.sideMenu ul');

function initSidebar() {
    let openUpMenu = function () {
        $SIDEBAR_MENU.find('li').removeClass('active');
        $SIDEBAR_MENU.find('li ul').removeClass('show');
    }

    $SIDEBAR_MENU.find('a').on('click', function (){
        let $li = $(this).parent();
        if ($li.is('.active')) {
            $li.removeClass('active');
            $('ul:first', $li).removeClass('show');
        } else {
            if (!$li.parent().is('.subMenu')) {
                openUpMenu();
            } else {
                $li.siblings('li').removeClass('active');
            }

            $li.addClass('active').find('.subMenu').addClass('show');
        }
    });

    // check active menu
    let $activeAnchor = $SIDEBAR_MENU.find('a[href="' + $CURRENT_URL + '"]');
    let $li = $activeAnchor.parent('li').addClass('active');
    if ($li.parents('ul').is('.subMenu')) {
        $li.parents('ul').addClass('show').parents('.has-dropdown').addClass('active');
    }
    /*$SIDEBAR_MENU.find('a').filter(function () {
        return this.href == $CURRENT_URL;
    }).parent('li').addClass('active');*/
}

$(document).ready(function (){
    initSidebar();
});
