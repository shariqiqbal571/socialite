<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
            aria-labelledby="pills-home-tab" tabindex="0">
            <div class="sequence ms-5 w-75 ">
                <form method="post"  class="form-group">
                    @csrf
                    <div class=" row me-3 mb-2">
                        <input class="form-control form-control-lg" type="email" name="email" :value="old('username')" placeholder="User Name">
                    </div>
                    <div class="mb-4 row me-3 mb-2">
                        <input class="form-control form-control-lg" id="password" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="d-grid ">
                        <button type="submit"
                            class="btn py-3 align-items-center fw-bold Signin">{{ __('Log in') }}</button>
                        <a href="#"  class="btn py-3 align-items-center fw-bold fb ">
                            <i class="fa-brands fa-facebook me-3"></i>
                            Signin withFacebook
                        </a>
                        <a href="{{ URL::to('googleLogin') }}"  class="btn py-3 align-items-center fw-bold google"><i
                                class="fa-brands fa-google me-3"></i>Signin with
                            Google</a>

                           
                    </div>
                </form>    
                <button id="microsoft-login">Login with Microsoft</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#microsoft-login').click(function () {
                // Trigger the AJAX request
               
                $.ajax({
                    url: '/microsoftLogin', // Replace with your actual route
                    type: 'GET',
                    success: function (data) {
                        // Handle the success response (redirect or other logic)
                        
                        console.log(data.redirect_url)
                        window.location.href = data.redirect_url;
                    },
                    error: function (error) {
                        // Handle errors
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Extract the access token from the URL fragment
            var accessToken = window.location.hash.substring(1).split("&")[0].split("=")[1];

            if (accessToken) {

               
                // Using jQuery for simplicity, make sure to include the jQuery library
                $.ajax({
                    url: '/auth/microsoft/callback/ajax', // Replace with your actual route
                    type: 'GET',
                    data: { access_token: accessToken },
                    success: function (data) {
                        // Handle the success response (redirect or other logic)
                        console.log(data);
                    },
                    error: function (error) {
                        // Handle errors
                        console.error(error);
                    }
                });
            }
        });
    </script>
    
</body>
</html>