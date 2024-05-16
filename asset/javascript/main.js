function showPassword(idPassword,idIcon) {

    let inputPassword = document.getElementById(idPassword);
    let icon = document.getElementById(idIcon);

    if (inputPassword.type === "password" && icon.classList.contains("bi-eye")) {
        inputPassword.type ="text";
        icon.classList.replace("bi-eye","bi-eye-slash")

    }else {
        inputPassword.type ="password";
        icon.classList.replace("bi-eye-slash","bi-eye")
    }

}