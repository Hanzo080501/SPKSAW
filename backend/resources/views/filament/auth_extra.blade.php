<style>
    body {
        background: url('{{ asset('assets/images/background.png') }}') no-repeat center center fixed !important;
        background-size: cover !important;
    }

    @media screen and (min-width: 1024px) {
        main {
            position: absolute;
            left: 50px;
        }

        main:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 128, 128, 0.7);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            z-index: -9;

            /* Efek rotasi */
            t-webkit-transform: rotate(7deg);
            -moz-transform: rotate(7deg);
            -o-transform: rotate(7deg);
            -ms-transform: rotate(7deg);
            transform: rotate(7deg);
        }

        .fi-logo {
            position: fixed;
            right: 100px;
            font-size: 3em;
            color: rgb(255, 204, 0);
        }

        #slogan {
            position: fixed;
            top: 100px;
            left: 50px;
            color: rgb(255, 204, 0);
            font-family: cursive;
            font-size: 2em;
            font-weight: bold;
            text-shadow: #3f6212 2px 2px 5px;
        }
    }
</style>
