<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                @include('includes.nav')

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            @yield('content')
        </div>

        <div class="clearfix"></div>

    </div> <!-- .main-container -->
</body>
</html>
