{{-- IF ROUTE DASHBOARD --}}
@if (Request::is('dashboard'))
    <footer class="sticky-footer bg-white" style="bottom: 0px !important;position: fixed;">
@else
    <footer class="sticky-footer bg-white">
@endif
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
