<div id="layoutSidenav_nav">
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading"></div>
            <a class="nav-link" href="{{route('dashboard.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-line theme-color"></i></div>
                Dashboard
            </a>
            <a class="nav-link" href="{{route('stock.index')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-layer-group theme-color"></i></div>
                Stock
            </a>
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#add-record" aria-expanded="undefined" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-plus theme-color"></i></div>
                Add Record
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down theme-color"></i></div>
            </a>
            <div class="collapse show" id="add-record" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('company.index') }}">Company</a>
                    <a class="nav-link" href="{{ route('party.index') }}">Party</a>
                    <a class="nav-link" href="{{ route('quality.index') }}">Quality</a>
                 </nav>
            </div>
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#purchase" aria-expanded="undefined" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns theme-color"></i></div>
                 Purchase / Sale
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down theme-color"></i></div>
            </a>
            <div class="collapse show" id="purchase" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('purchase.index') }}">Purchase</a>
                    <a class="nav-link" href="{{ route('sale.index') }}">Sale</a>
                </nav>
            </div>
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePayments" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-money-check theme-color"></i></div>
                Payments
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down theme-color"></i></div>
            </a>
            <div class="collapse show" id="collapsePayments" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('company_payment.index') }}">Company Payment</a>
                    <a class="nav-link" href="{{ route('party_payment.index') }}">Party Payment</a>
                </nav>
            </div>
        </div>
    </div>
    <div class="sb-sidenav-footer">
        <div class="small"></div>
        Rehan Coal Management
    </div>
</nav>
</div>

