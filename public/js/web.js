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


// click button header

function addClassOpen()
{
    let hamburger = document.querySelector('.hamburger')
    let mobileNav = document.querySelector('.nav-list')
    let bars = document.querySelectorAll('.hamburger span')
    let isActive = false
    if(window.innerHeight < window.innerWidth){
        window.addEventListener('resize', function(){
            addRequiredClass();
        })
        function addRequiredClass() {
            if (window.innerWidth < 860) {
                document.body.classList.add('mobile')
            } else {
                document.body.classList.remove('mobile') 
            }
        }
        
        window.onload = addRequiredClass

        hamburger.addEventListener('click', function() {
            mobileNav.classList.toggle('open')
            if(!isActive) {
                bars[0].style.transform = 'rotate(45deg)'
                bars[1].style.opacity = '0'
                bars[2].style.transform = 'rotate(-45deg)'
                isActive = true
            } else {
                bars[0].style.transform = 'rotate(0deg)'
                bars[1].style.opacity = '1'
                bars[2].style.transform = 'rotate(0deg)'
                isActive = false
            }
        })
    
    }
    else
    {
        window.addEventListener('resize', function(){
            addRequiredClass();
        })
        function addRequiredClass() {
            if (window.innerWidth < 860) {
                document.body.classList.add('mobile')
            } else {
                document.body.classList.remove('mobile') 
            }
        }
        window.onload = addRequiredClass

           hamburger.addEventListener('click', function() {
            mobileNav.classList.toggle('open2')
            if(!isActive) {
                bars[0].style.transform = 'rotate(45deg)'
                bars[1].style.opacity = '0'
                bars[2].style.transform = 'rotate(-45deg)'
                isActive = true
            } else {
                bars[0].style.transform = 'rotate(0deg)'
                bars[1].style.opacity = '1'
                bars[2].style.transform = 'rotate(0deg)'
                isActive = false
            }
        })
    }
}
$(document).ready(function (){
  addClassOpen();
});
