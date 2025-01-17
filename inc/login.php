<?php
add_action('login_head', 'personalizar_estilos_login');
add_filter('login_headerurl', 'cambiar_url_logotipo_login');
add_filter('gettext', 'modificar_texto_label_login', 20, 3);
add_filter('login_redirect', 'redirigir_despues_de_login', 10, 3);

function personalizar_estilos_login() {
    echo '<style type="text/css">
        #login {
            padding-top: 15vh !important;
        }
        #login h1 a {
            background-image: url(' . esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ) . '); /* Ruta del logotipo */
            background-size: contain;
            width: 209px; /* Ajusta el tamaño del logotipo */
        }
        body.login {
            background-color: '. get_theme_mod('color_primary', '#2f358b') .'; /* Cambia el fondo de la página */
        }
        #loginform {
            background-color: '. get_theme_mod('color_body_tertiary', '#2f358b') .'; /* Cambia el fondo del formulario */
            border: 0; /* Agrega un borde al formulario */
            padding: 20px;
            border-radius: 0.25rem;
        }
        .login label {
            color: #333; /* Cambia el color de los textos de los campos */
            font-size: 16px;
        }
        .input {
            border: 1px !important;
            border-radius: 0.25rem !important;
            box-shadow: rgba(0, 0, 0, 0.075) 0px 2px 4px 0px !important;
            font-size: 16px !important;
            padding: 6px 16px !important;
            margin-bottom: 6px !important;
        }
        .forgetmenot {
            margin-bottom: 14px !important;
        }
        .login .button-primary {
            width: 100%;
            background-color: '. get_theme_mod('color_primary', '#2f358b') .'; /* Cambia el color del botón */
            border-color: '. get_theme_mod('color_primary', '#2f358b') .';
            font-size: 16px;
            padding: 2px 0px !important;
            transition: all 0.15s 0s ease-in-out;
        }
        .login .button-primary:hover {
            background-color: '. get_theme_mod('color_primary', '#2f358b') .'; /* Cambia el color del botón */
            border-color: '. get_theme_mod('color_primary', '#2f358b') .';
            filter: brightness(1.25) !important;
        }
        .login #nav {
            display: flex;
            justify-content: center;
        }
        .wp-login-lost-password {
            color: #ffffff !important;
            font-size: 16px !important;
        }
        .login #backtoblog a {
            display: flex;
            justify-content: center;
            color: #ffffff !important;
        }
        .language-switcher {
            display: none !important;
        }
        .login form {
            background-color: '. get_theme_mod('color_body_tertiary', '#2f358b') .' !important; /* Cambia el fondo del formulario */
            border: 0 !important; /* Agrega un borde al formulario */
            padding: 20px !important;
            border-radius: 0.25rem !important;
        }
        #lostpasswordform > p > #user_login.input {
            margin-bottom: 20px !important;
        }
        .wp-login-log-in {
            color: #ffffff !important;
            font-size: 16px !important;
        }
    </style>';
}

function cambiar_url_logotipo_login() {
    return home_url(); // Redirige a la página de inicio del sitio
}

function modificar_texto_label_login($translated_text, $text, $domain) {
    // Verifica si el texto es el que deseas cambiar
    if ($text === 'Username or Email Address') {
        $translated_text = 'Usuario o correo electrónico'; // El texto que desees mostrar
    }
    return $translated_text;
}

function redirigir_despues_de_login($redirect_to, $request, $user) {
    return home_url(); // Redirige a una página específica
}
