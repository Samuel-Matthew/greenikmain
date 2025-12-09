<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<style>
   

    .loader {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: green;
        position: relative;
    }

    .loader:before,
    .loader:after {
        content: "";
        position: absolute;
        border-radius: 50%;
        inset: 0;
        background: #fff;
        transform: rotate(0deg) translate(30px);
        animation: rotate 1s ease infinite;
    }

    .loader:after {
        animation-delay: 0.5s
    }

    @keyframes rotate {
        100% {
            transform: rotate(360deg) translate(30px)
        }
    }

    body {
        background-color: black;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
        margin: auto;
    }
</style>

<body>


    <span class="loader"></span>



    <script>
        const ref = "{{ $reference }}";
        const interval = setInterval(() => {
            fetch(`/api/check-payment-status?reference=${ref}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.status || data.status === "pending") return; // do nothing

                    clearInterval(interval); // stop polling

                    if (data.status === "success") {
                        window.location.href = `/order/confirmed/${data.order_id}`;
                    }

                    if (data.status === "failed") {
                        window.location.href = `/payment/failed/${data.order_id}`;
                    }
                })
                .catch(err => console.error(err));
        }, 3000);
        
    </script>


</body>

</html>