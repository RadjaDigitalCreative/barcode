<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <li><a href="{{route('dashboard')}}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}"><i
                            class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
                <li><a href="{{route('category')}}"><i class="fa fa-balance-scale"
                                                       aria-hidden="true"></i><span>Category</span></a></li>
                <li><a href="{{route('product')}}"><i class="fa fa-shopping-cart"
                                                      aria-hidden="true"></i><span>Product</span></a></li>
                <li><a href="{{route('barcode-generator.index')}}"
                       class="{{ Request::routeIs('barcode-generator.index') ? 'active' : '' }}"><i
                            class="fa fa-barcode"></i> <span>Barcode Generator</span></a></li>
                <li><a href="{{route('company')}}"><i class="fa fa-building-o"></i> <span>Company</span></a></li>
                <li><a href="{{route('user-payment.index')}}"
                       class="{{ Request::routeIs('user-payment.index') ? 'active' : '' }}"><i class="fa fa-user"></i>
                        <span>User</span></a></li>
                <li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="lnr lnr-home"></i> <span>Logout</span></a>
                </li>

                {{-- <li><a href="{{ route('pembelian.index') }}" class="{{ Request::routeIs('pembelian.index') ? 'active' : '' }}"><i class="lnr lnr-cart"></i><span>Pembelian</span></a></li>
                {{-- <li><a href="{{ route('barang.index') }}" class="{{ Request::routeIs('barang.index')? 'active' : '' }}"><i class="lnr lnr-database"></i><span>Stok</span></a></li> --}}
            </ul>
        </nav>
    </div>
</div>
