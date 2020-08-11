document.getElementById("cta-register").addEventListener('click', register_form_login)
document.getElementById("cta-login").addEventListener('click', login_form_login)

content_form = document.querySelector(".form__front")
form_login = document.querySelector(".form__front--login")
form_register = document.querySelector(".form__front--register")
box_login = document.querySelector(".form__back--login")
box_register = document.querySelector(".form__back--register")


function register_form_login(){
    form_register.style.display = 'block'
    content_form.style.left = "50%"
    form_login.style = 'none'
    box_register.style.opacty = '0'
    box_login.style.opacty = '1'
}

function login_form_login(){
    form_register.style.display = 'none'
    content_form.style.left = "5%"
    form_login.style = 'block'
    box_register.style.opacty = '1'
    box_login.style.opacty = '0'
}