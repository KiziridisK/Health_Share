/**
 * Sends an email message containing the password reset code in order for the password to be reset.
 * Changes the html promts according to the success/failure of the send email php functionality.
 */
function handleEmail() {
    siteName = location.pathname.split("/")[1];

    prompt = document.getElementById("email_prompt");
    emailInput = document.getElementById("email").value;

    if (emailInput == null || emailInput == "") {
        if (!prompt.classList.contains("invalid-feedback")) {
            prompt.classList.add("invalid-feedback");
        }
        prompt.innerHTML = "Please enter an email";

        if (!document.getElementById("email").classList.contains('is-invalid')) {
            document.getElementById("email").classList.add("is-invalid");
        }

        return;
    }

    $.ajax({
        method: "POST",
        url: location.origin + "/" + siteName + "/util/php/handleEmail.php",
        data: { email: emailInput },
    })
        .done(function (response) {
            var isValid = false;

            switch (response) {
                case "Email sent.":
                    isValid = true;
                    break;
            }

            if (isValid) {
                if (prompt.classList.contains("invalid-feedback")) {
                    prompt.classList.remove("invalid-feedback");
                }
                if (!prompt.classList.contains("valid-feedback")) {
                    prompt.classList.add("valid-feedback");
                }
                prompt.innerHTML = response;

                if (document.getElementById("email").classList.contains("is-invalid")) {
                    document.getElementById("email").classList.remove("is-invalid");
                }
                if (!document.getElementById("email").classList.contains('is-valid')) {
                    document.getElementById("email").classList.add("is-valid");
                }
            } else {
                if (prompt.classList.contains("valid-feedback")) {
                    prompt.classList.remove("valid-feedback");
                }
                if (!prompt.classList.contains("invalid-feedback")) {
                    prompt.classList.add("invalid-feedback");
                }
                prompt.innerHTML = response;

                if (document.getElementById("email").classList.contains('is-valid')) {
                    document.getElementById("email").classList.remove("is-valid");
                }
                if (!document.getElementById("email").classList.contains('is-invalid')) {
                    document.getElementById("email").classList.add("is-invalid");
                }
            }
        });
}