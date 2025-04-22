<!DOCTYPE html>
<html lang="en">
    @include('layouts.header')
<body>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main" class="layout-navbar">
            @include('layouts.topbar')
            <div id="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
</body>
</html>
