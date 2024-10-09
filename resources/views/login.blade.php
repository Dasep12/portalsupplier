<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Supplier Portal | Bonecom Tricom</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('assets/img/logo_rel.png')}}" type="image/x-icon" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css')}}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
                urls: ['../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>


</head>

<body>
    <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
        <div class="card card0 border-0">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="card1 pb-5">
                        <div class="row">
                            <img src="../assets/img/bonecom.png" class="logo">
                        </div>
                        <div class="row">
                            <a class="title_app text-sm" for="">Supplier Portal v.1.0</a>
                        </div>
                        <div class="row px-3 justify-content-center mt-4 mb-5 border-line">
                            <img src="../assets/img/factory-cartoon.png" class="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="" id="formLogin">
                        @csrf
                        <div class="card2 card border-0 px-4 py-5 mt-4">
                            <div class="row mb-4 px-3">
                                <h6 class="mb-0 mr-4 mt-2"></h6>
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="line"></div>
                                <small class="or text-center">Sign in </small>
                                <div class="line"></div>
                            </div>
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">User Name</h6>
                                </label>
                                <input class="mb-4" type="text" name="username" placeholder="Enter username">
                            </div>
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Password</h6>
                                </label>
                                <input type="password" name="password" placeholder="Enter password">
                            </div>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input id="chk1" type="checkbox" name="chk" class="custom-control-input">
                                    <label for="chk1" class="custom-control-label text-sm">Remember me</label>
                                </div>
                                <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                            </div>
                            <div class="row mb-3 px-3">
                                <button type="submit" class="btn btn-blue text-center">Login</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-12">
                    <div id="ErrorInfo">

                    </div>
                </div>
            </div>
            <div class="bg-blue py-4">
                <div class="row px-3">
                    <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2024. All rights reserved.</small>
                    <div class="social-contact ml-4 ml-sm-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showToast(data, act, msg) {
            var content = {};
            content.icon = 'fa fa-bell';
            content.message = act + " " + data + " " + msg;
            content.title = '';
            $.notify(content, {
                type: 'success',
                placement: {
                    from: 'top',
                    align: 'center'
                },
                time: 400,
                delay: 800,
                allow_dismiss: true,
                z_index: 9999,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShown: function() {
                    // Handle jqGrid pagination here, or make sure it's functional
                }
            });
        }

        $('#formLogin').submit(function(e) {
            e.preventDefault();

            var formData = new FormData($('#formLogin')[0]);
            $.ajax({
                url: "{{ url('auth') }}",
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                async: false,
                success: function(data) {
                    if (data.msg == "success") {
                        setTimeout(function() {
                            if (data.roles == "*") {
                                window.location.href = "{{ url('dashboard') }}"
                            } else {
                                window.location.href = "{{ url('monitorStock') }}"
                            }
                        }, 100)
                    } else {
                        showToast(data.msg, "", '')
                    }
                },
                error: function(xhr, desc, err) {
                    var respText = "";
                    try {
                        respText = eval(xhr.responseText);
                    } catch {
                        respText = xhr.responseText;
                    }

                    respText = unescape(respText).replaceAll("_n_", "<br/>")

                    var errMsg = '<div class="col-md-12"><div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Error ' + xhr.status + '!</strong> ' + respText + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div></div>'
                    $('#ErrorInfo').html(errMsg);
                },
            });
        })
    </script>
</body>

</html>